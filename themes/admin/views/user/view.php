<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 14.03.2016
 * Time: 1:27
 *
 * @var components\View $this
 * @var models\User $model
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => $this->t('Users'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'email:email',
            'fullName',
            'phone',
            'avatar',
            'role',
            'status',
            'info:ntext',
            [
                'attribute' => 'dateRegister',
                'value' => $this->dateTime($model->dateRegister),
            ],
        ],
    ]) ?>

</div>