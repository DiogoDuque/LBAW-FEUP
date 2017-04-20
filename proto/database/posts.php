<?php

function getPost($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.post WHERE id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetch();
}