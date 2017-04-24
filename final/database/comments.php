<?php

function getCommentsToPost($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.comment WHERE post_id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetchAll();
}