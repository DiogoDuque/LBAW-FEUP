<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/comments.php");
include_once ($BASE_DIR."database/members.php");



if (!isset($_POST['text']))
    die('Missing text.');
if (!isset($_POST['id']))
    die('Missing post ID.');
if (!isset($_SESSION["username"]))
    die("Member not authenticated.");

$text = $_POST["text"];
$comment_id = $_POST["id"];

//delete only happens if user.hasPermissions
$member = getMemberByUsername($_SESSION['username']);
$comment = getComment($comment_id);
if($member['privilege_level'] == "Member" && $member['id'] != $comment['member_id'])
    die('You don\'t have permissions for editing this comment...');

$result = editComment($comment_id, $text);