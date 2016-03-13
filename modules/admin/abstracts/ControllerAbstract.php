<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 21:25
 */

namespace admin\abstracts;

use Yii;
use abstracts\ControllerAbstract as BaseController;
use yii\helpers\Json;

abstract class ControllerAbstract extends BaseController
{
    const AJX_STATUS_OK = 'OK';
    const AJX_STATUS_ERROR = 'ERROR';

    const SESSION_IMAGES_KEY = 'SK_uploaded_images';

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!Yii::$app->user->isAdmin) {
            return $this->redirect(['/site/auth/login']);
        }

        return true;
    }

    public function renderAjx($view = null, $message = null, $status = null, $params = [])
    {
        if ($status === null) {
            $status = self::AJX_STATUS_OK;
        }
        if ($message === null) {
            $message = 'SUCCESS';
        }

        if ($view === null) {
            return Json::encode(array_merge($params, [
                'status' => $status,
                'message' => $message,
            ]));
        } else {
            return Json::encode([
                'status' => $status,
                'message' => $message,
                'content' => $content = $this->renderPartial($view, $params),
            ]);
        }
    }

    protected function getUploadedImagesFromSession($modelClass)
    {
        $key = $modelClass . ':' . self::SESSION_IMAGES_KEY;
        return (array)Yii::$app->session->get($key);
    }

    protected function addUploadedImagesToSession($modelClass, $images)
    {
        if (!is_array($images)) {
            $images = [$images];
        }
        $session = Yii::$app->session;
        $key = $modelClass . ':' . self::SESSION_IMAGES_KEY;
        $sessionImages = $session->get($key);
        if (!is_array($sessionImages)) {
            $sessionImages = [];
        }
        $session->set($key, array_merge($sessionImages, $images));
    }

    protected function removeUploadedImagesFromSession($modelClass, $images = null)
    {
        if (!is_array($images) && $images !== null) {
            $images = [$images];
        }
        $key = $modelClass . ':' . self::SESSION_IMAGES_KEY;
        $session = Yii::$app->session;
        $sessionImages = $session->get($key);
        if (!is_array($sessionImages)) {
            $sessionImages = [];
        }
        if ($images !== null) {
            $session->set($key, array_diff($sessionImages, $images));
        } else {
            $session->set($key, []);
        }
    }
}