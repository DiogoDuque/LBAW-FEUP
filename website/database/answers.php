<?php

function getAnswersToQuestion($question_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.answer WHERE question_id = ?");
    $stmt->execute(array($question_id));

    return $stmt->fetchAll();
}