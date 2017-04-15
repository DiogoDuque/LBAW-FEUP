<link rel="stylesheet" href="{$BASE_URL}lib/css/question.css">

<!--Content-->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{$BASE_URL}pages/home.php">Home</a></li>
        <li> {$question_category["name"]} </li>
        <li class="active">{$question["title"]}</li>
    </ol>


    <!--Title-->
    <h2>{$question["title"]}</h2>

    <small class="pull-right">
        {$question_post["up_votes"]}
        <span class="glyphicon glyphicon-thumbs-up"></span>
        {$question_post["down_votes"]}
        <span class="glyphicon glyphicon-thumbs-down"></span>
    </small>

    <!--Question-->
    <div class="question row">

        <div class="col-md-2">
            <!--User-->
            <div class="user">
                <img alt="User Pic" src="../../resources/img/user.png" class="img-circle img-responsive" width="100"
                     height="100">
                <a href="{$BASE_URL}pages/profile/view_profile.php">Peralta</a>
            </div>
            <!--Score-->
            <ul class="score">
                <li><a class="glyphicon glyphicon-thumbs-up" href="#"></a></li>
                <li><p>3</p></li>
                <li><a class="glyphicon glyphicon-thumbs-down" href="#"></a></li>
            </ul>
        </div>

        <!--Text-->
        <div class="col-md-10">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra feugiat erat posuere
                pellentesque. Nullam gravida lorem dolor, quis dignissim orci elementum sed. Etiam sollicitudin nunc
                eu risus tristique tristique. Mauris at massa elit. Fusce ligula tortor, blandit non rhoncus ac,
                rhoncus vel dui. Suspendisse sit amet sem id sapien volutpat interdum non non orci. Quisque vitae
                nisl ut nunc fringilla vestibulum. Nam porta porttitor rhoncus. Duis ultrices sem condimentum,
                suscipit sem vel, faucibus lectus. Nulla pellentesque felis sapien, et porta turpis rhoncus non.
                Proin nec leo venenatis, iaculis mi id, bibendum lorem. Aenean convallis nec elit vitae scelerisque.
                Vivamus condimentum nunc ac leo pretium, eu porttitor risus laoreet. Aliquam accumsan ipsum nec eros
                euismod, non hendrerit felis finibus. Sed scelerisque rhoncus consectetur. Orci varius natoque
                penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                Aliquam ac turpis vel ligula sodales volutpat at in augue. Maecenas eleifend eros id consectetur
                fermentum. Ut hendrerit, nulla ut dictum pellentesque, urna enim efficitur urna, sit amet facilisis
                risus diam nec tellus. Vestibulum egestas justo neque, ac convallis lacus gravida eu. Nunc volutpat,
                libero at porttitor venenatis, sapien dui sollicitudin urna, ut feugiat sem metus id tortor. Donec
                vel rutrum nibh. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed odio
                mauris. Suspendisse porta purus quis libero hendrerit, vel tincidunt diam rutrum. Nam sodales erat
                sed tellus pellentesque, ac tincidunt eros euismod. Praesent tristique dolor sapien, et interdum
                orci rhoncus vel. Sed odio sem, vulputate nec vulputate maximus, pharetra non est. Vivamus porta
                sagittis nunc.</p>
            <ul class="actions pull-right">
                <li><a class="glyphicon glyphicon-link" href="#" data-toggle="tooltip" title="Share"></a></li>
                <li><a class="glyphicon glyphicon-comment" href="#" data-toggle="tooltip" title="Comment"></a></li>
                <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a></li>
                <li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a></li>
                <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a></li>
            </ul>
        </div>
    </div>


    <!--TODO: Put Comments in template-->
    {for $foo=0 to 1}
        {include file='comments/comment.tpl'}
    {/for}

    {if (true)}
        {include file='comments/comment_form.tpl'}
    {/if}

    <div class="answers">

        <h4 >Answers</h4>

        {for $foo=0 to 1}
            {include file='posts/answer.tpl'}
        {/for}


    </div>

</div>