<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 20:05
 */

namespace admin\controllers;

use Yii;
use admin\abstracts\ControllerAbstract;
use models\Post;
use models\search\PostSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PostController extends ControllerAbstract
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

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->get());

        return $this->render([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render([
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Post();

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

        if ($model->load($this->post()) && $model->save()) {
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
        $post = $this->findModel($id);
        $post->status = $this->get('status');
        $post->setStoryAction($post::STORY_ACTION_STATUS_CHANGED);
        $post->setStoryFields('status');

        if ($post->save()) {
            $status = self::AJX_STATUS_OK;
            $message = $this->t('Story status changed');
        } else {
            $status = self::AJX_STATUS_ERROR;
            $message = $this->t('Can not change story status');
        }

        return $this->renderAjx(null, $message, $status);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}