<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/posts.php");
include_once ($BASE_DIR."database/members.php");

if (!isset($_GET['id']))
    die('Missing post ID.');
if (!isset($_SESSION['username']))
    die('Member not authenticated.');

$member = getMemberByUsername($_SESSION['username']);
if($member['privilege_level'] == "Member")
	die('You don\'t have permissions for deleting a question...');

if(deletePost($_GET['id']))
	$_SESSION['error_messages'] = "Post deleted successfully!";
else $_SESSION['error_messages'] = "Error: could not delete post...";

$destination = $BASE_URL."pages/home.php";
header( "refresh:3;url={$destination}" );
$smarty->assign('redirect_destiny', $destination);