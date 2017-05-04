<h1 class="text-center fill" id="results">Results</h1>

{if count($results) > 0}

    <!--Multi Link-->
    <div class="container answer">
        {foreach $results as $i=>$question}
            {include file='lists/question_list_item.tpl'}
        {/foreach}
    </div>

    <div class="container answer text-center">
        <ul class="pagination pagination-lg">
            <li><a href="?{$url}&page={max($page-1, 1)}">«</a></li>
            {for $var=1 to $results['0'].count/$limit}
                <li><a href="?{$url}&page={$var}">{$var}</a></li>
            {/for}
            <li><a href="?{$url}&page={min($page+1, $results['0'].count/$limit)}">»</a></li>
        </ul>
    </div>
{else}
    <h2 class="text-center">No questions where found when searching for "{$query}".<br>Sugestions:</h2>
    <h3 class="text-center">Check if there are any mistakes.<br>Try diferent keywords.<br>Create a new question.</h3>
{/if}


<hr class="main-menu-questions-divider">