<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 17.03.2016
 * Time: 18:06
 *
 * @var components\View $this
 * @var abstracts\ModelAbstract $model
 * @var array $tags
 */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use assets\TagsAsset;

$tags = array_merge([$this->t('All')], $tags);

if (is_array($model->tags)) {
    $selectedTags = $model->tags;
    $this->scriptParams = [
        'tags' => $model->tags,
    ];
    $model->tags = null;
} else {
    $selectedTags = [];
}

TagsAsset::register($this);
?>

<div class="hide">
    <?php $form = ActiveForm::begin([
        'id' => 'tags_filter_form',
        'method' => 'get',
    ]) ?>
        <?= $form->field($model, 'tags') ?>
    <?php ActiveForm::end() ?>
</div>

<?php foreach ($tags as $index => $tag) : ?>
    <?php
        $class = 'btn tag';
        if (in_array($tag, $selectedTags) || (empty($selectedTags) && $index == 0)) {
            $class .= ' active';
        }
    ?>
    <?= Html::a($tag, '#', [
        'class' => $class,
        'onclick' => 'return Tags.filterByTag($(this));',
        'data' => [
            'tag' => $index > 0 ? $tag : 0,
        ],
    ]) ?><br />
<?php endforeach ?>