<?php

    include_once ("../../config/init.php");
    include_once ($BASE_DIR."database/answers.php");
    include_once ($BASE_DIR."database/posts.php");



if (!isset($_POST['edited_text']))
        die('Missing text.');

    if (!isset($_POST['post_id']))
        die('Missing post ID.');

    if (!isset($_SESSION["username"]))
        die("Member not authenticated.");

    $text = $_POST["edited_text"];
    $post_id = intval($_POST["post_id"]);
    $member_id = intval($_POST["member_id"]);

    include_once ($BASE_DIR."database/versions.php");

    addVersion($text, $post_id, $member_id);
    if (isAnswer($post_id)) {
        $post_id = getQuestionId($post_id);
    }

    $destination = $BASE_URL."pages/posts/question.php?id=".$post_id;

    header("Location: ".$destination);