<?php

include_once ("../../config/init.php");

include_once ($BASE_DIR."database/votes.php");
include_once ($BASE_DIR."database/members.php");

header('Content-Type: application/json');
$response = array();

//TODO - RECEBER AJAX e dar às variaveis

if(!isset($_SESSION["username"]))
    die("You must be logged in to vote.");

if(!isset($_POST["value"]))
    die("No value for vote passed.");

if(!isset($_POST["post_id"]))
    die("No value for post_id passed.");

$voteValue;

if($_POST["value"] == "up")
{
    $voteValue = "true";
}
else{
    $voteValue = "false";
}

$post_id = intval($_POST["post_id"]);
$voterId = intval(getMemberByUsername($_SESSION["username"])["id"]);

if(addVote($post_id, $voterId, $voteValue) != true)
{
    $response['status'] = error;
}
else{
    $response['status'] = success;
}

updateVotes();

echo json_encode($response);

