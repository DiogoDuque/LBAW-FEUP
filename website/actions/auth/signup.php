<?php

    include_once ("../../config/init.php");

    include_once ("{$BASE_DIR}/database/members.php");

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    createUser($username, $password, $email);

