<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/comments.php");
include_once ($BASE_DIR."database/members.php");

if (!isset($_POST['id']))
    die('Missing post ID.');
if (!isset($_SESSION['username']))
    die('Member not authenticated.');

$member = getMemberByUsername($_SESSION['username']);
if($member['privilege_level'] == "Member")
	die('You don\'t have permissions for deleting a comment...');

$id = $_POST['id'];
$id = deleteComment($id);

echo json_encode($id);