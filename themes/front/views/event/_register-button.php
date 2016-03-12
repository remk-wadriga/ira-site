<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 17:58
 *
 * @var components\View $this
 * @var models\Event $model
 */

use yii\bootstrap\Html;
?>

<?= Html::a($this->t('Register') . ' <i class="glyphicon glyphicon-registration-mark"></i>', ['/front/event/register', 'id' => $model->id], [
    'class' => 'btn btn-sm btn-primary icon',
    'role' => 'button',
    'data' => [
        'wow-delay' => '.45s',
    ],
]) ?>
