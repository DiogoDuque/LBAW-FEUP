<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/categories.php");

//Check permissions
$member = getMemberByUsername($_SESSION['username']);
if($member['privilege_level'] != "Administrator")
    die('You don\'t have permissions to perform this action...');

$id = $_POST['id'];
$id = deleteCategory($id);

echo json_encode($id);
//echo $id;