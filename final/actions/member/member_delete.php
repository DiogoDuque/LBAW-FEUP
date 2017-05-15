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
//password_verify($password, $user['hashed_pass'])
if(password_verify($password,str_replace(' ', '',$currentUser['hashed_pass']))) { //check for password
	$response['message'] = "Password does not match";

} else if($currentUser['privilege_level'] != "Administrator"){ //check for permissions
	$response['message'] = "User does not have permissions for that";

} else{
	global $conn;
	foreach ($usernames as $user) {
		$user=mb_substr($user,1,NULL,"UTF-8");
		$stmt = $conn->prepare("DELETE FROM member WHERE username = ?");
		if(!$stmt->execute(array($user))){ //if operation went wrong
			$response['message'] = "Some users may have not been deleted: ";
			$response['users'] = $response['users'].$user." ";
		}
	}
}

echo json_encode($response);
?>