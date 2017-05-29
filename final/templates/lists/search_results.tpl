<h1 class="text-center fill" id="results">Results</h1>

{if count($results) > 0}

    <!--Multi Link-->
    <div class="container answer">
        {foreach $results as $i=>$question}
            {include file='lists/question_list_item.tpl'}
        {/foreach}
    </div>

    <div class="container answer text-center">
        {include file='common/pagination.tpl'}
    </div>
{else}
    <h2 class="text-center">No questions where found when searching for "{$query}".<br>Sugestions:</h2>
    <h3 class="text-center">Check if there are any mistakes.<br>Try diferent keywords.<br>Create a new question.</h3>
{/if}


<hr class="main-menu-questions-divider">

