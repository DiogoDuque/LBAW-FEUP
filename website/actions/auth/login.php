<?php
    include_once ("../../config/init.php");

    include_once ($BASE_DIR."database/members.php");

	$username = $_POST['username'];
  	$password = $_POST['password'];  

	if ($id = isLoginCorrect($username, $password)) {

		$_SESSION['username'] = $username;
		$_SESSION['member_id'] = $id;

		$destination = $BASE_URL."pages/profile/view_profile.php";

		header("Location: ".$destination);

	} else {
		$_SESSION['error'] = "Error: username or password wrong!";

        $destination = $BASE_URL."pages/home.php";

		header("Location: ".$destination);

	}

exit();

