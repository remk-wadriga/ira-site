<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 02.04.2016
 * Time: 16:38
 *
 * @var components\View $this
 * @var models\search\PostSearch $model
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

    <h4 class="anim fadeInRight">
        <?= $this->t('Search') ?><i class="fa fa-th-list"></i>
    </h4>
<?php $form = ActiveForm::begin([
    'id' => 'search_post_form',
    'method' => 'GET',
]) ?>

    <span class="search-wrapper anim fadeInRight">
        <?= Html::activeTextInput($model, 'searchText', [
            'class' => 'search',
            'placeholder' => $this->t('Enter the post name'),
        ]) ?>
        <i class="fa fa-search"></i>
    </span>

<?php ActiveForm::end(); ?>