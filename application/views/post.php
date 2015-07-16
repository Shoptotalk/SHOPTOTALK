<div class="panel panel-default relative post" data-id="<?= $_id ?>">

    <div class="dropdown mr10 pointer right">
		<div id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span></div>
		<ul class="dropdown-menu" aria-labelledby="actions" style="left: -<?= ($this->userInfo->_id == $user_id ? 150 : 180) ?>px;">
			<?php if($this->userInfo->_id == $user_id): ?>
				<li><a href="#">Edit</a></li>
				<li><a href="javascript:deletePost(<?= $_id ?>)">Delete</a></li>
			<?php else: ?>
                <li><a href="#">I don't want to see that</a></li>
                <li><a href="#">Report</a></li>
            <?php endif; ?>
		</ul>
	</div>
	
	<div class="panel-body">
		<div class="row">
			<!-- TOP -->
			<div class="col-xs-12 user-post-details">
				<div class="pull-left mr5"><img src="<?= $user_post->profilePicture ?>" alt="" class="profile-picture img-responsive"></div>
				<div class="pull-left mt3">
					<div><a href="/profile/u/<?= $user_post->_id ?>"><?= $user_post->fname ?> <?= $user_post->lname ?></a></div>
					<div class="small"><?= getTime($createDate) ?></div>
				</div>
				<div class="clear"></div>
			</div>
			<!-- /TOP -->

			<div class="col-xs-12 col-sm-4">
				<div class="owl">
                    <?php
                    if($item_moreImages) {
                        $moreImages = explode(",", $item_moreImages);
                        foreach($moreImages AS $moreImage){ ?>
                            <a href="javascript:showPost(<?= $_id ?>);" class="thumbnail"><img class="itemImage" src="<?= $moreImage ?>" alt=""></a>
                    <?php
                        }
                    } else { ?>
                        <a href="javascript:showPost(<?= $_id ?>);" class="thumbnail"><img class="itemImage" src="<?= $item_image ?>" alt=""></a>
                    <?php
                        } ?>
                </div>
			</div>
			<div class="col-xs-12 col-sm-7">
				<h4><a href="javascript:showPost(<?= $_id ?>);"><?= $item_title ?></a> <a href="/<?= str_replace(" ", "", $category->title) ?>"><small><?= $category->title ?></small></a></h4>
				<p><?= character_limiter($user_experience, 300) ?></p>
                <div class="fs25">Price: <strong>$<?= $user_price ?></strong></div>
				<div class="fs12"><a href="<?= $item_url ?>" target="_blank">Buy it with <b><?= $item_site ?></b></a></div>
			</div>
		</div>
	</div>

	<div class="panel-footer">
		<div class="row">
			<div class="col-xs-10">
				<a href="javascript:showPost(<?= $_id ?>);"><span class="glyphicon glyphicon-comment"></span> <span data-commentsNum="<?= $_id ?>"><?= $numOfComments ?></span> Comments</a>
			</div>
			<div class="col-xs-2">
				<div class="pull-right mobile-AC" data-trigger="hover" data-toggle="tooltip" data-placement="top" title="Loading..." data-id="<?= $_id ?>" >
					<a href="javascript:giveLove(<?= $_id ?>);"><span class="glyphicon glyphicon-heart"></span>  <span data-lovesNum="<?= $_id ?>"><?= $numOfLoves ?></span></a>
				</div>
			</div>
		</div>
	</div>
  
</div>