<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 13.03.2016
 * Time: 22:24
 *
 * @var components\View $this
 * @var models\Event $event
 * @var models\User $user
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($user, 'isRegistered')->checkbox([
        'class' => 'form-group field-user-isregistered toggle-element',
        'data' => [
            'target' => '#new_user_block,#registered_user_block',
        ],
    ]) ?>
<?php ActiveForm::end() ?>


<div id="new_user_block" class="row new-user-block<?= $user->isRegistered ? ' hide' : '' ?>">
    <?= $this->render('@siteViews/auth/_register-form', ['user' => $user]) ?>
</div>

<div id="registered_user_block" class="registered-user-block <?= !$user->isRegistered ? ' hide' : '' ?>">
    <?php $form = ActiveForm::begin(['id' => 'registered_user_form']) ?>
        <?= $form->field($event, 'userID')->dropDownList($event->getNotRegisteredUsersItems($this->t('Select user'))) ?>
        <?= Html::submitInput($this->t('Add'), ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?>
</div>

