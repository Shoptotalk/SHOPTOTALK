<div class="col-sm-12 col-md-7 imageHolder">
    <div class="postPopupOwl">
        <?php
        if($item_moreImages) {
            $moreImages = explode(",", $item_moreImages);
            foreach($moreImages AS $moreImage){ ?>
                <img class="itemImage img-responsive" src="<?= $moreImage ?>" alt="">
            <?php
            }
        } else { ?>
            <img class="itemImage img-responsive" src="<?= $item_image ?>" alt="">
        <?php
        } ?>
    </div>
</div>

<div class="col-sm-12 col-md-5 userExperienceAndComments">

    <div class="row">
        <div class="well my-well">
            <div class="col-xs-8 pl0">
                <div class="pull-left mr5"><img src="<?= $user_post->profilePicture ?>" alt="" class="profile-picture img-responsive"></div>
                <div class="pull-left mt3" style="margin-top:3px;">
                    <div><a href=""><?= $user_post->fname ?> <?= $user_post->lname ?></a></div>
                    <div class="small"><?= getTime($createDate) ?></div>
                </div>
            </div>
            <div class="col-xs-4 pr0">
                <div class="pull-right ml5"><span class="glyphicon glyphicon-comment"></span> <span data-commentsNum="<?= $_id ?>"><?= $numOfComments ?></span></div>
                <div class="pull-right"><a href="javascript:giveLove(<?= $_id ?>)"><span class="glyphicon glyphicon-heart"></span> <span data-lovesNum="<?= $_id ?>"><?= $numOfLoves ?></span></a></div>
            </div>
            <div class="clear"></div>
            <?php if($user_experience): ?><div class="user_experience p10 mt10"><?= nl2br($user_experience) ?></div><?php endif; ?>
        </div>
    </div>

    <div class="row commentsHolder" data-id="<?= $_id ?>"></div>

    <div class="row">
        <div class="well my-well">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="newComment<?= $_id ?>">Comment</label>
                    <textarea class="form-control sizing newComment" id="newComment<?= $_id ?>" placeholder="Your comment here"></textarea>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</div>

<div class="clear"></div>

<script src="/assets/js/comments.js"></script>
<script>
    $(function(){
        getComments();
        var owl = $(".postPopupOwl")
        owl.owlCarousel({
            singleItem: true
        });
    })
</script>


