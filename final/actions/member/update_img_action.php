<?php

include_once ("../../config/init.php");

include_once ($BASE_DIR."database/members.php");
include_once ($BASE_DIR."database/images.php");

if(!isset($_SESSION['username']))
    die("You must be logged in to access this feature.");

$member = getMemberByUsername($_SESSION['username']);
$photo = $_FILES['photo'];
$filename = addImageToServer($photo);

deleteImageFromServer($member["filename"]);

$id = intval($member[id]);

addImage($id, $filename);

header("Location: {$BASE_URL}pages/profile/view_profile.php");