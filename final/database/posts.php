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

    $stmt = $conn->prepare("SELECT * FROM public.post WHERE author_id = ?");
    $stmt->execute(array($user_id));

    return $stmt->fetchAll();
}
