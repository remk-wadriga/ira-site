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
<div class="Slide-view">

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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'value' => Html::img($model->imgUrl, [
                    'height' => $model->imgMinimalHeight,
                ]),
                'attribute' => 'img',
                'format' => 'raw',
            ],
            'linkUrl',
            'linkText',
            'linkTitle',
            'imgAlt',
            'text:ntext',
            [
                'value' => $model->statusName,
                'attribute' => 'status',
            ],
        ],
    ]) ?>

</div>