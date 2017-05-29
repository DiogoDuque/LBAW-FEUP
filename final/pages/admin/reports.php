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
foreach ($results as $key=>$result){
    $results[$key]['description'] = htmlspecialchars($result['description'], ENT_QUOTES, 'UTF-8');
}

$smarty->assign("results", $results);
$smarty->assign("limit", 10);
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


