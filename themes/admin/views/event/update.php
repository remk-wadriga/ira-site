<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:05
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;

$this->title = $this->t('Update event "{name}"', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->t('Update');

?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>