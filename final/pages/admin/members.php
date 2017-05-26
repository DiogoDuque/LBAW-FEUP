<?php
include_once("../../config/init.php");
include_once($BASE_DIR . "database/members.php");

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

        <h3 class="text-center"><? $privilege . "s" ?></h3>
        <div class="well" style="max-height: 300px;overflow: auto;">
            <ul class="list-group checked-list-box">
                <?php foreach ($members as $member) {
                    if (strcmp($member['privilege_level'], $privilege) == 0) {
                        echo "<li class=\"list-group-item\">" . $member['username'] . "</li>";
                    }
                } ?>
            </ul>
            <div class="control-group">
                <label></label>
                <div class="controls">
                    <button id="removeMember" type="submit" class="btn btn-primary">Remove</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

;

$memberInfos = getAllUsernamesAndPrivileges();

$smarty->display("common/header.tpl"); ?>

<link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>lib/css/admin.css">

<div class="container">
    <div class="row">

        <?php $smarty->display("admin/side_menu.tpl"); ?>

        <div class="col-md-9">

            <hr>

            <div class="row">


                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#members" data-toggle="tab">Members</a></li>
                    <li><a href="#moderators" data-toggle="tab">Moderators</a></li>
                    <li><a href="#admins" data-toggle="tab">Admins</a></li>
                </ul>
                <div class="tab-content">

                    <?php
                    displayMembersList($memberInfos, "Member");
                    displayMembersList($memberInfos, "Moderator");
                    displayMembersList($memberInfos, "Administrator");
                    ?>


                </div>

                </div>

            </div><!--/row-->
            <hr>
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
        $("#removeMember").click(function () {
            var membersList = $("li.list-group-item.list-group-item-primary.active");

            //check if there are users to be removed
            if (membersList.length < 0)
                return;

            //confirmation window
            var password = window.prompt("Are you sure you want to remove " + membersList.length + " members? If you are, confirm your password:");
            if (password == null)
                return;

            //ajax request
            var usernames = [];
            for (i = 0; i < membersList.length; i++) {
                usernames.push(membersList.get(i).innerText);
            }
            var requestData = [password, usernames];
            $.ajax({
                url: "../../actions/member/member_delete.php",
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
    });
</script>