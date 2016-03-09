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
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;

class ApiController extends ControllerAbstract
{
    public function actionUploadImage()
    {
        /** @var \interfaces\FileModelInterface */
        $modelClass = $this->get('modelClass');
        $id = $this->get('id');

        if ($modelClass === null || $id === null || !class_exists($modelClass)) {
            throw new BadRequestHttpException();
        }

        if ($id > 0) {
            $model = $modelClass::findOne($id);
            if ($model === null) {
                throw new BadRequestHttpException();
            }
        } else {
            $model = new $modelClass();
        }

        if (Yii::$app->file->loadFile($model)) {
            return Json::encode([
                'files' => [
                    [
                        'name' => '',
                        'size' => 0,
                        'url' => $model->img,
                        'thumbnailUrl' => $model->img,
                        'deleteUrl' => Url::to(['/admin/api/remove-image', 'image' => $model->img]),
                        'deleteType' => 'POST',
                    ],
                ],
            ]);
        } else {
            return Json::encode([
                'message' => $this->t('Can not upload the file'),
            ]);
        }
    }
}