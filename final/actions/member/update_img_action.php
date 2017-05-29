<?php

include_once ("../../config/init.php");

include_once ($BASE_DIR."database/members.php");
include_once ($BASE_DIR."database/images.php");
/*
$photo = $_FILES['photo'];
$extension = end(explode(".", $photo["name"]));
$username = $_POST["username"];

if(!isset($_SESSION['username']))
    die("You must be logged in to access this feature.");
if(!isset($username))
    die("Username was not received");
if(strcmp($username,$_SESSION['username'])!=0)
    die("There seems to be a problem with the username. Contact an Administrator for more information");

move_uploaded_file($photo["tmp_name"], $BASE_DIR . "resources/img/" . $username . '.' . $extension);

header("Location: {$BASE_URL}pages/profile/view_profile.php");

?>*/
if(!isset($_SESSION['username']))
    die("You must be logged in to access this feature.");

$member = getMemberByUsername($_SESSION['username']);
$photo = $_FILES['photo'];
$filename = addImageToServer($photo);

deleteImageFromServer($member["filename"]);

$id = intval($member[id]);

addImage($id, $filename);

header("Location: {$BASE_URL}pages/profile/view_profile.php");