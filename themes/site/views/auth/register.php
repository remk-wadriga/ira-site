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

<section class="content-section form contact light">
    <div class="container register-page">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <?= $this->render('_register-form', ['user' => $user]) ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</section>