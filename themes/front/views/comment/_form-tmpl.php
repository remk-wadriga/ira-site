<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.03.2016
 * Time: 19:17
 *
 * @var components\View $this
 * @var abstracts\ModelAbstract $model
 * @var models\Comment $parent
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use models\Comment;

$comment = new Comment();
$comment->userID = Yii::$app->user->id;
$comment->entityClass = $model::className();
$comment->entityID = $model->getID();
if (isset($parent) && !$parent->isNewRecord) {
    $comment->parentID = $parent->id;
}
?>

<script id="comment_form_tmpl" type="text/x-jquery-tmpl">

    <div class="comment-form-container">
        <h6 class="anim fadeIn" data-wow-delay="0.24s">${name}</h6>
        <div class="form style-2 comment-form">
        <?php $form = ActiveForm::begin([
            'action' => ['/front/comment/create'],
            'fieldConfig' => [
                'template' => "<span class=\"input-group\">{input}</span>",
            ],
        ]) ?>

        <!--
        <?/*= $form->field($comment, 'title')->textInput([
            'class' => '${titleInputClass}',
            'placeholder' => $comment->getAttributeLabel('title'),
        ]) */?>
        -->

        <?= $form->field($comment, 'text')->textarea([
            'class' => 'lg',
        ]) ?>

        <?= Html::activeHiddenInput($comment, 'userID') ?>
        <?= Html::activeHiddenInput($comment, 'entityClass') ?>
        <?= Html::activeHiddenInput($comment, 'entityID') ?>
        <?= Html::activeHiddenInput($comment, 'parentID', [
            'value' => '${parentID}',
        ]) ?>

        <?= Html::submitInput($this->t('Post'), [
            'class' => 'btn btn-sm btn-primary icon anim fadeIn',
        ]) ?>

        <?php ActiveForm::end() ?>
        </div>
    </div>

</script>


