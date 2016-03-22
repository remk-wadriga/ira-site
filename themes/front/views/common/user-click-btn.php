<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 22.03.2016
 * Time: 18:35
 *
 * @var components\View $this
 * @var interfaces\UserClickInterface $model
 * @var string $type
 */

use yii\helpers\Url;
use yii\bootstrap\Html;

$count = $model->getClicksCount($type, null);
if ($count > 0) {
    if ($model->getClicksCount($type) == 1) {
        $text = $count > 1 ? $this->t('It is interesting to you and {count} more users', ['count' => $count - 1]) : $this->t('It is interesting to you');
        $title = $this->t('Refuse');
    } else {
        $text = $this->t('It is interesting to {count} users', ['count' => $count]);
        $title = $this->t('I\'m interested') . '!';
    }
} else {
    $text = $this->t('This is interesting') . '!';
    $title = $this->t('I\'m interested') . '!';
}


?>

<?= Html::a('<i class="fa fa-check-circle-o"></i>' . $text, '#', [
    'title' => $title,
    'onclick' => 'Front.userClick($(this));Front.initTooltip();return false;',
    'data' => [
        'toggle' => 'tooltip',
        'type' => $type,
        'url' => Url::to(['/site/api/user-click', 'entityClass' => $model::className(), 'entityID' => $model->getID()]),
    ],
]) ?>