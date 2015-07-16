<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->userInfo->email = $this->encrypt->dec($this->userInfo->email);
?>
<div class="container-fluid pt75">
    <div class="col-sm-1 col-lg-3"></div>
    <div class="col-sm-10 col-lg-6">
        <h1>Edit your profile</h1>

        <ul id="tabs" class="nav nav-tabs mt20" data-tabs="tabs">
            <li class="active"><a href="#personalDetails" data-toggle="tab">Personal details</a></li>
            <li><a href="#profilePicture" data-toggle="tab">Profile picture</a></li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="personalDetails">
                <h4>Edit your personal details.<br /><small>Your details will never go out from here! you can be relaxed...</small></h4>
                <form action="/profile/save" method="post" enctype="multipart/form-data" id="editProfileForm">
                    <div class="row">
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="col-lg-12">
                                <div class="form-group bg-success p10 white-text">
                                    <?= $this->session->flashdata('success') ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="FirstName">First Name</label>
                                <input name="FirstName" type="text" class="form-control" id="FirstName" value="<?= $this->userInfo->fname ?>" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="LastName">Last Name</label>
                                <input name="LastName" type="text" class="form-control" id="LastName" value="<?= $this->userInfo->lname ?>" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="NickName">Nickname</label>
                                <input name="NickName" type="text" class="form-control" id="NickName" value="<?= $this->userInfo->nickname ?>" placeholder="Your friends will be able to see your nickname...">
                            </div>
                            <div class="form-group">
                                <label for="EmailAddress">Email address</label>
                                <input name="EmailAddress" type="text" class="form-control" id="EmailAddress" value="<?= $this->userInfo->email ?>" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Gender">Gender</label>
                                <select name="Gender" class="form-control" id="Gender">
                                    <option value="male"<?= ($this->userInfo->gender == "male" ? " selected" : "") ?>>Male</option>
                                    <option value="female"<?= ($this->userInfo->gender == "female" ? " selected" : "") ?>>Female</option>
                                </select>
                            </div>
                            <?php
                                $BirthDay = date("d", strtotime($this->userInfo->birthDate));
                                $BirthMonth = date("m", strtotime($this->userInfo->birthDate));
                                $BirthYear = date("Y", strtotime($this->userInfo->birthDate));
                            ?>
                            <div class="form-group">
                                <label for="Day">Birth date</label>
                                <div class="row">
                                    <div class="col-xs-4"><select name="BirthDay" class="form-control" id="Day"><?= getDay($BirthDay) ?></select></div>
                                    <div class="col-xs-4"><select name="BirthMonth" class="form-control" id="Day"><?= getMonth($BirthMonth) ?></select></div>
                                    <div class="col-xs-4"><select name="BirthYear" class="form-control" id="Day"><?= getYear($BirthYear) ?></select></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <select name="Country" class="form-control" id="Country"><?= getCountry(true, $this->userInfo->country) ?></select>
                            </div>
                            <div class="form-group">
                                <label for="City">City</label>
                                <input name="City" type="text" class="form-control" id="City" value="<?= $this->userInfo->city ?>" placeholder="Your current city"  required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="BestShop">What is the best shop site for you?</label>
                                <input name="BestShop" type="text" class="form-control" id="BestShop" value="<?= $this->userInfo->bestShop ?>" placeholder="Where do you like to buy?">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Save changes" class="btn btn-primary" data-loading-text="Saving..." />
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="tab-pane" id="profilePicture">
                <h4>Upload the best photo of you!<br /><small>After all, maybe you will find a woman that love to shopping like you :)</small></h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="dropzone" data-width="500" data-height="500" data-ghost="false" data-image="<?= $this->userInfo->profilePicture ?>" data-canvas="true" data-originalsize="false" data-save-original="false" data-url="/profile/uploadProfilePicture" data-removeurl="/profile/removeProfilePic">
                                <input type="file" name="thumb" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-1 col-lg-3"></div>
</div>