<div class="col-md-9">
    <div class="panel panel-default">

        <div class="panel-heading">
            <div class="panel-title">
                <i class="glyphicon glyphicon-wrench pull-right"></i>
                <h4>Categories Menu</h4>
            </div>
        </div>

        <div class="panel-body">
            <form id="add_category" action="../../actions/admin/create_category.php" method="post"
                  enctype="multipart/form-data" class="form form-vertical">
                <div class="control-group">
                    <label>Add Category</label>
                    <div class="controls">
                        <input id="new_category_name" type="text" class="form-control" placeholder="Enter Name"
                               name="id"
                               required>
                    </div>
                </div>
                <div class="control-group">
                    <label></label>
                    <div class="controls">
                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>
                    </div>
                </div>
            </form>

        </div>

        <div class="panel-body">
            <form id="remove_category" action="../../actions/admin/remove_category.php" method="post"
                  enctype="multipart/form-data" class="form form-vertical">
                <div class="control-group">
                    <label>Remove Category</label>
                    <div class="controls">
                        <select id="remove_category_name" name="name" class="form-control" required>
                            <option value="" selected>Select a category.</option>
                            {foreach $categories as $category}
                                <option value="{$category.id}">{$category.name}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label></label>
                    <div class="controls">
                        <button type="submit" class="btn btn-danger">
                            Remove
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script type='text/javascript' src="{$BASE_URL}lib/js/admin_categories_menu.js"></script>