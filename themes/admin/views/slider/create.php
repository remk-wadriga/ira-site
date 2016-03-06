<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 2:21
 *
 * @var components\View $this
 * @var models\Slide $model
 */

use yii\helpers\Html;

$this->title = $this->t('Create Slide');
$this->params['breadcrumbs'][] = ['label' => 'Slides', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Slide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>