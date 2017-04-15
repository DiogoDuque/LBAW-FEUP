<?php

$title = $_POST['title'];
$category = $_POST['category'];
$text = $_POST['text'];
$author_id = 1; //TODO get from logged in, not hardcoded

function submitQuestion(){
    global $conn;
    global $title;
    global $category;
    global $text;
    global $author_id;

    $stmt=$conn->prepare("INSERT INTO public.post(author_id) VALUES(:author_id)");
    $stmt->bindParam(':author_id',$author_id,PDO::PARAM_INT);
    $stmt->execute();

    $post_id=$conn->query("SELECT id FROM public.post WHERE id=MAX(id)");
    $category_id=$conn->query("SELECT id FROM public.category WHERE name=$category");

    $stmt=$conn->prepare("INSERT INTO public.question (post_id,title,category_id) VALUES($post_id,:title,:category_id)");
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':category_id',$category_id,PDO::PARAM_STR);
    $stmt->execute();

    $stmt=$conn->prepare("INSERT INTO public.version (post_id,member_id,text) VALUES ($post_id,$author_id,:text)");
    $stmt->bindParam(':text',$text,PDO::PARAM_STR);
    $stmt->execute();
}


submitQuestion();
//TODO make verifications and return result

?>