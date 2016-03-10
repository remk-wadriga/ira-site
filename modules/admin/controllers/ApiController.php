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
use models\Image;

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

    public function actionUploadImagesBlock()
    {
        /** @var \interfaces\FileModelInterface|\interfaces\ImagedEntityInterface static */
        $modelClass = $this->get('modelClass');

        if ($modelClass === null || !class_exists($modelClass)) {
            throw new BadRequestHttpException();
        }
        /** @var \interfaces\FileModelInterface|\interfaces\ImagedEntityInterface */
        $model = new $modelClass();

        return $this->renderAjax('upload-images-block', [
            'model' => $model,
        ]);
    }
}