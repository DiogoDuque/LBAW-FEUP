<link rel="stylesheet" href="{$BASE_URL}lib/css/question.css">



<div class="container">
    {if !$question.post_id}
        {include file='common/not_found.tpl'}
    {else}
        <ol class="breadcrumb">
            <li><a href="{$BASE_URL}pages/home.php">Home</a></li>
            <li> {$question_category.name} </li>
            <li class="active">{$question.title}</li>
        </ol>

        <h2>{$question.title}</h2>
        <small class="pull-right">
            {$question_post.up_votes}
            <span class="glyphicon glyphicon-thumbs-up"></span>
            {$question_post.down_votes}
            <span class="glyphicon glyphicon-thumbs-down"></span>
        </small>

        <div class="question row">

            <div class="userInfo col-md-2">


                <div class="user">
                    {if $question_author.filename}
                        <img alt="User Pic" src="{$BASE_URL}resources/uploads/{$question_author.filename}" class="img-circle img-responsive"
                             width="100"
                             height="100">
                    {else}
                        <img alt="User Pic" src="{$BASE_URL}resources/img/user.png" class="img-circle img-responsive"
                             width="100"
                             height="100">
                    {/if}
                    <a href="{$BASE_URL}pages/profile/view_profile.php?id={$question_author.id}">{$question_author.username}</a>
                </div>


                <ul class="score">
                    <li><span class="glyphicon glyphicon-thumbs-up" data-post_id="{$question.post_id}"></span></li>
                    <li><p class="post_score"
                           data-post_id="{$question.post_id}">{$question_post.up_votes - $question_post.down_votes}</p>
                    </li>
                    <li><span class="glyphicon glyphicon-thumbs-down" data-post_id="{$question.post_id}"></span></li>
                </ul>

            </div>


            <div class="col-md-10">
                <p>{$question_version.text}</p>
                <ul class="actions pull-right">
                    <li><div class="fb-share-button" data-href="http://gnomo.fe.up.pt/~lbaw1623/LBAW-FEUP/final/pages/posts/question.php?id={$question_author.id}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fgnomo.fe.up.pt%2F%7Elbaw1623%2FLBAW-FEUP%2Ffinal%2Fpages%2Fposts%2Fquestion.php%3Fid%3D&amp;src=sdkpreparse">Partilhar</a></div></li>
                    {if $currentUser}
                        <li><a class="glyphicon glyphicon-comment comment_add_toogle" href="" data-toggle="tooltip" title="Comment"></a>                        </li>
                        <li><a class="glyphicon glyphicon-flag report_button" href="{$question.post_id}" data-toggle="tooltip" title="Report"></a></li>
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



                {foreach $question_comments as $comment}
                    {include file='comments/comment.tpl'}
                {/foreach}


                {if (isset($USERNAME))}
                    {assign "post_id" $question.post_id}
                    {include file='comments/comment_form.tpl'}
                {/if}
            </div>

        </div>



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
        {if (isset($USERNAME)) && $question_author!=$currentUser}
            {include file='forms/answer_add.tpl'}
        {/if}
    {/if}
</div>


<div id="comment_edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Comment</h4>
            </div>
            <div class="modal-body">
                <form class="comment_edit_form" action="../../actions/post/comment_edit.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="comment_id">
                        <textarea class="formgroup form-control" name="edited_text"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success edit_comment_apply">Apply</button>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="report_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Report</h4>
            </div>
            <div class="modal-body">
                <form class="report_form" action="../../actions/report/report_add.php" method="post">
                    <input type="hidden" name="post_id">
                    <div class="form-group">
                        <label for="report_type">Type:</label>
                        <select id="report_type" class="form-control" name="type" required>
                            <option value="">Choose</option>
                            <option value="DuplicateQuestion">Duplicate Question</option>
                            <option value="LackOfClarity">Lack Of Clarity</option>
                            <option value="InnapropriateLanguage">Innapropriate Language</option>
                            <option value="BadBehavior">Bad Behavior</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="report_description">Description:</label>
                        <textarea id="report_description" class="formgroup form-control" name="description" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var username = "{$USERNAME}";
    var BASE_URL = "{$BASE_URL}";
</script>

<script type='text/javascript' src="{$BASE_URL}lib/js/report.js"></script>
<script type='text/javascript' src="{$BASE_URL}lib/js/comment.js"></script>
<script type='text/javascript' src="{$BASE_URL}lib/js/votes.js"></script>

<script type="text/javascript" src="{$BASE_URL}lib/js/question.js"></script>