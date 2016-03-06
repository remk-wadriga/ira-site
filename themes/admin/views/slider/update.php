<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:21
 *
 * @var components\View $this
 * @var models\Slider $model
 */

use yii\helpers\Html;

$this->title = $this->t('Update slider');
$this->params['breadcrumbs'][] = ['label' => $this->t('Sliders'), 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->t('Update');
?>
<div class="slider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>