<?php

function getPost($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.post WHERE id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetch();
}

function getPostScore($post_id){
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM public.post WHERE id = ?");
        $stmt->execute(array($post_id));

    } catch (PDOException $err) {

        echo $err->getMessage();

        return false;
    }


    $post = $stmt->fetch();

    return (intval($post['up_votes']) - intval($post['down_votes']));
}


function deletePost($post_id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM public.post WHERE id = ?");
    return $stmt->execute(array($post_id));
}


function isAnswer($post_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM public.answer WHERE post_id = ?;
");
    $stmt->execute(array($post_id));

    $num = $stmt->fetch()['total'];
    if ($num > 0)
        return true;
    else
        return false;
}

function getPostUser($user_id){
    global $conn;

    $stmt = $conn->prepare("
          SELECT version.date AS date, main_question.title AS title, main_question.main_id AS id,
          category.id AS category_id, category.name AS category
          FROM public.post
          JOIN version ON post.id = version.post_id
          JOIN (
              SELECT question.category_id AS category_id, question.title AS title, question.post_id AS main_id, question.post_id AS out_id
              FROM question
              UNION ALL
              SELECT question.category_id AS category_id, question.title AS title, question.post_id AS main_id, answer.post_id AS out_id
              FROM question
              JOIN answer ON question.post_id = answer.question_id
            ) main_question ON main_question.out_id = post.id
          JOIN category ON category.id = main_question.category_id
          WHERE author_id = ?
          AND version.date=(SELECT MAX(version2.date) FROM version AS version2 WHERE version.post_id=version2.post_id)");
    $stmt->execute(array($user_id));

    return $stmt->fetchAll();
}
