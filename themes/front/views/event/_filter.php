<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 17:55
 *
 * @var components\View $this
 * @var models\search\EventSearch $model
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
?>

<ul class="comments-wrapper">
    <li>
        <ul class="comments">
            <?php foreach ($model->getTypesItems($this->t('All')) as $type => $name) : ?>
                <?php
                $class = 'event-filter-btn filter-btn btn-bordered';
                if ($type === 0) {
                    $type = '';
                }
                if ($type == (string)$model->filterType) {
                    $class .= ' hot';
                }
                ?>
                <?= Html::tag('li', $name, [
                    'class' => $class,
                    'role' => 'button',
                    'data' => [
                        'filter' => $type,
                        'form' => '#filter_event_form',
                    ],
                ]) ?>
            <?php endforeach ?>
        </ul><!-- .comments -->
    </li>
</ul><!-- .comments-wrapper -->

<div class="hide">
    <?php $form = ActiveForm::begin([
        'id' => 'filter_event_form',
        'method' => 'GET',
    ]) ?>
    <?= Html::activeTextInput($model, 'filterType') ?>
    <?php ActiveForm::end(); ?>
</div>
