<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:06
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

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
            'name',
            'ownerName',
            'description:ntext',
            'membersCount',
            'address',
            'price:number',
            'profit:number',
            'cost:number',
            [
                'attribute' => 'type',
                'value' => $model->typeName,
            ],
            [
                'attribute' => 'status',
                'value' => $model->statusName,
            ],
            [
                'attribute' => 'dateStart',
                'value' => $this->dateTime($model->dateStart),
            ],
        ],
    ]) ?>

</div>