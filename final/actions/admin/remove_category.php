<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/categories.php");

$member = getMemberByUsername($_SESSION['username']);
if($member['privilege_level'] != "Administrator")
{
    $_SESSION['error_messages'] = "You don't have permissions to perform this action...";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

$id = $_POST['id'];
$id = deleteCategory($id);

echo json_encode($id);
