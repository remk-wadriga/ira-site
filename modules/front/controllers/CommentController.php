<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.03.2016
 * Time: 21:47
 */

namespace front\controllers;

use Yii;
use front\abstracts\ControllerAbstract;
use models\Comment;
use yii\web\BadRequestHttpException;
use yii\helpers\Json;

class CommentController extends ControllerAbstract
{
    public function actionCreate()
    {
        $comment = new Comment();

        if (!$this->isAjax() || !$comment->load($this->post())) {
            throw new BadRequestHttpException();
        }

        if ($comment->save()) {
            return $this->renderAjax('_item', [
                'comment' => $comment,
            ]);
        } else {
            return Json::encode([
                'errors' => $comment->errors,
            ]);
        }
    }
}