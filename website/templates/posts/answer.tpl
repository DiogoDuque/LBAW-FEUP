{assign "answer_post" $getter->getPost($answer.post_id)}
{assign "answer_category" $getter->getCategory($answer.category_id)}
{assign "answer_author" $getter->getMemberById($answer_post.author_id)}
{assign "answer_version" $getter->getLatestPostVersion($answer.post_id)}

<small class="pull-right">
    {$answer_post.up_votes}
    <span class="glyphicon glyphicon-thumbs-up"></span>
    {$answer_post.down_votes}
    <span class="glyphicon glyphicon-thumbs-down"></span>
</small>

<div class="answer row">
    <div class="col-md-2">
        <!--User-->
        <div class="user">
            <img alt="User Pic" src="{$BASE_URL}resources/img/user.png" class="img-circle img-responsive"
                 width="100" height="100">
            <a href="{$BASE_URL}pages/profile/view_profile.php">Peralta</a>
        </div>
        <!--Score-->
        <ul class="score">
            <li><a class="glyphicon glyphicon-thumbs-up" href="#"></a></li>
            <li><p>{$answer_post.up_votes - $answer_post.down_votes}</p></li>
            <li><a class="glyphicon glyphicon-thumbs-down" href="#"></a></li>
        </ul>
    </div>
    <!--Text-->
    <div class="col-md-10">
        <p>{$answer_version.text}</p>
        <ul class="actions pull-right">
            <li><a class="glyphicon glyphicon-comment" href="#" data-toggle="tooltip" title="Comment"></a>
            </li>
            <li><a class="glyphicon glyphicon-flag" href="#" data-toggle="tooltip" title="Report"></a>
            </li>
            <li><a class="glyphicon glyphicon-pencil" href="#" data-toggle="tooltip" title="Edit"></a>
            </li>
            <li><a class="glyphicon glyphicon-trash" href="#" data-toggle="tooltip" title="Remove"></a>
            </li>
        </ul>
    </div>
</div>