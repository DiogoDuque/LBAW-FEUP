<?php
    include_once ("../../config/init.php");

    include_once ($BASE_DIR."database/members.php");
    include_once ($BASE_DIR."database/votes.php");

    if (!isset($_POST['username']))
        die('Missing username.');

    if (!isset($_POST['password']))
        die('Missing password.');


    $username = $_POST['username'];
  	$password = $_POST['password'];  

	if ($id = isLoginCorrect($username, $password)) {

		$_SESSION['username'] = $username;
		$_SESSION['votedPosts'] = getPostsVotedOn(getMemberByUsername($username)["id"]);

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

