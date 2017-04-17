<div class="comment col-md-9 col-md-offset-3">
    <p>{$comment.text}</p>

    {assign "comment_author" $getter->getMemberById($comment.member_id)}

    <a href="{$BASE_URL}profile/view_profile.php">{$comment_author.username}</a>
    <ul class="actions pull-right">
        <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
        <lti><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></lti>
        <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
    </ul>
</div>