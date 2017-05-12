<div class="row">

    <div class="col-sm-9 pre">
        <h4><a href="{$BASE_URL}pages/posts/question.php?id={$question.id}" class="home-question-title">{$question.title}</a><br>
            <small>asked {$question.date} ago by <a href="{$BASE_URL}pages/profile/view_profile.php?id={$question.author_id}">{$question.author}</a> in <a href="{$BASE_URL}pages/home.php?category={$question.category_id}">{$question.category}</a></small>
        </h4>
    </div>

    <div class="points col-sm-1">
        <h4 class="text-center">
            <div class="points">{$question.score}</div>
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