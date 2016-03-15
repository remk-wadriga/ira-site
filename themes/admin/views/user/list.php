<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.03.2016
 * Time: 1:26
 *
 * @var components\View $this
 * @var models\search\UserSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = $this->t('Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-list">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($this->t('Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'avatarUrl',
                'value' => function (\models\User $model) {
                    if ($model->avatarUrl) {
                        return Html::img($model->avatarUrl, [
                            'class' => 'micro-img',
                            'alt' => $model->avatarAlt,
                        ]);
                    } else {
                        return null;
                    }
                },
                'format' => 'raw',
            ],
            'email:email',
            'fullName',
            [
                'attribute' => 'role',
                'value' => function (\models\User $model) {
                    return Html::activeDropDownList($model, 'role', $model->getRolesItems(), [
                        'class' => 'form-group change-user-role-dropdown',
                        'onchange' => 'Admin.changeUserRole($(this));',
                        'data' => [
                            'url' => Url::to(['/admin/user/change-role', 'id' => $model->id]),
                        ],
                    ]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'status',
                'value' => function (\models\User $model) {
                    return Html::activeDropDownList($model, 'status', $model->getStatusesItems(), [
                        'class' => 'form-group change-user-status-dropdown',
                        'onchange' => 'Admin.changeUserStatus($(this));',
                        'data' => [
                            'url' => Url::to(['/admin/user/change-status', 'id' => $model->id]),
                        ],
                    ]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'dateRegister',
                'value' => function (\models\User $model) {
                    return $this->dateTime($model->dateRegister);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>