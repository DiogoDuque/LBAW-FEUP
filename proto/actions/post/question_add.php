<?php

include_once ("../../config/init.php");

include_once ($BASE_DIR."database/questions.php");

include_once ($BASE_DIR."database/members.php");

if (!isset($_POST['title']))
    die('Missing title.');

if (!isset($_POST['category']))
    die('Missing post category.');

if (!isset($_POST['text']))
    die("Missing text.");

// Gather data for creating
$title = $_POST['title'];
$category = $_POST['category'];
$text = $_POST['text'];

$author_id = intval(getMemberByUsername($_SESSION["username"])["id"]); //TODO get from logged in, not hardcoded

$question_id = submitQuestion($title, $category, $text, $author_id);

$destination = $BASE_URL."pages/posts/question.php?id=".$question_id;

header("Location: ".$destination);

//TODO make verifications and return result
