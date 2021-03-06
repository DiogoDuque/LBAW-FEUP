<small class="pull-right">
    {$answer.post.up_votes}
    <span class="glyphicon glyphicon-thumbs-up"></span>
    {$answer.post.down_votes}
    <span class="glyphicon glyphicon-thumbs-down"></span>
</small>

<div class="answer row">
    <div class="userInfo col-md-2">
        <!--User-->
        <div class="user">
            <img alt="User Pic" src="{$BASE_URL}resources/img/user.png" class="img-circle img-responsive"
                 width="100" height="100">
            <a href="{$BASE_URL}pages/profile/view_profile.php?id={$answer.author.id}">{$answer.author.username}</a>
        </div>
        <!--Score-->
        <ul class="score">
            <li><a class="glyphicon glyphicon-thumbs-up" data-post_id="{$answer.post_id}" href="#"></a></li>
            <li><p class="post_score">{$answer.post.up_votes - $answer.post.down_votes}</p></li>
            <li><a class="glyphicon glyphicon-thumbs-down" data-post_id="{$answer.post_id}" href="#"></a></li>
        </ul>
    </div>

    <!--Text-->
    <div class="col-md-10">
        <p>{$answer.version.text}</p>
        <ul class="actions pull-right">
            <li><a class="glyphicon glyphicon-comment" href="#" data-toggle="tooltip" title="Comment"></a>
            </li>
            <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a>
            </li>
            <li><a class="glyphicon glyphicon-pencil" href="{$BASE_URL}pages/posts/post_edit.php?id={$answer.post_id}"  data-toggle="tooltip" title="Edit"></a>
            </li>
            <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a>
            </li>
        </ul>
    </div>
</div>