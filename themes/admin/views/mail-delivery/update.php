<?php
/**
 * @var components\View $this
 * @var models\MailDelivery $model
 */

use yii\helpers\Html;

$this->title = $this->t('Update mail delivery "{name}"', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => $this->t('Mail deliveries'), 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->t('Update');
?>
<div class="mail-delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
