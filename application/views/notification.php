<div class="notification-line <?= $valid ? 'not-seen' : 'seen' ?>" onclick="showPost(<?= $post->_id ?>)">
    <div class="col-xs-2 p0 pl10"><a href=""><img src="<?= $from_user->profilePicture ?>" alt="" class="img-circle maxWidth"></a></div>
    <div class="col-xs-7">
        <div><?= $from_user->fname ?> <?= $from_user->lname ?> <strong><?= $msg ?></strong> <span class="small"><?= getTime($createDate) ?></span></div>
    </div>
    <div class="col-xs-3 AC">
        <?php if( isset($post) ){ ?>
            <img src="<?= $post->item_image ?>" alt="" class="maxWidth" />
        <?php } ?>
    </div>
    <div class="clear"></div>
</div>