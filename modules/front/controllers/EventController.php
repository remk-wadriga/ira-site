<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 20:54
 */

namespace front\controllers;

use Yii;
use front\abstracts\ControllerAbstract;
use models\search\EventSearch;

class EventController extends ControllerAbstract
{
    public function actionList()
    {
        $searchModel = new EventSearch();
        $params = $this->params();
        $dataProvider = $searchModel->search($params);

        return $this->render([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}