<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:21
 *
 * @var components\View $this
 * @var models\search\SlideSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\grid\GridView;

$this->title = $this->t('Slides');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Slide-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($this->t('Create Slide'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'img',
                'value' => function (models\Slide $model) {
                    return Html::img($model->imgUrl, [
                        'height' => 100,
                    ]);
                },
                'format' => 'raw',
            ],
            'title',
            'linkUrl:url',
            'linkText',
            //'text:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view} {status}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $icon = Html::tag('i', null, [
                            'class' => 'glyphicon glyphicon-pencil',
                        ]);
                        return Html::a($icon . ' ' . $this->t('Update'), $url, [
                            'class' => 'btn btn-primary',
                            'title' => $this->t('Update'),
                        ]);
                    },
                    'view' => function ($url, $model, $key) {
                        $icon = Html::tag('i', null, [
                            'class' => 'glyphicon glyphicon-eye-open',
                        ]);
                        return Html::a($icon . ' ' . $this->t('View'), $url, [
                            'class' => 'btn btn-primary',
                            'title' => $this->t('View'),
                        ]);
                    },
                    'status' => function ($url, $model, $key) {
                        return Html::checkbox($model::modelName() . '[status]', $model->isActive, [
                            'id' => 'change_status_checkbox_' . $model->id,
                            'class' => 'checkbox-switch',
                            'data' => [
                                'url' => Url::to(['/admin/slide/change-status', 'id' => $model->id]),
                                'onchange' => 'Admin.changeSlideStatus({this})',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>