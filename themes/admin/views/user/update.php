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

$this->title = $this->t('Update User {name}', ['name' => $model->fullName]);
$this->params['breadcrumbs'][] = ['label' => $this->t('Users'), 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->fullName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->t('Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>