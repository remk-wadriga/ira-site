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
$count = count($event->interestedUsers);
$countText = $this->t('Total: {count}', ['count' => $count]);
if ($count < 200) {
    foreach ($event->interestedUsers as $user) {
        $names[] = Html::a($user->fullName, ['/admin/user/view', 'id' => $user->id]);
    }
}
?>

<div class="event-interested-users">
    <?php if ($count < 200) : ?>
        <?php if ($count > 10) : ?>
            <?= Html::a($this->t('Show users list'), '#', [
                'class' => 'toggle-element',
                'data' => [
                    'target' => '.event-interested-users-list',
                ],
            ]) ?>
        <?php endif ?>
        <div class="list event-interested-users-list<?= $count > 10 ? ' hide' : '' ?>">
            <?= implode(', ', $names) ?>
        </div>
    <?php endif ?>
    <div class="count event-interested-users-count">
        <?= Html::a($countText, ['/admin/event/interested-users-list', 'id' => $event->id]) ?>
    </div>
</div>