<?php

include_once("../../config/init.php");

if(!isset($_POST['post_id']))
    die("Missing post ID.");

header('Content-Type: application/json');
$response = array();

foreach ($_SESSION['votedPosts'] as $vote)
{
    if(intval($_POST['post_id']) === $vote['post_id'])
    {
        $response['found'] = true;
        $response['value'] = $vote['value'];
    }
    else{
        $response['found'] = false;
    }
}

echo json_encode($response);