<?php

function getPost($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.post WHERE id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetch();
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