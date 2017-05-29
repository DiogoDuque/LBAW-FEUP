<?php

include_once("../../config/init.php");

include_once ($BASE_DIR."database/votes.php");
include_once ($BASE_DIR."database/members.php");
include_once ($BASE_DIR."database/posts.php");

header('Content-Type: application/json');
$response = array();

if(!isset($_SESSION["username"]))
{
    $_SESSION['error_messages'] = "You must be logged in to vote.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

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
    echo json_encode($response);
    return;
}
else{
    $response['status'] = success;
}

if(updateVotes() != true) {
    $response['status'] = error;
    echo json_encode($response);
    return;
}
else{
    $response['status'] = success;
    $response['score'] = getPostScore($post_id);
}

$_SESSION['votedPosts'] = getPostsVotedOn(getMemberByUsername($_SESSION['username'])['id']);

echo json_encode($response);

