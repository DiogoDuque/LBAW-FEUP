<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/members.php");

header('Content-Type: application/json');
$response = array();

$data = json_decode(stripslashes($_POST['data']));

$password = $data[0];
$usernames = $data[1];
$currentUser = getMemberByUsername($_SESSION['username']);

$response['message']="All users were successfully deleted";
$response['users']=" ";

//if(strcmp(str_replace(' ', '',$currentUser['hashed_pass']), sha1($password)) != 0){ //check for password
//$response['message'] = "Password does not match";

//} else if($currentUser['privilege_level'] != "Administrator"){ //check for permissions
//$response['message'] = "User does not have permissions for that";

//} else{
session_unset();
session_destroy();
global $conn;
$stmt = $conn->prepare("DELETE FROM member WHERE username = ?");
if(!$stmt->execute(array($usernames))){ //if operation went wrong
    $response['message'] = "Some users may have not been deleted: ";
    $response['users'] = $response['users'].$user." ";
}
//}


echo json_encode($response);

?>