<?php

include_once("../../config/init.php");

if(!isset($_SESSION['username']))
{
    $_SESSION['error_messages'] = "You are not logged in.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}


$userPrivilegeLevel=getMemberByUsername($_SESSION['username'])['privilege_level'];
if(!isset($userPrivilegeLevel))
{
    $_SESSION['error_messages'] = "You are not logged in.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}
else if(strcmp($userPrivilegeLevel,'Member')==0){
    $_SESSION['error_messages'] = "You don't have permissions to view this page.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

include_once($BASE_DIR . "database/members.php");
include_once($BASE_DIR . "database/promotions_demotions.php");

$smarty->display("common/header.tpl");

?>

    <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>lib/css/admin.css">

    <div class="container">
        <div class="row">

            <?php
            $smarty->display("admin/side_menu.tpl");
            ?>
            <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h4>Promote or Demote Staff</h4>
                    </div>
                </div>
                <div class="panel-body">

                    <form action="<?= $BASE_URL ?>api/admin/promotion_demotion.php" method="POST"
                          class="form form-vertical">

                        <div class="control-group">
                            <label>Name</label>

                            <select class="js-data-example-ajax" name="targetId" style="width: 100%">
                                <option value="3620194" selected="selected">Members</option>
                            </select>
                        </div>

                        <br>

                        <div class="control-group">
                            <label>Permissions</label>
                            <div class="controls">
                                <select class="form-control" name="newPrivilegeLevel">
                                    <option>Moderator</option>
                                    <option>Admin</option>
                                    <option>Member</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Done
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>



        </div>

    </div>

<script>
    $(".js-data-example-ajax").select2({
        ajax: {
            url: "<?=$BASE_URL?>api/admin/get_member_list.php",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    username: params.term
                };
            },
            processResults: function (data) {


                return {
                    results: data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 1,
        templateResult: formatState,
        templateSelection: formatState

    });

    function formatState (state) {
        var $state = state.username;
        return $state;
    };
</script>

<?php

$smarty->display('common/footer.tpl');
