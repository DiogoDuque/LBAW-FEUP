<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/answers.php");
include_once ($BASE_DIR."database/posts.php");
include_once ($BASE_DIR."database/members.php");
include_once ($BASE_DIR."database/questions.php");


if (!isset($_POST['edited_text']))
    die('Missing text.');
if (!isset($_POST['post_id']))
    die('Missing post ID.');
if(!isset($_SESSION['username']))
    die("You must be logged in to write an answer");

$text = $_POST["edited_text"];
$post_id =($_POST["post_id"]);


$question=getQuestion($post_id);
//echo($question);


// Gather data for creating

$author_id = intval(getMemberByUsername($_SESSION["username"])["id"]); //TODO get from logged in, not hardcoded

$question_id = submitAnswer($post_id,$text, $author_id);

if (isAnswer($question_id)) {
    $question_id = getQuestionId($question_id);
}


$destination = $BASE_URL."pages/posts/question.php?id=".$question_id;

header("Location: ".$destination);

//TODO make verifications and return result