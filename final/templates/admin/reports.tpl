<div class="col-md-9">

    <div class="panel panel-default">

        <div class="panel-heading">
            <div class="panel-title">
                <i class="glyphicon glyphicon-wrench pull-right"></i>
                <h4>Reports({count($results)})</h4>
            </div>
        </div>

        <div class="panel-body">
            <div class="container-fluid">
                {foreach $results as $i=>$report}
                    {include file='lists/report_list_item.tpl'}
                {/foreach}

                <ul class="pagination pagination-lg">
                    <li><a id="previousPage" href="?{$url}&page={max($page-1, 1)}" class="btn">«</a></li>
                    {for $var=1 to count($results)/$limit}
                        <li><a id="currentPage" href="?{$url}&page={$var}">{$var}</a></li>
                    {/for}
                    <li><a id="nextPage" href="?{$url}&page={min($page+1, ceil($results['0'].count/$limit))}"
                           class="btn">»</a></li>
                </ul>

                <script>
                    var numberOfPages = {ceil(count($results['0'])/$limit)};
                    var currentPage = parseInt($("#currentPage").text());

                    $(function () {

                        if (numberOfPages === currentPage) {
                            $("#nextPage").addClass("disabled");
                        }

                        {
                            if (currentPage === 1)
                                $("#previousPage").addClass("disabled");
                        }
                    });
                </script>

            </div>

        </div>
    </div>

    <script type='text/javascript' src="{$BASE_URL}lib/js/reports_menu.js"></script>
    <hr>
</div>