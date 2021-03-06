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

include_once($BASE_DIR . "database/reports.php");

if(!isset($_GET["page"]))
    $page = 1;
else
    $page = $_GET["page"];

$results = getReports($page - 1, "any");
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


