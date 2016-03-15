<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.03.2016
 * Time: 1:23
 */

namespace admin\controllers;

use Yii;
use models\User;
use models\search\UserSearch;
use admin\abstracts\ControllerAbstract;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ControllerAbstract
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
        $searchModel = new UserSearch();
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
        $model = new User();

        $model->setStoryAction($model::STORY_ACTION_CREATED);

        if ($model->load($this->post()) && $model->save()) {
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

        $model->setStoryAction($model::STORY_ACTION_UPDATED);

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

    public function actionChangeRole($id)
    {
        $user = $this->findModel($id);
        $role = $this->get('role');
        if ($user->role == $role) {
            return $this->renderAjx(null, $this->t('Role already is {role}', ['role' => $role]), self::AJX_STATUS_OK);
        }

        $user->role = $role;
        if ($user->save()) {
            return $this->renderAjx(null, $this->t('Role successfully changed'), self::AJX_STATUS_OK);
        } else {
            return $this->renderAjx(null, $user->errors, self::AJX_STATUS_ERROR);
        }
    }

    public function actionChangeStatus($id)
    {
        $user = $this->findModel($id);
        $status = $this->get('status');
        if ($user->status == $status) {
            return $this->renderAjx(null, $this->t('Status already is {status}', ['status' => $status]), self::AJX_STATUS_OK);
        }

        $user->status = $status;
        if ($user->save()) {
            return $this->renderAjx(null, $this->t('Status successfully changed'), self::AJX_STATUS_OK);
        } else {
            return $this->renderAjx(null, $user->errors, self::AJX_STATUS_ERROR);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}