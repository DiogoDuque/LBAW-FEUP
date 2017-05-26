<div class="row">

    <!--
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
        <h4>[{$report.type}]<br>
            <small>reported by <a href="{$BASE_URL}pages/profile/view_profile.php?id={$report.report_author_id}">{$report.report_author}</a></small>
        </h4>

        <p>{$report.description}</p>
        <div class="col-sm-10 pre">
            <p>{$report.post_text}</p>
            <small>last modified by <a href="{$BASE_URL}pages/profile/view_profile.php?id={$report.post_author_id}">{$report.post_author}</a></small>
        </div>
    </div>

</div>