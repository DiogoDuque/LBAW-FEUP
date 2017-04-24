<?php
    include_once ("../../config/init.php");

    include_once ($BASE_DIR."database/members.php");

	$username = $_POST['username'];
  	$password = $_POST['password'];  

	if ($id = isLoginCorrect($username, $password)) {

		$_SESSION['username'] = $username;

		$destination = $BASE_URL."pages/profile/view_profile.php";

		header("Location: ".$destination);

	} else {
		$_SESSION['error_messages'] = "Error: username or password wrong!";

        $destination = $BASE_URL."pages/home.php";

        header( "refresh:3;url={$destination}" );
        $smarty->assign('redirect_destiny', $destination);
        $smarty->display('common/info.tpl');

	}

exit();

