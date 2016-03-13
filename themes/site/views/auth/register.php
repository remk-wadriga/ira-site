<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.03.2016
 * Time: 18:20
 *
 * @var components\View $this
 * @var models\User $user
 */

use yii\helpers\Html;

$this->title = $this->t('Register');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="register-page">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= $this->t('Please fill out the following fields to register') ?>:</p>

    <div class="col-lg-5">
        <?= $this->render('_register-form', ['user' => $user]) ?>
    </div>

</div>


