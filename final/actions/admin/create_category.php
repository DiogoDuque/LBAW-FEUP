<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/categories.php");

//Check permissions
$member = getMemberByUsername($_SESSION['username']);
if($member['privilege_level'] != "Administrator")
    die('You don\'t have permissions to perform this action...');

$name = $_POST['name'];
$id = addCategory($name);

$response_array['name'] = $name;
if ($id >= 0)
    $response_array['status'] = 'success';
else
    $response_array['status'] = 'error';
header('Content-type: application/json');
echo json_encode($response_array);

//echo $id;