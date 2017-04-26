<?php

function getPost($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.post WHERE id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetch();
}

function deletePost($post_id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM public.post WHERE id = ?");
    return $stmt->execute(array($post_id));
}
