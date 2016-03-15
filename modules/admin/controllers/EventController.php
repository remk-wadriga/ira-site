<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:00
 */

namespace admin\controllers;

use Yii;
use models\Event;
use models\search\EventSearch;
use admin\abstracts\ControllerAbstract;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends ControllerAbstract
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionList()
    {
        $searchModel = new EventSearch();
        $searchModel->pageSize = Yii::$app->params['adminEventsPerPage'];
        $dataProvider = $searchModel->search($this->get());

        return $this->render([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render([
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Event();

        // Add to Event saved in session (and already uploaded) images urls
        $model->imagesUrls = $this->getUploadedImagesFromSession($model::className());

        if ($model->load($this->post()) && $model->save()) {
            // Remove form session uploaded images urls
            $this->removeUploadedImagesFromSession($model::className());

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render([
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Add to Event saved in session (and already uploaded) images urls
        $model->imagesUrls = $this->getUploadedImagesFromSession($model::className());

        if ($model->load($this->post()) && $model->save()) {
            // Remove form session uploaded images urls
            $this->removeUploadedImagesFromSession($model::className());

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render([
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['list']);
    }

    public function actionChangeStatus($id)
    {
        $event = $this->findModel($id);
        $event->status = $this->get('status');
        $event->setStoryAction();
        $event->setStoryFields('status');

        if ($event->save()) {
            $status = self::AJX_STATUS_OK;
            $message = $this->t('Event status changed');
        } else {
            $status = self::AJX_STATUS_ERROR;
            $message = $this->t('Can not change event status');
        }

        return $this->renderAjx(null, $message, $status);
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