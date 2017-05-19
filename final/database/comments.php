<?php

function getCommentsToPost($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.comment WHERE post_id = ? ORDER BY creation_date");
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

function editComment($id, $text){
    global $conn;

    $stmt = $conn->prepare("UPDATE public.comment SET text = :text, last_modification_date=current_date WHERE id = :id");
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->bindParam(':text',$text, PDO::PARAM_STR);
    return $stmt->execute();
}


function submitComment($post_id, $author_id, $text){
    global $conn;

    $stmt=$conn->prepare(
        "INSERT INTO comment(post_id,member_id,text)
                      VALUES (:post_id,:member_id,:text);");
    $stmt->bindParam(':post_id',$post_id,PDO::PARAM_INT);
    $stmt->bindParam(':member_id',$author_id,PDO::PARAM_INT);
    $stmt->bindParam(':text',$text,PDO::PARAM_INT);
    $stmt->execute();

    return 0;
}