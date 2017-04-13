<?php
$db = new pg_connect("host=localhost port=5432 dbname=howhydb"); //TODO edit connection to db

$title = $_POST['title'];
$category = $_POST['category'];
$text = $_POST['text'];

function submitQuestion(){
    global $db;
    global $title;
    global $category;
    global $text;

    //TODO use cathegory
    $stmt= $db->prepare("INSERT INTO question(title,text) VALUES(:title,:text)");
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':$text',$text,PDO::PARAM_STR);
    $stmt->execute();
    //TODO check if okay and return
}


$result = submitQuestion();
//TODO return result

?>