<div class="comment col-md-9 col-md-offset-3" data-comment-id="{$comment.id}">
    <p class="comment_text">{$comment.text}</p>
    <a href="{$BASE_URL}pages/profile/view_profile.php?id={$comment.member_id}">{$comment.member.username}</a>
    <ul class="actions pull-right">
        <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
        <li><a class="glyphicon glyphicon-pencil comment_edit_button" href="{$comment.id}" data-toggle="tooltip" title="Edit"></a></li>
        <li><a class="glyphicon glyphicon-trash"
               href="{$BASE_URL}actions/post/comment_delete.php?id={$comment.id}"
               data-toggle="tooltip" title="Remove"></a></li>
    </ul>
</div>