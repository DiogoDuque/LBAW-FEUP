<div class="comment col-md-9 col-md-offset-3">
    <div class="widget-area no-padding blank">
        <div class="comment-box">
            <form action="{$BASE_URL}actions/post/comment_add.php" class="comment_form" method="post"
                  enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="{$post_id}">
                <textarea placeholder="Comment" name="text" required></textarea>
                <button type="submit" class="btn btn-success green">Apply</button>
            </form>
        </div><!-- Status Upload  -->
    </div><!-- Widget Area -->
</div>