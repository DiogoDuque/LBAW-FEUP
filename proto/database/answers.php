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
