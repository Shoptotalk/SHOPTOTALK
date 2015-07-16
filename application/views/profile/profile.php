<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid pt75">
    <div class="col-sm-1 col-lg-3"></div>
    <div class="col-sm-10 col-lg-6">
        <div class="row">
            <div class="col-sm-4 col-lg-3 p0 relative left-side">
                <div class="fixed profile_fixed" style="display: none;">
                    <div><img src="<?= $user->profilePicture ?>" alt="" class="max-profile-picture img-responsive"></div>
                    <div class="text-center"><h3><?= $user->fname ?> <?= $user->lname ?></h3></div>
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