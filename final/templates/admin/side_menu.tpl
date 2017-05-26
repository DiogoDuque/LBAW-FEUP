<div class="col-md-3">
    <!-- Left column -->
    <a class="title" href="#"><strong><i class="glyphicon glyphicon-dashboard"></i>My Dashboard</strong></a>

    <div class="panel-group" id="accordion">

        <a data-toggle="collapse" data-parent="#accordion" href="#collapseMembers">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                            <span class="glyphicon glyphicon-user">
                            </span>Members
                    </h4>
                </div>
            </div>
        </a>
        <div id="collapseMembers" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="text-primary"></span><a
                                    href="#">View members</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="text-primary"></span><a
                                    href="#">Manage members</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <a data-toggle="collapse" data-parent="#accordion" href="#collapseCategories">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                            <span class="glyphicon glyphicon-folder-close">
                            </span>Categories
                    </h4>
                </div>
            </div>
        </a>
        <div id="collapseCategories" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="text-primary"></span><a
                                    href="#">Manage categories</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <a data-toggle="collapse" data-parent="#accordion" href="#collapseReports">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                            <span class="glyphicon glyphicon-inbox">
                            </span>Reports
                    </h4>
                </div>
            </div>
        </a>
        <div id="collapseReports" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="text-primary"></span><a
                                    href="{$BASE_URL}pages/admin/reports.php">View reports</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

