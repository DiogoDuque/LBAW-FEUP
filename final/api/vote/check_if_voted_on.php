<?php

include_once("../../config/init.php");

if(!isset($_POST['post_id']))
    die("Missing post ID.");

header('Content-Type: application/json');
$response = array();

var_dump(intval($_POST['post_id']), $_SESSION['votedPosts']);

if(in_array(intval($_POST['post_id']), $_SESSION['votedPosts']))
{
    $response['found'] = true;
}
else{
    $response['found'] = false;
}

echo json_encode($response);