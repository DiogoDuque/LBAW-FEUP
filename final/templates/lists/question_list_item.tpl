<div class="row">

    <div class="col-sm-10 pre">
        <h4><a href="{$BASE_URL}pages/posts/question.php?id={$question.id}" class="home-question-title">{$question.title}</a><br>
            <small>asked {$question.date} ago by <a href="{$BASE_URL}pages/profile/view_profile.php?id={$question.author_id}">{$question.author}</a> in <a href="{$BASE_URL}pages/home.php?category={$question.category_id}">{$question.category}</a></small>
        </h4>
    </div>



    <div class="points col-sm-1 col-xs-6">
        <h4 class="text-center">
            <span class="points">{$question.score}</span>
            <br>
            <small>point{if $question.score != 1}s{/if}</small>
        </h4>
    </div>


    <div class="answers col-sm-1 col-xs-6">
        <h4 class="text-center">
            <span class="answers">
                {$question.answer_count}
                <small><span class="glyphicon glyphicon-comment"></span></small>
            </span>
            <br>
            <small>
                answer{if $question.answer_count != 1}s{/if}
            </small>
        </h4>
    </div>
</div>