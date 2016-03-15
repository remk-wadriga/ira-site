<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 22:50
 */

namespace admin\controllers;

use Yii;
use admin\abstracts\ControllerAbstract;
use yii\base\ErrorException;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use models\User;
use models\Event;
use models\EventUser;
use models\Image;
use models\Tag;

class ApiController extends ControllerAbstract
{
    public function actionUploadImage()
    {
        /** @var \interfaces\FileModelInterface|\interfaces\ImagedEntityInterface static */
        $modelClass = $this->get('modelClass');

        if ($modelClass === null || !class_exists($modelClass)) {
            throw new BadRequestHttpException();
        }
        /** @var \interfaces\FileModelInterface|\interfaces\ImagedEntityInterface */
        $model = new $modelClass();
        $service = Yii::$app->file;

        if (Yii::$app->file->loadFile($model)) {
            if (!$service->fileName && $this->get('id') > 0) {
                $model = $modelClass::findOne($this->get('id'));
                if ($model === null) {
                    throw new BadRequestHttpException();
                }
                if ($images = Image::findEntityImages($model)) {
                    $files = [];
                    foreach ($images as $image) {
                        if (!$image->isMain($model)) {
                            $nameParts = explode('/', $image->url);
                            $files[] = [
                                'name' => end($nameParts),
                                'size' => 1500,
                                'url' => $image->url,
                                'thumbnailUrl' => $image->url,
                                'deleteUrl' => Url::to(['/admin/api/remove-image', 'image' => $image->url, 'modelClass' => $modelClass, 'id' => $model->id]),
                                'deleteType' => 'POST',
                            ];
                        }
                    }
                    return Json::encode([
                        'files' => $files,
                    ]);
                } else {
                    return Json::encode([]);
                }
            }

            if (!$service->fileName) {
                return Json::encode([]);
            }

            $this->addUploadedImagesToSession($modelClass, $model->getImgUrl());
            return Json::encode([
                'files' => [[
                    'name' => $service->fileName,
                    'size' => $service->fileSize,
                    'url' => $model->getImgUrl(),
                    'thumbnailUrl' => $model->getImgUrl(),
                    'deleteUrl' => Url::to(['/admin/api/remove-image', 'image' => $model->getImgUrl(), 'modelClass' => $modelClass, 'id' => $this->get('id')]),
                    'deleteType' => 'POST',
                ]],
            ]);
        } else {
            throw new ErrorException($this->t('Can not upload the file'));
        }
    }

    public function actionRemoveImage()
    {
        $img = $this->get('image');
        $modelClass = $this->get('modelClass');
        if (!$img || !$modelClass) {
            throw new BadRequestHttpException();
        }

        $this->removeUploadedImagesFromSession($modelClass, $img);
        Image::removeImage($img, $modelClass, $this->get('id'));
        Yii::$app->file->removeFile($img);
        return Json::encode([
            'files' => [[
                'name' => $img,
            ]],
        ]);
    }

    public function actionRegisterUserByEventRecord($id)
    {
        if (!$this->isAjax()) {
            throw new BadRequestHttpException();
        }
        /** @var \models\EventUser */
        $record = EventUser::findOne($id);
        if ($record === null) {
            throw new NotFoundHttpException($this->t('Record not found'));
        }
        if ($record->isRegisteredUser()) {
            return $this->renderAjx(null, $this->t('User already registered'), self::AJX_STATUS_OK);
        }

        $status = self::AJX_STATUS_OK;

        $user = new User();
        $nameParts = explode(' ', $record->name);
        $user->email = $record->email;
        $user->phone = $record->phone;
        $user->firstName = $nameParts[0];
        if (isset($nameParts[1])) {
            $user->lastName = $nameParts[1];
        }

        if ($user->load($this->post())) {
            $user->setStoryAction($user::STORY_ACTION_CREATED_BY_EVENT_RECORD);
            if (!$user->save()) {
                $status = self::AJX_STATUS_ERROR;
            } else {
                return $this->renderAjx(null, $this->t('User successfully registered'), self::AJX_STATUS_OK);
            }
        }

        return $this->renderAjx('@siteViews/auth/_register-form', '', $status, [
            'user' => $user,
            'title' => $this->t('Register user'),
        ]);
    }

    public function actionAddUserToEvent($eventID)
    {
        if (!$this->isAjax()) {
            throw new BadRequestHttpException();
        }
        /** @var \models\Event */
        $event = Event::findOne($eventID);
        if ($event === null) {
            throw new NotFoundHttpException($this->t('Event not found'));
        }

        $user = new User();
        $status = self::AJX_STATUS_OK;

        if ($user->load($this->post())) {
            $user->setStoryAction($user::STORY_ACTION_CREATED);
            if (!$user->save()) {
                $status = self::AJX_STATUS_ERROR;
            }
        } elseif ($event->load($this->post())) {
            $user = User::findOne($event->userID);
            if ($user === null) {
                throw new NotFoundHttpException('User not found');
            }
        }

        if ($this->isPost() && $status == self::AJX_STATUS_OK) {
            $record = new EventUser();
            $record->eventID = $event->id;
            $record->userID = $user->id;
            $record->email = $user->email;
            $record->name = $user->fullName;
            $record->phone = $user->phone;
            if ($record->save()) {
                return $this->renderAjx('@adminViews/event/_registered-user-item', $this->t('User successfully created'), self::AJX_STATUS_OK, [
                    'record' => $record,
                ]);
            } else {
                $status = self::AJX_STATUS_ERROR;
            }
        }

        return $this->renderAjx('_add-user-to-event', '', $status, [
            'event' => $event,
            'user' => $user,
            'title' => $this->t('Add user'),
        ]);
    }

    public function actionSetUserEventRecordStatus($id)
    {
        if (!$this->isAjax()) {
            throw new BadRequestHttpException();
        }
        /** @var \models\EventUser */
        $record = EventUser::findOne($id);
        if ($record === null) {
            throw new NotFoundHttpException($this->t('Record not found'));
        }

        $status = $this->get('status') == 'true' ? EventUser::STATUS_CAME : EventUser::STATUS_NOT_CAME;
        if ($status == $record->status) {
            return $this->renderAjx(null, $this->t('Status already is "{status}"', ['status' => $status]), self::AJX_STATUS_OK);
        }

        $record->status = $status;

        if ($record->save()) {
            return $this->renderAjx(null, $this->t('Status successfully changed'), self::AJX_STATUS_OK);
        } else {
            return $this->renderAjx(null, $record->errors, self::AJX_STATUS_ERROR);
        }
    }

    public function actionAddTag()
    {
        if (!$this->isPost() || !$this->isPost()) {
            throw new BadRequestHttpException();
        }

        $ID = $this->get('entityID');
        $class = $this->get('entityClass');
        $tag = $this->post('tag');

        if (!$class || !$ID || !$tag) {
            throw new BadRequestHttpException();
        }

        if (Tag::addEntityTag($ID, $class, $tag)) {
            return $this->renderAjx(null, $this->t('Tag successfully added'), self::AJX_STATUS_OK);
        } else {
            return $this->renderAjx(null, $this->t('Can not add the tag'), self::AJX_STATUS_ERROR);
        }
    }

    public function actionRemoveTag()
    {
        if (!$this->isPost() || !$this->isPost()) {
            throw new BadRequestHttpException();
        }

        $ID = $this->get('entityID');
        $class = $this->get('entityClass');
        $tag = $this->post('tag');

        if (!$class || !$ID || !$tag) {
            throw new BadRequestHttpException();
        }

        if (Tag::removeEntityTag($ID, $class, $tag)) {
            return $this->renderAjx(null, $this->t('Tag successfully removed'), self::AJX_STATUS_OK);
        } else {
            return $this->renderAjx(null, $this->t('Can not remove the tag'), self::AJX_STATUS_ERROR);
        }
    }
}