<?php

include_once("../../config/init.php");

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

var_dump($_POST);

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

