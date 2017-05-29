<?php
include_once ("../../config/init.php");
include_once ($BASE_DIR."database/reports.php");
include_once ($BASE_DIR."database/members.php");

echo $_POST['description'];

if (!isset($_POST['description']))
    die('Missing description.');
if (!isset($_POST['type']))
    die('Missing type.');
if (!isset($_POST['post_id']))
    die('Missing post ID.');
if(!isset($_SESSION['username']))
    die("You must be authenticated to report");

$description = $_POST["description"];
$type = $_POST["type"];
$post_id = $_POST["post_id"];
$author_id = intval(getMemberByUsername($_SESSION["username"])["id"]);

$result = submitReport($post_id, $author_id, $type, $description);