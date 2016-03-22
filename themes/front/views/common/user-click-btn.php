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
?>

<?= Html::a('<i class="fa fa-check-circle-o"></i>' . ($count > 0 ? ' ' . $count : $this->t('This is interesting') . '!'), '#', [
    'title' => $count > 0 ? $this->t('This is interesting! ({count} person)', ['count' => $count]) : $this->t('This is interesting') . '!',
    'onclick' => 'return Front.userClick($(this));',
    'data' => [
        'toggle' => 'tooltip',
        'type' => $type,
        'url' => Url::to(['/site/api/user-click', 'entityClass' => $model::className(), 'entityID' => $model->getID()]),
    ],
]) ?>