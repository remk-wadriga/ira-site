<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:16
 */

namespace admin\controllers;

use Yii;
use models\Slide;
use models\search\SlideSearch;
use admin\abstracts\ControllerAbstract;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SlideController implements the CRUD actions for Slide model.
 */
class SlideController extends ControllerAbstract
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
        $searchModel = new SlideSearch();
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
        $model = new Slide();

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
        $slide = $this->findModel($id);

        $status = $this->get('isActive') == 'true' ? Slide::STATUS_ACTIVE : Slide::STATUS_NOT_ACTIVE;

        if ($status == $slide->status) {
            return Json::encode([
                'status' => 'OK',
                'message' => $this->t('Title slide has status "{name}"', ['name' => $slide->getStatusName()]),
            ]);
        }

        $slide->status = $status;
        if ($slide->save()) {
            $status = self::AJX_STATUS_OK;
            $message = $status == Slide::STATUS_ACTIVE ? $this->t('Slide successfully activated') : $this->t('Slide successfully deactivated');
        } else {
            $status = self::AJX_STATUS_ERROR;
            Yii::$app->response->setStatusCode(500);
            $message = $status == Slide::STATUS_ACTIVE ? $this->t('Can not activate slide') : $this->t('Can not deactivate slide');
        }

        return $this->renderAjx(null, $message, $status);
    }

    /**
     * Finds the Slide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Slide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}