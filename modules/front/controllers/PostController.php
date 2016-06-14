<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.04.2016
 * Time: 16:23
 */

namespace front\controllers;

use Yii;
use front\abstracts\ControllerAbstract;
use models\search\PostSearch;
use models\Tag;
use models\Post;
use yii\web\NotFoundHttpException;

class PostController extends ControllerAbstract
{
    public function actionList()
    {
        $searchModel = new PostSearch();
        $params = $this->get();
        $dataProvider = $searchModel->search($params);

        return $this->render([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags' => Tag::getEntityTags(Post::className()),
        ]);
    }

    public function actionView($id)
    {
        if ((int)$id > 0) {
            $condition = $id;
        } else {
            $condition = ['url' => $id];
        }

        $model = $this->findModel($condition);

        return $this->render([
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return Post
     * @throws NotFoundHttpException
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