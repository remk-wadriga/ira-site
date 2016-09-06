<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 20:41
 *
 * @var components\View $this
 * @var models\Post $model
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $this->t('Posts'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($this->t('Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($this->t('Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a($this->t('Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $this->getConfirmDeleteText(),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'imgUrl:image',
            'title',
            'text:raw',
            'citation:ntext',
            [
                'value' => $this->dateTime($model->dateCreate),
                'attribute' => 'dateCreate',
            ],
            'statusName',
            'url',
        ],
    ]) ?>

</div>