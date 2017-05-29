<ul class="pagination pagination-lg">
    <li><a id="previousPage" href="?{$url}&page={max($page-1, 1)}" class="btn">«</a></li>
        {for $var=1 to $results['0'].count/$limit}
            <li><a id="currentPage" href="?{$url}&page={$var}">{$var}</a></li>
        {/for}
    <li><a id="nextPage" href="?{$url}&page={min($page+1, ceil($results['0'].count/$limit))}" class="btn">»</a></li>
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