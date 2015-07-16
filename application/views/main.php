<div class="container-fluid pt75">
	<div class="row">
		<div class="col-sm-1 col-lg-3"></div>
		<div class="col-sm-10 col-lg-6">

            <div class="col-sm-10">

				<div class="form-group">
					<label for="email">Hi, Just paste the link to the item you just bought</label>
					<input name="email" type="email" class="form-control" id="item_url" placeholder="Paste URL">
				</div>

				<div id="PostsContainer"></div>

			</div>

			<div class="col-sm-2"><?= $right_bar ?></div>

		</div>
		<div class="col-sm-1 col-lg-3"></div>
	</div>
</div>

<!-- New Post Modal -->
<button type="button" class="btn btn-primary" id="AddPostButton" data-toggle="modal" data-target="#AddPostModal" style="display:none;"></button>
<div class="modal fade" id="AddPostModal" tabindex="-1" role="dialog" aria-labelledby="AddPostModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="AddPostModalLabel"></h4>
      </div>
      <div class="modal-body" id="AddPostModalBody"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="$('#newPostForm').submit();">Post Item</button>
      </div>
    </div>
  </div>
</div>
<!-- New Post Modal -->

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
