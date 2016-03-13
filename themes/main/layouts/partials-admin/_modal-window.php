<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 13.03.2016
 * Time: 19:18
 *
 * @var components\View $this
 */

use yii\bootstrap\Modal;
?>

<?php Modal::begin([
    'headerOptions' => ['id' => 'modal_header'],
    'id' => 'modal_window',
]); ?>

<div id="modal_content"></div>

<?php Modal::end(); ?>