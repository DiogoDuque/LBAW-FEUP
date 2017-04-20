<?php

function getCategory($category_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.category WHERE id = ?");
    $stmt->execute(array($category_id));

    return $stmt->fetch();
}