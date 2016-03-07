<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:22
 *
 * @var components\View $this
 * @var models\Slide $model
 */

use yii\bootstrap\Html;
use yii\widgets\DetailView;

$this->title = $this->t('Slide "{name}"', ['name' => $model->title]);
$this->params['breadcrumbs'][] = ['label' => $this->t('Slides'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($this->t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($this->t('Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $this->t('Are you sure you want to delete this item') . '?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a($this->t('Create new slide'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="text-center-align">
        <?= Html::img($model->imgUrl, [
            'class' => 'big-img',
        ]) ?>
    </div>

    <br />

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'text:ntext',
            [
                'value' => $model->statusName,
                'attribute' => 'status',
            ],
            'linkUrl',
            'linkText',
            'linkTitle',
            'imgAlt',
        ],
    ]) ?>

</div>