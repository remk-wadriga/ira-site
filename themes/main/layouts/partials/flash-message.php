<?php
/**
 * Created by PhpStorm.
 * User: Rem
 * Date: 18.09.2016
 * Time: 19:15
 *
 * @var components\View $this
 */

$flashes = Yii::$app->session->allFlashes;
?>

<?php if (!empty($flashes)) : ?>
    <div class="row">
        <div class="col-lg-5">
            <?php foreach ($flashes as $key => $messages) : ?>
                <?php
                $messages = (array)$messages;
                switch ($key) {
                    case 'error':
                        $class = 'alert alert-danger';
                        $icon = 'glyphicon glyphicon-remove-sign';
                        break;
                    case 'warning':
                        $class = 'alert alert-warning';
                        $icon = 'glyphicon glyphicon-exclamation-sign';
                        break;
                    case 'info':
                        $class = 'alert alert-info';
                        $icon = 'glyphicon glyphicon-info-sign';
                        break;
                    default:
                        $class = 'alert alert-success';
                        $icon = 'glyphicon glyphicon-ok-sign';
                        break;
                }
                ?>
                <?php foreach ($messages as $message) : ?>
                    <div class="<?= $class ?>" role="alert">
                        <span class="<?= $icon ?>" aria-hidden="true"></span>
                        <?= $message ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                <?php endforeach ?>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-lg-7"></div>
<?php endif ?>