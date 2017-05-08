<?php

function getCommentsToPost($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.comment WHERE post_id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetchAll();
}


function getComment($id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.comment WHERE id = :id");
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch();
}



function deleteComment($id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM public.comment WHERE id = :id");
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    return $stmt->execute();
}