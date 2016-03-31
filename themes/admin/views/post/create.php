<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 31.03.2016
 * Time: 20:40
 *
 * @var components\View $this
 * @var models\Blog $model
 */

use yii\helpers\Html;

$this->title = $this->t('Add post');
$this->params['breadcrumbs'][] = ['label' => $this->t('Posts'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>