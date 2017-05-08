<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/posts.php");
include_once ($BASE_DIR."database/members.php");

if (!isset($_GET['id']))
    die('Missing post ID.');

if (!isset($_SESSION['username']))
    die('Member not authenticated.');

//delete only happens if user==author or user.hasPermissions
$member = getMemberByUsername($_SESSION['username']);
$post = getPost($_GET['id']);
if($member['privilege_level'] == "Member" && $member['id'] != $post['author_id'])
	die('You don\'t have permissions for deleting this question...');

//try to delete question
if(deletePost($_GET['id']))
	$_SESSION['error_messages'] = "Post deleted successfully!";
else $_SESSION['error_messages'] = "Error: could not delete post...";

$destination = $BASE_URL."pages/home.php";
header( "refresh:3;url={$destination}" );
$smarty->assign('redirect_destiny', $destination);