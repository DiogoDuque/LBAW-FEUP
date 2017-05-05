<?php

function getCategory($category_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.category WHERE id = ?");
    $stmt->execute(array($category_id));

    return $stmt->fetch();
}

function deleteCategory($category_id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM public.category WHERE id = :id");
    $stmt->bindParam(':id',$category_id,PDO::PARAM_INT);

    return $stmt->execute();
}


function addCategory($category_name){
    global $conn;

    try{
        $stmt = $conn->prepare("INSERT INTO public.category(name) VALUES(:name)");
        $stmt->bindParam(':name',$category_name,PDO::PARAM_STR);
        $stmt->execute();

        $category_id = intval($stmt->fetch()["id"]);

        return $category_id;
    } catch(\Exception $ex) {
        return -1;
    }

}

function getAllCategories(){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.category");
    $stmt->execute();

    return $stmt->fetchAll();
}