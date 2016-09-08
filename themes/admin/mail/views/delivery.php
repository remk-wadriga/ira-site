<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 07.09.2016
 * Time: 13:00
 * 
 * @var components\View $this
 * @var string $message
 * @var string $unfollowUrl
 */

use yii\helpers\Html;
?>

<h2>Message:</h2>
<h2><?= $message ?>/h2>
<p><?= Html::a(Yii::t('mail', 'Unfollow from mail delivery'), $unfollowUrl) ?></p>