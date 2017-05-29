<link rel="stylesheet" href= "{$BASE_URL}lib/css/search.css">

<div class="container">
    <h1 class="text-center">Advanced Search</h1>

    <form id="search_form">
        <div class="form-group">
            <label for="query">Search for:</label>
            <input id="query" type="text" class="form-control" name="query" value="{$query}">
        </div>

        <div class="container">
            <div class="row">

                <div class="col-sm-4">
                    <div class="checkbox">
                        <label><input type="checkbox" name="search_titles" value="1"
                                    {if $search_titles eq 1} checked{/if}>
                            Search in Titles</label>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="checkbox">
                        <label><input type="checkbox" name="search_descriptions" value="1"
                                    {if $search_descriptions eq 1} checked{/if}>
                            Search in Descriptions</label>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="checkbox">
                        <label><input type="checkbox"  name="search_answers" value="1"
                                    {if $search_answers eq 1} checked{/if}>
                            Search in Answers</label>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-group">
            <label for="search_order">Order by:</label>
            <select id="search_order" class="form-control" name="search_order">
                {foreach $orders as $order => $value}
                    <option value="{$order}"
                            {if $order == $search_order} selected{/if}>
                    {$order}</option>
                {/foreach}
            </select>
        </div>

        <h5>Filter by Category (<a class="categories" id="all_categories">Select All</a>|<a class="categories" id="no_categories">Unselect All</a>)</h5>

        <div class="container">
            <div class="row">

                {foreach $categories as $category}
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label><input type="checkbox" class="category_checkbox" name="search_categories[]" value="{$category.id}"
                                        {if $category.checked eq 1} checked{/if}>
                                {$category.name}</label>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block">Search</button>
        <button type="reset" class="btn btn-danger btn-block">Reset</button>
    </form>

    <script type='text/javascript' src="{$BASE_URL}lib/js/search_form.js"></script>
</div>