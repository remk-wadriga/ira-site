<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:05
 *
 * @var components\View $this
 * @var models\search\EventSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = $this->t('Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($this->t('Create Event'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'mainImageUrl',
                'value' => function (models\Event $model) {
                    return Html::img($model->mainImageUrl, [
                        'class' => 'micro-img',
                    ]);
                },
                'format' => 'raw',
            ],
            'name',
            'ownerName',
            'price:number',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return $model->typeName;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Html::activeDropDownList($model, 'status', $model->getStatusesItems(), [
                        'id' => 'change_event_status_dropdown',
                        'class' => 'form-group',
                        'data' => [
                            'url' => Url::to(['/admin/event/change-status', 'id' => $model->id]),
                        ],
                    ]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'dateStart',
                'value' => function ($model) {
                    return $this->dateTime($model->dateStart);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>