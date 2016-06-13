<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.03.2016
 * Time: 22:34
 *
 * @var components\View $this
 */

use yii\bootstrap\Html;

$this->title = $this->t('Admin panel');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-6">
        <?= Html::a('<i class="fa fa-sliders"></i> ' . $this->t('Slides'), ['/admin/slide/list'], [
            'class' => 'panel-block',
        ]) ?>
    </div>
    <div class="col-lg-6">
        <?= Html::a('<i class="fa fa-calendar-check-o"></i> ' . $this->t('Events'), ['/admin/event/list'], [
            'class' => 'panel-block',
        ]) ?>
    </div>
    <div class="col-lg-6">
        <?= Html::a('<i class="fa fa-pencil-square-o"></i> ' . $this->t('Blog'), ['/admin/post/list'], [
            'class' => 'panel-block',
        ]) ?>
    </div>
    <div class="col-lg-6">
        <?= Html::a('<i class="fa fa-users"></i> ' . $this->t('Users'), ['/admin/user/list'], [
            'class' => 'panel-block',
        ]) ?>
    </div>
</div>