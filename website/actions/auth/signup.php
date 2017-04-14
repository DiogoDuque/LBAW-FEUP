<?php

    include_once ("../../config/init.php");

    include_once ("{$BASE_DIR}/database/members.php");

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(createUser($username, $password, $email) != 0){
        header( "refresh:2;url={$BASE_URL}" );
    }
    else{
        header("Location: {$BASE_URL}");
        exit();
    }

