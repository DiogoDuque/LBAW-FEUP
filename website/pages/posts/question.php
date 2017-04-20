<?php

    include_once ("../../config/init.php");

    include_once ($BASE_DIR."database/questions.php");
    include_once ($BASE_DIR."database/members.php");
    include_once ($BASE_DIR."database/posts.php");
    include_once ($BASE_DIR."database/comments.php");
    include_once ($BASE_DIR."database/answers.php");
    include_once ($BASE_DIR."database/versions.php");
    include_once ($BASE_DIR."database/categories.php");


    if (!isset($_GET['id']))
        die('Missing question ID.');

    $question_id = $_GET["id"];

    $question = getQuestion($question_id);
    $question_post = getPost($question["post_id"]);
    $question_category = getCategory($question["category_id"]);
    $question_author = getMemberById(intval($question_post.["author_id"]));
    $question_version = getLatestPostVersion($question_id);
    $question_comments = getCommentsToPost($question_id);
    $question_answers = getAnswersToQuestion($question_id);

    $smarty->assign("question", $question);
    $smarty->assign("question_post", $question_post);
    $smarty->assign("question_category",$question_category );
    $smarty->assign("question_author", $question_author);
    $smarty->assign("question_version", $question_version);

    $smarty->assign("comments", $question_comments);



    $smarty->display("common/header.tpl");
    $smarty->display("posts/question.tpl");

    $smarty->display("common/footer.tpl"); ?>
