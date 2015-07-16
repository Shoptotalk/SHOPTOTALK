<div class="col-xs-12 commentRow" data-id="<?= $_id ?>">

    <div class="dropdown mr10 pointer right">
        <div id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></div>
        <ul class="dropdown-menu" aria-labelledby="actions" style="left:-<?= ($this->userInfo->_id == $user_id ? 150 : 180) ?>px;">
            <?php if($this->userInfo->_id == $user_id): ?>
                <li><a href="#">Edit</a></li>
                <li><a href="javascript:deleteComment(<?= $_id ?>)">Delete</a></li>
            <?php else: ?>
                <li><a href="#">I don't want to see that</a></li>
                <li><a href="#">Report</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="col-xs-11">
        <div class="left mr5 profilePicHolder"><img src="<?= $user_comment->profilePicture ?>" alt="" class="sm-profile-picture img-responsive"></div>
        <a href="/users/<?= $user_comment->_id ?>"><?= $user_comment->fname ?> <?= $user_comment->lname ?></a>
        <?= $text ?></p>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="col-xs-1 hidden-xs"></div>
    <div class="col-xs-10 mt5">
        <a href="javascript:giveLoveComment(<?= $_id ?>)"><span class="glyphicon glyphicon-heart"></span>  <span data-lovesCommentNum="<?= $_id ?>"><?= $numOfCommentLoves ?></span></a>
        ·
        <small><?= getTime($createDate) ?></small>
    </div>
    <div class="clear"></div>
</div>