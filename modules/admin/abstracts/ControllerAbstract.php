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

    public function redirect($url, $statusCode = 302)
    {
        Yii::$app->user->setReturnUrl(Yii::$app->request->url);
        return parent::redirect($url, $statusCode);
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
}