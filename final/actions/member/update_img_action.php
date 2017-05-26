<?php

include_once ("../../config/init.php");

include_once ($BASE_DIR."database/members.php");


$photo = $_FILES['photo'];
$extension = end(explode(".", $photo["name"]));

move_uploaded_file($photo["tmp_name"], $BASE_DIR . "resources/img/" . $username . '.' . $extension);



?>