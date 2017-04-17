<?php

function submitQuestion($title, $category, $text, $author_id){
    global $conn;

    $stmt=$conn->prepare("INSERT INTO public.post(author_id) VALUES(:author_id)");
    $stmt->bindParam(':author_id',$author_id,PDO::PARAM_INT);
    $stmt->execute();

    $post_id = intval($conn->lastInsertId());

    $stmt = $conn->prepare("SELECT id FROM public.category WHERE name=?");
    $stmt->execute(array($category));

    $category_id = intval($stmt->fetch());

    $stmt=$conn->prepare("INSERT INTO public.question (post_id,title,category_id) VALUES($post_id,:title,:category_id)");
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':category_id',$category_id,PDO::PARAM_STR);
    $stmt->execute();

    $stmt=$conn->prepare("INSERT INTO public.version (post_id,member_id,text) VALUES ($post_id,$author_id,:text)");
    $stmt->bindParam(':text',$text,PDO::PARAM_STR);
    $stmt->execute();

    return $post_id;
}
