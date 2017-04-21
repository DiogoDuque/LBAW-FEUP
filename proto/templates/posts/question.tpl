<link rel="stylesheet" href="{$BASE_URL}lib/css/question.css">

<!--Content-->
<div class="container">
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
                <img alt="User Pic" src="{$BASE_URL}resources/img/user.png" class="img-circle img-responsive" width="100"
                     height="100">
                <a href="{$BASE_URL}pages/profile/view_profile.php?id={$question_author.id}">{$question_author.username}</a>
            </div>

            <!--Score-->
            <ul class="score">
                <li><a class="glyphicon glyphicon-thumbs-up" href="#"></a></li>
                <li><p>{$question_post.up_votes - $question_post.down_votes}</p></li>
                <li><a class="glyphicon glyphicon-thumbs-down" href="#"></a></li>
            </ul>

        </div>

        <!--Text-->
        <div class="col-md-10">
            <p>{$question_version.text}</p>
            <ul class="actions pull-right">
                <li><a class="glyphicon glyphicon-link" href="" data-toggle="tooltip" title="Share"></a></li>
                <li><a class="glyphicon glyphicon-comment" href="" data-toggle="tooltip" title="Comment"></a></li>
                <li><a class="glyphicon glyphicon-flag" href="" data-toggle="tooltip" title="Report"></a></li>
                <li><a class="glyphicon glyphicon-pencil" href="{$BASE_URL}pages/posts/post_edit.php?id={$question.post_id}" data-toggle="tooltip" title="Edit"></a></li>
                <li><a class="glyphicon glyphicon-trash" href="" data-toggle="tooltip" title="Remove"></a></li>
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
            <h4 >Answers</h4>
        {else}
            <h4 >No answers</h4>
        {/if}

        {foreach $question_answers as $answer}
            {include file='posts/answer.tpl'}
        {/foreach}
    </div>

    {if (isset($USERNAME))}
        {include file='forms/answer_add.tpl'}
    {/if}
</div>

<script>
    function getGET(qs) {
        qs = qs.split("+").join(" ");
        var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;

        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])]
                = decodeURIComponent(tokens[2]);
        }

        return params;
    }

    $(document).ready(function () {
        $('.glyphicon-thumbs-up').on('click', function() {
            var voteValue="up"; //vote.value
            var username = $(this).parent().parent().parent().children(".user").children("a").get(0).innerHTML; //vote.member_id
            var questionId = getGET(document.location.search)["id"]; //question.id, use to get vote.post_id
            var postText = $(this).parent().parent().parent().parent().children().not(".userInfo").children("p").get(0).innerHTML; //version.text -> version.post_id
            /*               if post_id==question_id
                               vote.post_id=question_id
                             else vote.post_id=answer_id WHERE version is latest (use 'WHERE MAX(date)')
                                */
        });
        $('.glyphicon-thumbs-down').on('click', function() {
            var voteValue="down"; //vote.value
            var username = $(this).parent().parent().parent().children(".user").children("a").get(0).innerHTML; //vote.member_id
            var questionId = getGET(document.location.search)["id"]; //question.id, use to get vote.post_id
            var postText = $(this).parent().parent().parent().parent().children().not(".userInfo").children("p").get(0).innerHTML; //version.text -> version.post_id
            /*               if post_id==question_id
             vote.post_id=question_id
             else vote.post_id=answer_id WHERE version is latest (use 'WHERE MAX(date)')
             */
        });
    });
</script>