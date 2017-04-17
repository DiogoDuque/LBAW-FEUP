<?php

include_once ("../../config/init.php");

include_once ($BASE_DIR."database/questions.php");

$title = $_POST['title'];
$category = $_POST['category'];
$text = $_POST['text'];
$author_id = 1; //TODO get from logged in, not hardcoded

submitQuestion($title, $category, $text, $author_id);

//TODO make verifications and return result
