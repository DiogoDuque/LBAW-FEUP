<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/members.php");
include_once ($BASE_DIR."database/votes.php");
include_once ($BASE_DIR."database/posts.php");
include_once ($BASE_DIR."database/answers.php");
include_once ($BASE_DIR."database/questions.php");
include_once ($BASE_DIR."database/versions.php");

if (!isset($_SESSION["username"])) {
    $_SESSION['error_messages'] = "You must be logged in to see members' profiles.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

if(isset($_GET['id']))
    $user = getMemberById($_GET['id']);
else
    $user=getMemberByUsername($_SESSION["username"]);

$self = ($_SESSION["username"] == $user['username']);

//posts
$lastposts = getPostUser($user['id']);
//score
$score=getScore($user['id']);

//img
    if (file_exists($BASE_DIR.'resources/img/'.$user['username'].'.png'))
      $photo = 'resources/img/'.$user['username'].'.png';
    if (file_exists($BASE_DIR.'resources/img/'.$user['username'].'.jpg'))
      $photo = 'images/users/'.$tweet['username'].'.jpg';
    if (!$photo) $photo = 'resources/img/user.png';




$smarty->assign("member", $user);
$smarty->assign("score", $score);
$smarty->assign("lastPosts", $lastposts);
$smarty->assign("self", $self);

$smarty->display("common/header.tpl");
$smarty->display("member/profile.tpl");
$smarty->display("common/footer.tpl"); ?>
\


