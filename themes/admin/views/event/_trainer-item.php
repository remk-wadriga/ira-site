<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 06.10.2016
 * Time: 2:46
 *
 * @var components\View $this
 * @var models\Event $event
 */

use yii\bootstrap\Html;

$trainers = [];
foreach ($event->trainers as $trainer) {
    $trainers[] = Html::a($trainer->fullName, ['/admin/user/view', 'id' => $trainer->id]);
}
?>

<div class="event-trainers">
    <?= implode(', ', $trainers) ?>
</div>
