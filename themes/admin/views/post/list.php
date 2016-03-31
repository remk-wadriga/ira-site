<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 20:40
 *
 * @var components\View $this
 * @var models\search\PostSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = $this->t('Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($this->t('Add post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'img',
                'value' => function (\models\Post $model) {
                    return Html::img($model->getImgUrl(), [
                        'class' => 'micro-img',
                    ]);
                },
                'format' => 'raw',
            ],
            'title',
            [
                'attribute' => 'createDate',
                'value' => function (\models\Post $model) {
                    return $this->dateTime($model->dateCreate);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (\models\Post $model) {
                    return Html::activeDropDownList($model, 'status', $model->getStatusesItems(), [
                        'class' => 'form-group change-event-status-dropdown',
                        'onchange' => 'Admin.changePostStatus($(this));',
                        'data' => [
                            'url' => Url::to(['/admin/post/change-status', 'id' => $model->id]),
                        ],
                    ]);
                },
                'format' => 'raw',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>