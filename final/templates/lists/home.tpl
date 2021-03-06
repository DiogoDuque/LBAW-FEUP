
<div class="container">

    <h1>{$title}</h1>


    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
        <li><a data-toggle="tab" href="#popular">Most Popular</a></li>
        <li><a data-toggle="tab" href="#controversial">Most Controversial</a></li>
    </ul>


    <div class="tab-content">

        <div id="recent" class="tab-pane fade in active">
            {foreach $recents as $i=>$question}
                {include file='lists/question_list_item.tpl'}
            {/foreach}
        </div>

        <hr class="main-menu-questions-divider">

        <div id="popular" class="tab-pane fade">
            {foreach $populars as $i=>$question}
                {include file='lists/question_list_item.tpl'}
            {/foreach}
        </div>

        <div id="controversial" class="tab-pane fade">
            {foreach $controversials as $i=>$question}
                {include file='lists/question_list_item.tpl'}
            {/foreach}
        </div>
    </div>
</div>

<script type="text/javascript" src="{$BASE_URL}lib/js/home.js"></script>