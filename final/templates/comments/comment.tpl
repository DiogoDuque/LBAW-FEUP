<div class="comment col-md-11 col-md-offset-1" data-comment-id="{$comment.id}">
    <p class="comment_text">{$comment.text}</p>
    <a href="{$BASE_URL}pages/profile/view_profile.php?id={$comment.member_id}">{$comment.member.username}</a>
    <ul class="actions pull-right">
        {if $currentUser.username==$comment.member.username || $currentUser.privilege_level=="Administrator" || $currentUser.privilege_level=="Moderator"}
            <li><a class="glyphicon glyphicon-pencil comment_edit_button" href="{$comment.id}" data-toggle="tooltip" title="Edit"></a></li>
            <li><a class="glyphicon glyphicon-trash comment-delete"
               href="{$BASE_URL}actions/post/comment_delete.php"
               data-toggle="tooltip" title="{$BASE_URL}Remove"></a>
            </li>
        {/if}
    </ul>
</div>