<?php

include_once("../../config/init.php");

if(!isset($_SESSION['username']))
    die('You are not logged in!');

$userPrivilegeLevel=getMemberByUsername($_SESSION['username'])['privilege_level'];
if(!isset($userPrivilegeLevel))
    die('You are not logged in!');
else if(strcmp($userPrivilegeLevel,'Member')==0)
    die('You don\'t have permissions to see this page...');

include_once($BASE_DIR . "database/reports.php");

$results = getReports(0, "any");
$smarty->assign("results", $results);
$smarty->display("common/header.tpl");

?>

    <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>lib/css/admin.css">

    <div class="container">
        <div class="row">

            <?php
            $smarty->display("admin/side_menu.tpl");
            $smarty->display("admin/reports.tpl");
            ?>


        </div>

    </div>

<?php

$smarty->display('common/footer.tpl');


