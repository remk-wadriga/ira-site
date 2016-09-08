<?php

namespace admin\controllers;

use Yii;
use admin\abstracts\ControllerAbstract;
use models\MailDelivery;
use models\search\MailDeliverySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use helpers\MailHelper;

class MailDeliveryController extends ControllerAbstract
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionList()
    {
        $searchModel = new MailDeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $model = new MailDelivery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        $delivery = $this->findModel($id);
        $status = $this->get('status');
        if ($status == $delivery->status) {
            $error = $this->t('Delivery status already is "{status}"', ['status' => $status]);
            return $this->renderAjx(null, $error, self::AJX_STATUS_ERROR);
        }
        $delivery->setStoryFields('status');
        
        switch ($delivery->status) {
            case $delivery::STATUS_NEW:
                $message = 'Delivery is activated';
                $error = 'Can not activate delivery';
                $delivery->setStoryAction($delivery::STORY_ACTION_ACTIVATED);
                break;
            case $delivery::STATUS_CURRENT:
                $delivery->status = $status;
                if (!$delivery->canStarted) {
                    $error = $this->t('Can not start delivery with status "{status}"', ['status' => $delivery->status]);
                    return $this->renderAjx(null, $error, self::AJX_STATUS_ERROR);
                }
                $message = 'Delivery is started';
                $error = 'Can not start delivery';
                $delivery->setStoryAction($delivery::STORY_ACTION_STARTED);
                break;
            case $delivery::STATUS_PAST:
            case $delivery::STATUS_CANCELLED:
                $message = 'Delivery is cancelled';
                $error = 'Can not cancel delivery';
                $delivery->setStoryAction($delivery::STORY_ACTION_CANCELED);
                break;
            default:
                $error = $this->t('Invalid status "{status}"', ['status' => $status]);
                return $this->renderAjx(null, $error, self::AJX_STATUS_ERROR);
                break;
        }

        $delivery->status = $status;

        if ($delivery->save()) {
            $status = self::AJX_STATUS_OK;
        } else {
            $status = self::AJX_STATUS_ERROR;
            $message = $error;
        }

        return $this->renderAjx(null, $message, $status);
    }

    /**
     * Finds the MailDelivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MailDelivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MailDelivery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
