<div class="row">

    <!--
    $report.id
    $report.type
    $report.description
    $report.report_author_id
    $report.report_author
    $report.post_author_id
    $report.post_author
    $report.question_id
    $report.category_id
    $report.post_text

    -->
    <div class="col-sm-10 pre">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" href="#collapse{$report.id}">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <h4>
                               [{$report.type}] #{$report.id}
                            </h4>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <button type="button" class="btn btn-primary btn-block">
                                Go to question >
                            </button>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <button type="button" class="btn btn-danger btn-block">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div id="collapse{$report.id}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="well">
                            {$report.post_text}
                            <br>
                            <small>last modified by <a href="{$BASE_URL}pages/profile/view_profile.php?id={$report.post_author_id}">{$report.post_author}</a></small>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {$report.description}
                        <br>
                        <small>reported by <a href="{$BASE_URL}pages/profile/view_profile.php?id={$report.report_author_id}">{$report.report_author}</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>