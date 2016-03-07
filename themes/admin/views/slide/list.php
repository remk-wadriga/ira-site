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
                        'height' => $model->imgMinimalHeight,
                    ]);
                },
                'format' => 'raw',
            ],
            'title',
            //'linkUrl:url',
            //'linkText',
            [
                'attribute' => 'text',
                'format' => 'ntext',
                'options' => [
                    'width' => '300px',
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {status}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $icon = Html::tag('i', null, [
                            'class' => 'glyphicon glyphicon-eye-open',
                        ]);
                        return Html::a($icon . ' ' . $this->t('View'), $url, [
                            'class' => 'btn btn-primary',
                            'title' => $this->t('View'),
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        $icon = Html::tag('i', null, [
                            'class' => 'glyphicon glyphicon-pencil',
                        ]);
                        return Html::a($icon . ' ' . $this->t('Update'), $url, [
                            'class' => 'btn btn-success',
                            'title' => $this->t('Update'),
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        $icon = Html::tag('i', null, [
                            'class' => 'glyphicon glyphicon-trash',
                        ]);
                        return Html::a($icon . ' ' . $this->t('Delete'), $url, [
                            'class' => 'btn btn-danger',
                            'title' => $this->t('Delete'),
                            'data' => [
                                'method' => 'post',
                                'confirm' => $this->getConfirmDeleteText(),
                            ],
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