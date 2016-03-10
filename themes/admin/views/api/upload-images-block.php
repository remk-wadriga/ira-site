<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 11.03.2016
 * Time: 1:25
 *
 * @var components\View $this
 */

use dosamigos\fileupload\FileUploadUI;
?>

<?= FileUploadUI::widget([
    'model' => $model,
    'attribute' => 'img',
    'url' => ['/admin/api/upload-image', 'modelClass' => $model::className(), 'id' => $model->id],
    'gallery' => false,
]) ?>
