<?php
/**
 * @var components\View $this
 * @var models\MailDelivery $model
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $this->t('Mail deliveries'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-delivery-view">

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
            'id',
            'authorID',
            'name',
            'title',
            'message:ntext',
            'dateCreate',
            'dateSend',
            'status',
        ],
    ]) ?>

</div>
