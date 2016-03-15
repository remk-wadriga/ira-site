<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 16.03.2016
 * Time: 0:48
 *
 * @var components\View $this
 * @var models\User $user
 */

use yii\bootstrap\Html;

$this->title = $this->t('My profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-section form contact light">
    <div class="container account-page">
        <div class="row">
            <?= $this->render('@siteViews/auth/_register-form', ['user' => $user]) ?>
        </div>
    </div>
</section>
