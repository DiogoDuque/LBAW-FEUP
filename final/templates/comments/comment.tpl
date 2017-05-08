<div class="comment col-md-9 col-md-offset-3">
    <p>{$comment.text}</p>

    <a href="{$BASE_URL}profile/view_profile.php">{$comment.member.username}</a>
    <ul class="actions pull-right">
        <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
        <lti><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></lti>
        <li><a class="glyphicon glyphicon-trash"
               href="{$BASE_URL}actions/post/comment_delete.php?id={$comment.id}"
               data-toggle="tooltip" title="Remove"></a></li>
    </ul>
</div>