<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 22.03.2016
 * Time: 18:21
 */

namespace site\controllers;

use Yii;
use site\abstracts\ControllerAbstract;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use models\UserClick;
use yii\web\NotFoundHttpException;

class ApiController extends ControllerAbstract
{
    public function actionUserClick()
    {
        if (!$this->isAjax() || !$this->isPost()) {
            throw new BadRequestHttpException();
        }

        $type = $this->post('type');
        $entityClass = $this->get('entityClass');
        $entityID = $this->get('entityID');

        if (!$type || !$entityClass || !$entityID || !class_exists($entityClass)) {
            throw new BadRequestHttpException();
        }

        $model = $entityClass::findOne($entityID);
        if ($model === null) {
            throw new NotFoundHttpException($this->t('Can not find entity'));
        }

        if (UserClick::click($type, $entityClass, $entityID)) {
            return $this->renderAjax('@common/user-click-btn', [
                'model' => $model,
                'type' => $type,
            ]);
        } else {
            return Json::encode([
                'error' => $this->t('Can not set the click'),
            ]);
        }
    }
}