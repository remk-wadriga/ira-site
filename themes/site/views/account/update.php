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
        <?php if (!Yii::$app->user->isSubscribed) : ?>
            <div class="row">
                <div class="pull-left">
                    <i class="alert-info"><?= $this->t('You are not subscribed to mail delivery') ?></i>
                </div>
                <div class="pull-right">
                    <?= Html::a($this->t('Subscribe'), ['/site/mail-delivery/subscribe'], [
                        'class' => 'btn btn-default navbar-btn',
                        'data' => [
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        <?php endif ?>
        <div class="row">
            <?= $this->render('@siteViews/auth/_register-form', ['user' => $user]) ?>
        </div>
    </div>
</section>
