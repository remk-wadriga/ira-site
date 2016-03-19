<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.03.2016
 * Time: 20:55
 *
 * @var components\View $this
 * @var abstracts\ModelAbstract $model
 * @var models\Comment $parent
 */

use yii\bootstrap\Html;
use yii\helpers\Json;

if (isset($parent) && !$parent->isNewRecord) {
    $name = $this->t('Reply');
    $commentsBlockID = 'comments_block_' . str_replace('\\', '_', $parent::className()) . '_' . $parent->id;
    $paramsString = Json::encode([
        'parentID' => $parent->id,
        'name' => $name,
        'titleInputClass' => 'hide',
    ]);
} else {
    $name = $this->t('Leave the comment');
    $commentsBlockID = 'comments_block_' . str_replace('\\', '_', $model::className()) . '_' . $model->getID();
    $paramsString = Json::encode([
        'parentID' => null,
        'name' => $name,
        'titleInputClass' => 'lg',
    ]);
}
?>

<?= Html::a($name, '#', [
    'class' => 'btn btn-primary leave-comment-btn',
    'onclick' => "return Front.getCommentForm($(this), {$paramsString});",
    'data' => [
        'comments-block' => '#' . $commentsBlockID,
    ],
]) ?>
