<?php
/**
 * @var components\View $this
 * @var models\MailDelivery $model
 */

use yii\helpers\Html;

$this->title = $this->t('Create mail delivery');
$this->params['breadcrumbs'][] = ['label' => $this->t('Mail deliveries'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
