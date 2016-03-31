<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 20:41
 *
 * @var components\View $this
 * @var models\Post $model
 */

use yii\helpers\Html;

$this->title = $this->t('Update post "{title}"', ['title' => $model->title]);
$this->params['breadcrumbs'][] = ['label' => $this->t('Posts'), 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->t('Update');
?>
<div class="blog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>