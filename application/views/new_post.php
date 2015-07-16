<div class="row">
    <form action="/posts/add" method="post" id="newPostForm">
        <input type="hidden" name="itemTitle" value="<?= quotes_to_entities($data->title) ?>" />
        <input type="hidden" name="itemPrice" value="<?= $data->price ?>" />
        <input type="hidden" name="itemImage" value="<?= $data->image ?>" />
        <input type="hidden" name="itemSite" value="<?= $data->site_name ?>" />
        <input type="hidden" name="itemUrl" value="<?= $data->item_url ?>" />

        <div class="col-sm-12"><h4><?= $data->title ?></h4></div>

        <div class="col-sm-6">
            <div class="owlNewPost ofh"><img src="<?= $data->image ?>" alt="" class="img-responsive" /></div>
            <div class="loadMoreImagesLink mt10"><a href="javascript:loadMoreImages();">Load more images</a></div>
        </div>

        <div class="col-sm-6">
            <div class="input-group fullWidth">
                <label for="userPrice">Price</label>
                <input type="text" class="form-control sizing" id="userPrice" name="userPrice" value="<?= $data->price ?>" />
            </div>
            <div class="input-group fullWidth mt10">
                <label for="userCategory">Category</label>
                <select name="userItemCategory" class="form-control" id="userCategory">
                    <option value="0">Select...</option>
                    <?php foreach($categories AS $id => $title): ?>
                    <option value="<?= $id ?>"><?= $title ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group fullWidth mt10">
                <label for="userExperience">Your shopping experience</label>
                <textarea class="form-control sizing" id="userExperience" name="userExperience" rows="3"></textarea>
            </div>
        </div>

    </form>
</div>

<script src="/assets/validate/jquery.validate.js"></script>
<script src="/assets/validate/jquery.form.min.js"></script>

<script>
    $(function(){
        $("#newPostForm").validate();
        $('#newPostForm').ajaxForm({
            success: showResponse
        });
    });

    function showResponse(responseText, statusText, xhr, $form)  {
        if(responseText == "true") {
            $('#AddPostModal').modal("hide");
            page = 0;
            getPosts();
        }
    }
</script>
