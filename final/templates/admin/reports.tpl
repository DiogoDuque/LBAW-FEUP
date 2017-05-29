<div class="col-md-9">

    <hr>
    <div>
        <h3 id="results">Reports({count($results)})</h3>
    </div><!--/row-->

    <div class="container-fluid">
        {foreach $results as $i=>$report}
            {include file='lists/report_list_item.tpl'}
        {/foreach}
    </div><!--/row-->

    <script type='text/javascript' src="{$BASE_URL}lib/js/reports_menu.js"></script>
    <hr>
</div><!--/col-span-9-->