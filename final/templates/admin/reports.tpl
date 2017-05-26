<div class="col-md-9">

    <hr>
    <div>
        <h3 id="results">Reports({count($results)})</h3>
    </div><!--/row-->

    <div class="container">
        {foreach $results as $i=>$report}
            {include file='lists/report_list_item.tpl'}
            <hr>
        {/foreach}
    </div><!--/row-->

    <hr>
</div><!--/col-span-9-->