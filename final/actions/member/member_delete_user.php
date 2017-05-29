<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/members.php");

header('Content-Type: application/json');
$response = array();

$data = json_decode(stripslashes($_POST['data']));

$password = $data[0];
$username = $data[1];
$currentUser = getMemberByUsername($_SESSION['username']);

if(strcmp($username,$currentUser['username'])!=0)
    $response="There seems to be a problem with your username. Contact an Administrator for more information.";
else if(!password_verify($password, substr($currentUser['hashed_pass'],0,60)))
    $response="Password was not correct.";
else {
    session_unset();
    session_destroy();
    global $conn;
    $stmt = $conn->prepare("DELETE FROM member WHERE username = ?");
    if(!$stmt->execute(array($username))){ //if operation went wrong
        $response = "Something went wrong while deleting you. Contact an Administrator for more information.";
    } else $response = "You were successfully deleted. We're sorry to see you go...";
}

echo json_encode($response);

?>