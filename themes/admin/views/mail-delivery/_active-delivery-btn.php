<?php
/**
 * @var components\View $this
 * @var models\MailDelivery $model
 */

use yii\helpers\Html;
?>

<?php if ($model->canStarted) : ?>
    <?= Html::a($this->t('Start delivery'), ['change-status', 'id' => $model->id], [
        'class' => 'btn btn-info',
        'onclick' => 'return Admin.activateMailDelivery($(this));',
        'data' => [
            'status' => $model::STATUS_CURRENT,
        ],
    ]) ?>
<?php endif ?>
