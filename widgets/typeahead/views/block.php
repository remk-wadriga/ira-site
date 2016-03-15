<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 15.03.2016
 * Time: 2:05
 *
 * @var components\View $this
 * @var abstracts\ModelAbstract $entity
 * @var string[] $tags
 * @var string $class
 * @var string $inputClass
 *
 */

use yii\bootstrap\ActiveForm;
?>

<div class="<?= $class ?>">

    <div class="row tags-block">
        <?php foreach ($tags as $tag) : ?>
            <?= $tag ?>,
        <?php endforeach ?>
    </div>

    <div class="row form-block">
        <?php $form = ActiveForm::begin([
            'id' => 'tag_form',
            'action' => ['/admin/api/add-tag', 'entityClass' => $entity::className(), 'entityID' => $entity->getID()],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-10\">{input}\n<p>{error}</p></div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]) ?>

        <?= $form->field($entity, 'tag')->textInput([
            'class' => 'form-control ' . $inputClass,
        ])->label($this->t('Add tag')) ?>

        <?php ActiveForm::end() ?>
    </div>

</div>

