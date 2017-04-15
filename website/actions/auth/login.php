<?php
    include_once ("../../config/init.php");

    include_once ("{$BASE_DIR}/database/members.php");

	$username = $_POST['username'];
  	$password = $_POST['password'];  

	if (isLoginCorrect($username, $password)) {
		$_SESSION['username'] = $username;
		header("Location: {$BASE_URL}/pages/profile/view_profile.php");
	} else {
		$_SESSION['error'] = "Error: username or password wrong!";
		header("Location: {$BASE_URL}/pages/home.php");
	}

?>