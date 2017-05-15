<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/comments.php");
include_once ($BASE_DIR."database/members.php");



if (!isset($_POST['text']))
    die('Missing text.');

if (!isset($_POST['post_id']))
    die('Missing post ID.');

$text = $_POST["text"];
$post_id = $_POST["post_id"];

$author_id = intval(getMemberByUsername($_SESSION["username"])["id"]);

$result = submitComment($post_id, $author_id, $text);

json_encode($result);