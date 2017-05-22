<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/comments.php");
include_once ($BASE_DIR."database/members.php");

if (!isset($_GET['id']))
    die('Missing post ID.');

if (!isset($_SESSION['username']))
    die('Member not authenticated.');

//delete only happens if user==author or user.hasPermissions
$member = getMemberByUsername($_SESSION['username']);
$comment = getComment($_GET['id']);
if($member['privilege_level'] == "Member" && $member['id'] != $comment['member_id'])
	die('You don\'t have permissions for deleting this question...');

//try to delete question
if(deleteComment($_GET['id']))
	$_SESSION['error_messages'] = "Comment deleted successfully!";
else $_SESSION['error_messages'] = "Error: could not delete comment...";

$destination = $_SERVER['HTTP_REFERER'];
header( "Location:{$destination}" );
$smarty->assign('redirect_destiny', $destination);