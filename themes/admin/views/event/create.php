<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 09.03.2016
 * Time: 16:04
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;

$this->title = $this->t('Create event');
$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>