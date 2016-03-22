<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 22.03.2016
 * Time: 20:41
 *
 * @var components\View $this
 * @var models\Event $event
 */

use yii\bootstrap\Html;

$names = [];
foreach ($event->interestedUsers as $user) {
    $names[] = Html::a($user->fullName, ['/admin/user/view', 'id' => $user->id]);
}
?>

<div class="event-interested-users">
    <div class="list event-interested-users-list">
        <?= implode(', ', $names) ?>
    </div>
    <div class="count event-interested-users-count">
        <?= $this->t('Total: {count}', ['count' => $event->interestedUsersCount]) ?>
    </div>
</div>