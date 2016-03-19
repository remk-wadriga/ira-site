<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.03.2016
 * Time: 22:05
 *
 * @var components\View $this
 * @var models\Comment $comment
 */
?>

<li class="anim fadeIn">
    <div class="wrapper anim fadeIn" data-wow-delay="0.2s">
        <img src="<?= $comment->userAvatar ?>" alt="<?= $comment->userName ?>" />
        <h5><?= $comment->userName ?></h5>
        <span><?= $this->dateTime($comment->date) ?></span>

        <p><?= $comment->text ?></p>

        <?= $this->render('_leave-comment-btn', [
            'model' => $comment->entity,
            'parent' => $comment,
        ]) ?>
        <div class="form contact style-2 comment-form-container"></div>
    </div><!-- .wrapper -->

    <?php $blockID = 'comments_block_' . str_replace('\\', '_', $comment::className()) . '_' . $comment->id; ?>
    <ul id="<?= $blockID ?>">
        <?php if (!empty($comment->children)) : ?>
            <?php foreach ($comment->children as $child) : ?>
                <?= $this->render('_item', [
                    'comment' => $child,
                ]) ?>
            <?php endforeach ?>
        <?php endif ?>
    </ul>
</li>
