<div class="row">

    <div class="col-sm-9 pre">
        <h4><a href="{$BASE_URL}pages/posts/question.php?id={$question.id}" class="home-question-title">{$question.title}</a><br>
            <small>asked 55 seconds ago by <a href="{$BASE_URL}pages/profile/view_profile.php?id={$question_post.author_id}">{$question_author.username}</a> in <a href="search.php">{$question_category.name}</a></small>
        </h4>
    </div>

    <div class="points col-sm-1">
        <h4 class="text-center">
            <div class="points">{$question_post.up_votes - $question_post.down_votes}</div>
            <small>point{if $question.score != 1}s{/if}</small>
        </h4>
    </div>


    <div class="answers col-sm-1">
        <h4 class="text-center">
            <div class="answers">
                {$question.answer_count}
                <small><span class="glyphicon glyphicon-comment"></span></small>
            </div>

            <small>
                answer{if $question.answer_count != 1}s{/if}
            </small>
        </h4>
    </div>
</div>