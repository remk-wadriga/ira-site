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
use models\Event;
use models\EventUser;
use yii\web\NotFoundHttpException;

class EventController extends ControllerAbstract
{
    protected $redirectActions = [
        'list',
        'view',
    ];

    public function actionList()
    {
        $searchModel = new EventSearch();
        $searchModel->pageSize = Yii::$app->params['frontEventsPerPage'];
        $params = $this->params();
        $dataProvider = $searchModel->search($params);

        return $this->render([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render([
            'model' => $model,
        ]);
    }

    public function actionRegister($id)
    {
        $model = $this->findModel($id);
        $form = new EventUser();
        $form->eventID = $model->id;

        $user = Yii::$app->user;
        if (!$user->isGuest) {
            $form->userID = $user->id;
            $form->email = $user->email;
            $form->name = $user->fullName;
            $form->phone = $user->phone;
        }

        if ($form->load($this->post()) && $form->save()) {
            return $this->goBack();
        }

        return $this->render([
            'model' => $model,
            'form' => $form,
        ]);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}