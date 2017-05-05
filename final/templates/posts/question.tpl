<link rel="stylesheet" href="{$BASE_URL}lib/css/question.css">


<!--Content-->
<div class="container">
    {if $question eq null}
        {include file='common/not_found.tpl'}
    {else}
        <ol class="breadcrumb">
            <li><a href="{$BASE_URL}pages/home.php">Home</a></li>
            <li> {$question_category.name} </li>
            <li class="active">{$question.title}</li>
        </ol>
        <!--Title-->
        <h2>{$question.title}</h2>
        <small class="pull-right">
            {$question_post.up_votes}
            <span class="glyphicon glyphicon-thumbs-up"></span>
            {$question_post.down_votes}
            <span class="glyphicon glyphicon-thumbs-down"></span>
        </small>
        <!--Question-->
        <div class="question row">

            <div class="userInfo col-md-2">

                <!--User-->
                <div class="user">
                    <img alt="User Pic" src="{$BASE_URL}resources/img/user.png" class="img-circle img-responsive"
                         width="100"
                         height="100">
                    <a href="{$BASE_URL}pages/profile/view_profile.php?id={$question_author.id}">{$question_author.username}</a>
                </div>

                <!--Score-->
                <ul class="score">
                    <li><span class="glyphicon glyphicon-thumbs-up" data-post_id="{$question.post_id}"></span></li>
                    <li><p class="post_score"
                           data-post_id="{$question.post_id}">{$question_post.up_votes - $question_post.down_votes}</p>
                    </li>
                    <li><span class="glyphicon glyphicon-thumbs-down" data-post_id="{$question.post_id}"></span></li>
                </ul>

            </div>

            <!--Text-->
            <div class="col-md-10">
                <p>{$question_version.text}</p>
                <ul class="actions pull-right">
                    <li><a class="glyphicon glyphicon-link" href="" data-toggle="tooltip" title="Share"></a></li>
                    {if $currentUser}
                        <li><a class="glyphicon glyphicon-comment" href="" data-toggle="tooltip" title="Comment"></a>
                        </li>
                        <li><a class="glyphicon glyphicon-flag" href="" data-toggle="tooltip" title="Report"></a></li>
                        {if $currentUser.username==$question_author.username || $currentUser.privilege_level=="Administrator" || $currentUser.privilege_level=="Moderator"}
                            <li><a class="glyphicon glyphicon-pencil"
                                   href="{$BASE_URL}pages/posts/post_edit.php?id={$question.post_id}"
                                   data-toggle="tooltip" title="Edit"></a></li>
                            <li><a class="glyphicon glyphicon-trash"
                                   href="{$BASE_URL}actions/post/question_delete.php?id={$question.post_id}"
                                   data-toggle="tooltip" title="Remove"></a></li>
                        {/if}
                    {/if}
                </ul>
            </div>
        </div>
        {*COMMENTS*}

        {foreach $question_comments as $comment}
            {include file='comments/comment.tpl'}
        {/foreach}

        {*EDIT COMMENT FORM*}
        {if (true)}
            {*{include file='comments/comment_form.tpl'}*}
        {/if}
        <div class="answers">

            {if (count($question_answers) > 0)}
                <h4>Answers</h4>
            {else}
                <h4>No answers</h4>
            {/if}

            {foreach $question_answers as $answer}
                {include file='posts/answer.tpl'}
            {/foreach}
        </div>
        {if (isset($USERNAME))}
            {include file='forms/answer_add.tpl'}
        {/if}
    {/if}
</div>

<script type="text/javascript">
    var username = "{$USERNAME}";
    var BASE_URL = "{$BASE_URL}";
</script>


<script type='text/javascript' src="{$BASE_URL}lib/js/votes.js">
</script>