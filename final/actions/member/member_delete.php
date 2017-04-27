<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/members.php");

$strRequest = file_get_contents('php://input');
$Request = json_decode($strRequest);

$password = $Request[0];
$usernames = $Request[1];
$currentUser = getMemberByUsername($_SESSION['username']);

$data['message']="All users were successfully deleted";
$data['users']="";

if($currentUser['hashed_pass'] != sha1($password)){ //check for password
	$data['message'] = "Password does not match";

} else if($currentUser['privilege_level'] != "Administrator"){ //check for permissions
	$data['message'] = "User does not have permissions for that";

} else{
	global $conn;
	foreach ($usernames as $user) {
		$stmt = $conn->prepare("DELETE FROM public.member WHERE username = ?");
		if(!$stmt->execute(array($user))){ //if operation went wrong
			$data['message'] = "Some users may have not been deleted: ";
			$data['users'] = $data['users'].$user." ";
		}
	}
}

echo json_encode($data);
?>