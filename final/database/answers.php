<?php

function getAnswersToQuestion($question_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.answer WHERE question_id = ?");
    $stmt->execute(array($question_id));

    return $stmt->fetchAll();
}

function getQuestionId($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT question_id FROM public.answer WHERE post_id = ?");
    $stmt->execute(array($post_id));

    $result = $stmt->fetch();
    return $result['question_id'];
}

function submitAnswer($question_id, $text, $author_id){
    global $conn;

    $stmt=$conn->prepare("INSERT INTO public.post(author_id) VALUES(:author_id)");
    $stmt->bindParam(':author_id',$author_id,PDO::PARAM_INT);
    $stmt->execute();

    $post_id = intval($conn->lastInsertId());

    $stmt=$conn->prepare("INSERT INTO public.answer (post_id,question_id) VALUES($post_id,:question_id)");
    $stmt->bindParam(':question_id',$question_id,PDO::PARAM_INT);
    $stmt->execute();

    $stmt=$conn->prepare("INSERT INTO public.version (post_id,member_id,text) VALUES ($post_id,$author_id,:text)");
    $stmt->bindParam(':text',$text,PDO::PARAM_STR);
    $stmt->execute();

    return $post_id;
}

function getNumberOfAnswers(){

    global $conn;

    $stmt = $conn->prepare("SELECT reltuples::bigint AS estimate FROM pg_class WHERE  oid = 'public.answer'::regclass;");
    $stmt->execute();

    return $stmt->fetch()["estimate"];

}