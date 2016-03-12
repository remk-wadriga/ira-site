<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 12.03.2016
 * Time: 17:41
 *
 * @var components\View $this
 * @var models\search\EventSearch $model
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

<h4 class="anim fadeInRight">
    <?= $this->t('Search') ?><i class="fa fa-th-list"></i>
</h4>
<?php $form = ActiveForm::begin([
    'id' => 'search_event_form',
    'method' => 'GET',
]) ?>

    <span class="search-wrapper anim fadeInRight">
        <?= Html::activeTextInput($model, 'searchText', [
            'class' => 'search',
            'placeholder' => $this->t('Enter the event name'),
        ]) ?>
        <i class="fa fa-search"></i>
    </span>

<?php ActiveForm::end(); ?>
