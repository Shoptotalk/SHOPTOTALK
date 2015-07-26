<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid pt75">
    <div class="col-sm-1 col-lg-3"></div>
    <div class="col-sm-10 col-lg-6">
        <div class="row">
            <div class="col-sm-4 col-lg-3 p0 relative left-side">
                <div class="fixed profile_fixed" style="display: none;">
                    <div><img src="<?= $user->profilePicture ?>" alt="" class="max-profile-picture img-responsive"></div>
                    <div class="text-center"><h3><?= $user->fname ?> <?= $user->lname ?></h3></div>
                    <div class="btn btn-success btn-block text-center p10 mb10" id="friendsBtn" onclick="friends(<?= $user->_id ?>)">Be friend with <?= $user->fname ?> <?= $user->lname ?></div>
                    <div class="btn btn-primary btn-block text-center p10 mb10"><?= $user->fname ?> have <strong><?= $count_user_friends ?></strong> friends</div>
                    <div class="btn btn-primary btn-block text-center p10 mb10">Published <strong><?= $count_user_posts ?></strong> posts</div>
                    <div class="btn btn-primary btn-block text-center p10 mb10">Loved <strong><?= $count_user_loves ?></strong> posts</div>
                </div>
            </div>
            <div class="col-sm-8 col-lg-9">
                <div id="PostsContainer"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-1 col-lg-3"></div>
</div>

<!-- Post Modal -->
<button type="button" class="btn btn-primary" id="PostButton" data-toggle="modal" data-target="#PostModal" style="display:none;"></button>
<div class="modal fade" id="PostModal" tabindex="-1" role="dialog" aria-labelledby="PostModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="PostModalLabel"></h4>
      </div>
      <div class="modal-body" id="PostModalBody"></div>
    </div>
  </div>
</div>
<!-- Post Modal -->