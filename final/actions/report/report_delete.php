<?php
include_once ("../../config/init.php");
include_once ($BASE_DIR."database/reports.php");

if(!isset($_SESSION['username']))
    die("You must be logged in to access this feature");

$member = getMemberByUsername($_SESSION['username']);
if($member['privilege_level'] != "Administrator" && $member['privilege_level'] != "Moderator")
    die('You don\'t have permissions for perform this action...');

$id = $_POST['id'];
$id = deleteReport($id);

echo json_encode($id);
