<?php
/**
 * @var components\View $this
 * @var models\search\MailDeliverySearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = $this->t('Mail deliveries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-delivery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($this->t('Create mail delivery'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'imgUrl',
                'value' => function (models\MailDelivery $model) {
                    return Html::img($model->imgUrl, [
                        'class' => 'micro-img',
                    ]);
                },
                'format' => 'raw',
            ],
            'authorName',
            'name',
            'title',
            [
                'attribute' => 'dateCreate',
                'value' => function ($model) {
                    return $this->dateTime($model->dateCreate);
                },
            ],
            [
                'attribute' => 'dateSend',
                'value' => function ($model) {
                    return $this->dateTime($model->dateSend);
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Html::activeDropDownList($model, 'status', $model->getStatusesItems(), [
                        'class' => 'form-group change-event-status-dropdown',
                        'onchange' => 'Admin.changeMailDeliveryStatus($(this));',
                        'data' => [
                            'url' => Url::to(['/admin/mail-delivery/change-status', 'id' => $model->id]),
                        ],
                    ]);
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
