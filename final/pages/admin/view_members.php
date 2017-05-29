<?php

include_once("../../config/init.php");

if (!isset($_SESSION['username'])) {
    $_SESSION['error_messages'] = "You are not logged in.";
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

include_once($BASE_DIR . "database/members.php");

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
                            <h4>Member list</h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <label for="searchMembers">Search</label>
                        <input id="searchMembers" type="text" class="form-control" name="username" autocomplete="off">

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Class
                                </th>
                                <th>
                                    Profile page
                                </th>
                            </tr>

                            </thead>

                            <tbody id="user-list">


                            </tbody>

                        </table>

                    </div>
                </div>
            </div>


        </div>

    </div>

    <script>

        $("#searchMembers").keyup(function () {
            $.ajax({
                url: "<?=$BASE_URL?>api/admin/get_member_list.php",
                type: "GET",
                data: {"username": $(this).val()},
                success: function (data) {

                    var obj = $.parseJSON(data);

                    var table = $('<table>');

                    for(var i = 0; i < obj.length; i++){

                        console.log(obj);

                        var currentObj = obj[i];

                        var $tr = $('<tr>').append(
                            $('<td>').text(currentObj.username),
                            $('<td>').text(currentObj.privilege_level),
                            $('<td>').html("<a href=../profile/view_profile.php?id="+ currentObj.id + ">Profile</a>"),
                        );

                        table.append($tr);
                    }

                    $('#user-list').html(table.html());
                }
            });

        });


    </script>

<?php

$smarty->display('common/footer.tpl');