<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 20:08
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;

$this->title = $model->name;
$this->subtitle = $model->name;

$this->params['breadcrumbs'][] = ['label' => $this->t('Events'), 'url' => ['/front/event/list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= lcfirst($model->getTypeName()) ?></h1>