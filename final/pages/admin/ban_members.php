<?php
include_once("../../config/init.php");
include_once($BASE_DIR . "database/members.php");

if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'] = "You are not logged in or your session expire.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

$userPrivilegeLevel = getMemberByUsername($_SESSION['username'])['privilege_level'];
if (!isset($userPrivilegeLevel)) {
    $_SESSION['error_messages'] = "You are not logged in.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
} else if (strcmp($userPrivilegeLevel, 'Member') == 0) {
    $_SESSION['error_messages'] = "You don't have permissions to view this page.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

if (!isset($_SESSION["member_infos"]))
    $_SESSION["member_infos"] = getAllUsernamesAndPrivileges();

function displayMembersList($members, $privilege)
{
    ?>
    <div class=<?php
    if (strcmp($privilege, "Member") == 0)
        echo "\"tab-pane active\"";
    else echo "\"tab-pane\"";

    if (strcmp($privilege, "Member") == 0)
        echo " id=\"members\"";
    else if (strcmp($privilege, "Moderator") == 0)
        echo " id=\"moderators\"";
    else echo " id=\"admins\""; ?>>

        <h3 class="text-center"><?= $privilege . "s" ?></h3>
        <div class="well" style="max-height: 300px;overflow: auto;">
            <ul class="list-group checked-list-box">
                <?php foreach ($members as $member) {
                    if (strcmp($member['privilege_level'], $privilege) == 0) {
                        echo "<li class=\"list-group-item\">" . $member['username'] . "</li>";
                    }
                } ?>
            </ul>

        </div>
    </div>
    <?php
}

;

$smarty->display("common/header.tpl"); ?>

<link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>lib/css/admin.css">

<div class="container">
    <div class="row">

        <?php $smarty->display("admin/side_menu.tpl"); ?>

        <div class="col-md-9">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h4>Ban Members</h4>
                    </div>
                </div>

                <div class="panel-body">

                <div class="row" id="test">

                    <input id="searchMembers" type="text" class="form-control" name="username" autocomplete="off"
                           value="<?= $_SESSION["member_search_input"] ?>">


                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#members" data-toggle="tab">Members</a></li>
                        <li><a href="#moderators" data-toggle="tab">Moderators</a></li>
                        <li><a href="#admins" data-toggle="tab">Admins</a></li>
                    </ul>
                    <div id="userList" class="tab-content">

                        <?php
                        displayMembersList($_SESSION["member_infos"], "Member");
                        displayMembersList($_SESSION["member_infos"], "Moderator");
                        displayMembersList($_SESSION["member_infos"], "Administrator");
                        ?>


                    </div>

                    <div class="control-group">
                        <label></label>
                        <div class="controls">
                            <button type="submit" class="removeMember btn btn-primary">Ban</button>
                        </div>
                    </div>

                </div>

                </div>

            </div>


        </div><!--/row-->
    </div><!--/col-span-9-->
</div>
</div>
<!-- /Main -->

<?php

$smarty->display("common/footer.tpl");

?>

<script type="text/javascript" src="../../lib/js/membersTabelAdmin.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        banCheck();
    });


    $("#searchMembers").keyup(function () {
        $.ajax({
            url: "<?=$BASE_URL?>api/admin/get_member_list.php",
            type: "GET",
            data: {"username": $(this).val()},
            success: function (result) {
            }
        });

        $.ajax({
            url: "../../lib/js/membersTabelAdmin.js",
            dataType: "script"
        });

        $("#userList").load(location.href + " #userList");

    })
    ;

    function banCheck() {

        $(document).on('click', '.removeMember', function () {
            console.log("Here!");

            var membersList = $("li.list-group-item.list-group-item-primary.active");

            //check if there are users to be removed
            if (membersList.length < 0)
                return;

            //confirmation window
            var password = window.prompt("Are you sure you want to ban " + membersList.length + " members? If you are, confirm your password:");
            if (password == null)
                return;

            //ajax request
            var usernames = [];
            for (i = 0; i < membersList.length; i++) {
                usernames.push(membersList.get(i).innerText);
            }
            var requestData = [password, usernames];
            $.ajax({
                url: "../../actions/member/member_ban.php",
                type: "POST",
                data: {data: JSON.stringify(requestData)},
                success: function (data) {
                    window.alert(data.message + data.users);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });

    }


</script>