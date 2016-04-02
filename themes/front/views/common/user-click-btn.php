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
use models\UserClick;

switch ($type) {
    case UserClick::TYPE_LIKE:
        $word = 'like';
        $icon = 'fa-heart';
        break;
    default:
        $word = 'interesting';
        $icon = 'fa-check-circle-o';
        break;
}

$count = $model->getClicksCount($type, null);
if ($count > 0) {
    if ($model->getClicksCount($type) == 1) {
        $text = $count > 1 ? $this->t('It is {word} to you and {count} more users', ['word' => $word, 'count' => $count - 1]) : $this->t('It is {word} to you', ['word' => $word]);
        $title = $this->t('Refuse');
    } else {
        $text = $this->t('It is {word} to {count} users', ['word' => $word, 'count' => $count]);
        $title = $this->t('I\'m {word}', ['word' => $word]) . '!';
    }
} else {
    $text = $this->t($word) . '!';
    $title = $this->t('I\'m {word}', ['word' => $word]) . '!';
}
?>

<?= Html::a("<i class=\"fa {$icon}\"></i>" . $text, '#', [
    'title' => $title,
    'onclick' => 'Front.userClick($(this));Front.initTooltip();return false;',
    'data' => [
        'toggle' => 'tooltip',
        'type' => $type,
        'url' => Url::to(['/site/api/user-click', 'entityClass' => $model::className(), 'entityID' => $model->getID()]),
    ],
]) ?>