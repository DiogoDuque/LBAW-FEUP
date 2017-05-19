<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/comments.php");
include_once ($BASE_DIR."database/members.php");



if (!isset($_POST['text']))
    die('Missing text.');

if (!isset($_POST['id']))
    die('Missing post ID.');

$text = $_POST["text"];
$comment_id = $_POST["id"];

$result = editComment($comment_id, $text);