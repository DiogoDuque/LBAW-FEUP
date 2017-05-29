<?php

function addImage($member_id, $filename){
    global $conn;

    $stmt=$conn->prepare("INSERT INTO public.image(filename) VALUES (?) RETURNING id");
    $stmt->execute(array($filename));
    $id = intval($stmt->fetch()[id]);

    $stmt=$conn->prepare("UPDATE public.member SET image_id = ? WHERE id = ?");
    $stmt->execute(array($id, $member_id));
    return $id;
}

function getImage($id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.image WHERE id = :id");
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch();
}

function deleteImage($id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM public.image WHERE id = :id");
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    return $stmt->execute();
}

function addImageToServer($file){
    global $BASE_DIR;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check == false) {
           die("The file is not an image.");
        }
    }

    // Check file size
    if ($file["size"] > 1024*1024) {
        die("The image is too big.");
    }

    $imageFileType = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
    $filename = time().".".$imageFileType;
    $target_dir = $BASE_DIR."resources/uploads/";

    // if everything is ok, try to upload file
    if (move_uploaded_file($file["tmp_name"], $target_dir.$filename)) {
        return $filename;
    } else {
        die("Something failed. We are sorry...");
    }
}

function deleteImageFromServer($filename){
    global $BASE_DIR;
    $target_dir = $BASE_DIR."resources/uploads/";
    unlink($target_dir.$filename);
}