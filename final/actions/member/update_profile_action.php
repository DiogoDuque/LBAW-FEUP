<?php

include_once ("../../config/init.php");

include_once ($BASE_DIR."database/members.php");

$user = $_SESSION["username"];

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if(!isset($user))
    die("You must be logged in to have access to this page...");
if(!isset($username))
    die("Username was not given.");

if(!isset($password))
    die("Password was not given");
if(!isset($email))
    die("Email was not given");

if(updateUser($user,$username, $password, $email) != 0){
    header( "refresh:3;url={$BASE_URL}" );
    $smarty->assign('redirect_destiny', $BASE_URL);
    $smarty->display('common/info.tpl');
}
else{
    header("Location: {$BASE_URL}");

    $_SESSION['username'] = $username;
}

exit();