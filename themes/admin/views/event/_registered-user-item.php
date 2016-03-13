<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 13.03.2016
 * Time: 23:46
 *
 * @var components\View $this
 * @var models\EventUser $record
 */

use yii\bootstrap\Html;
use yii\helpers\Url;
?>

<tr>
    <td><?= $record->email ?></td>
    <td><?= $record->name ?></td>
    <td><?= $this->dateTime($record->dateRegistration) ?></td>
    <td>
        <?php if (!$record->isRegisteredUser()) : ?>
            <?= Html::a($this->t('Register'), ['/admin/api/register-user-by-event-record', 'id' => $record->id], [
                'id' => "register_user_btn_{$record->id}",
                'class' => 'btn btn-success',
                'onclick' => 'return Admin.registerUserByEventRecord($(this));',
                'data' => [
                    'form' => '#register_form',
                    'remove' => "#register_user_btn_{$record->id}",
                ],
            ]) ?>
        <?php else : ?>
            <?= Html::checkbox('registrationStatus', $record->status == $record::STATUS_CAME, [
                'onclick' => 'Admin.setUserEventRecordStatus($(this));',
                'data' => [
                    'url' => Url::to(['/admin/api/set-user-event-record-status', 'id' => $record->id]),
                ],
            ]) ?>
        <?php endif ?>
    </td>
</tr>