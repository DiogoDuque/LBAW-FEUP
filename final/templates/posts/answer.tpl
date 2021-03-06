
<div class="answer row">
    <small class="pull-right">
        {$answer.post.up_votes}
        <span class="glyphicon glyphicon-thumbs-up"></span>
        {$answer.post.down_votes}
        <span class="glyphicon glyphicon-thumbs-down"></span>
    </small>

    <div class="userInfo col-md-2">

        <div class="user">
            {if $answer.author.filename}
                <img alt="User Pic" src="{$BASE_URL}resources/uploads/{$answer.author.filename}" class="img-circle img-responsive"
                     width="100"
                     height="100">
            {else}
                <img alt="User Pic" src="{$BASE_URL}resources/img/user.png" class="img-circle img-responsive"
                     width="100"
                     height="100">
            {/if}
            <a href="{$BASE_URL}pages/profile/view_profile.php?id={$answer.author.id}">{$answer.author.username}</a>
        </div>

        <ul class="score">
            <li><span class="glyphicon glyphicon-thumbs-up" data-post_id="{$answer.post_id}" ></span></li>
            <li><p class="post_score" data-post_id="{$answer.post_id}">{$answer.post.up_votes - $answer.post.down_votes}</p></li>
            <li><span class="glyphicon glyphicon-thumbs-down" data-post_id="{$answer.post_id}" ></span></li>
        </ul>
    </div>

    <div class="col-md-10">
        <p>{$answer.version.text}</p>
        <ul class="actions pull-right">
        {if $currentUser}
            <li><a class="glyphicon glyphicon-comment comment_add_toogle" href="#" data-toggle="tooltip" title="Comment"></a></li>
            <li><a class="glyphicon glyphicon-flag report_button" href="{$answer.post_id}" data-toggle="tooltip" title="Report"></a></li>
            {if $currentUser.username==$answer.author.username || $currentUser.privilege_level=="Administrator" || $currentUser.privilege_level=="Moderator"}
                <li><a class="glyphicon glyphicon-pencil" href="{$BASE_URL}pages/posts/post_edit.php?id={$answer.post_id}"  data-toggle="tooltip" title="Edit"></a>
                <li><a class="glyphicon glyphicon-trash answer-delete" href="#" data-toggle="tooltip" title="Remove"></a></li>
            {/if}
        {/if}
        </ul>



        {foreach $answer.comments as $comment}
            {include file='comments/comment.tpl'}
        {/foreach}


        {if (isset($USERNAME))}
            {assign "post_id" $answer.post_id}
            {include file='comments/comment_form.tpl'}
        {/if}
    </div>

</div>