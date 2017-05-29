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

    $_SESSION["last_question_visited"] = $_SERVER['REQUEST_URI'];

    $question_id = $_GET["id"];

    $question = getQuestion($question_id);
    $question_post = getPost($question_id);
    $question_category = getCategory($question["category_id"]);
    $question_author = getMemberById($question_post["author_id"]);
    $question_version = getLatestPostVersion($question_id);
    $question_comments = getCommentsToPost($question_id);
    $question_answers = getAnswersToQuestion($question_id);
    $currentUser = getMemberByUsername($_SESSION['username']);

    //prevent XSS
    $question['title'] = htmlspecialchars($question['title'], ENT_QUOTES, 'UTF-8');

    include_once($BASE_DIR.'vendors/htmlpurifier-4.9.2/library/HTMLPurifier.auto.php');
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $question_version['text'] = $purifier->purify($question_version['text']);


    foreach ($question_comments as $key => $value)
    {
        $comment = $value;
        $question_comments[$key]["member"] = getMemberById($comment["member_id"]);
        $question_comments[$key]["text"] = htmlspecialchars($comment["text"], ENT_QUOTES, 'UTF-8');
    }

    foreach ($question_answers as $key => $value)
    {
        $answer = $value;
        $answer_post = getPost($answer["post_id"]);

        $question_answers[$key]["comments"] = getCommentsToPost($answer["post_id"]);
        $question_answers[$key]["post"] = $answer_post;
        $question_answers[$key]["author"] = getMemberById($answer_post["author_id"]);
        $question_answers[$key]["version"] = getLatestPostVersion($answer["post_id"]);
    }
    $smarty->assign("question", $question);
    $smarty->assign("question_post", $question_post);
    $smarty->assign("question_category",$question_category );
    $smarty->assign("question_author", $question_author);
    $smarty->assign("question_version", $question_version);
    $smarty->assign("question_id",$question_id );


    $smarty->assign("question_comments", $question_comments);
    $smarty->assign("question_answers", $question_answers);

    $smarty->assign("currentUser",$currentUser);

    $isShareable=true;
    $smarty->display("common/header.tpl");
    $smarty->display("posts/question.tpl");

    $smarty->display("common/footer.tpl");
?>