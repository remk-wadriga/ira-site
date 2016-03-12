<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 19:53
 *
 * @var components\View $this
 * @var models\Event $model
 * @var models\EventUser $form
 */

use yii\bootstrap\Html;

$this->title = $model->name;
$this->subtitle = $this->t('Register to {type}', ['type' => lcfirst($model->getTypeName())]);

$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['/front/event/list']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/front/event/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->subtitle;
?>

<section class="content-section anim fadeInDown">
    <div class="container">
        <h1><i class="fa fa-pencil-square-o"></i><?= $this->t('Complete the registration form') ?></h1>
    </div>
</section><!-- .content-section -->


<section class="content-section form contact light">
    <div class="container">

        <span id="message"></span><!-- remove #message to stop floating jQuery messages -->

        <?= $this->render('_register-form', [
            'model' => $form,
        ]) ?>
    </div><!-- .container -->

    <span id="message_sent"><i class="fa-check fa"></i></span><!-- jQuery display of giant checkmark -->

</section><!-- .content-section .form -->








