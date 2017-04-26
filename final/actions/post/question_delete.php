<?php

include_once("../../config/init.php");
//include_once ($BASE_DIR."database/posts.php");
//include_once ($BASE_DIR."database/versions.php");
//include_once ($BASE_DIR."database/members.php");

if (!isset($_GET['id']))
    die('Missing post ID.');

if (!isset($_SESSION['username']))
    die('Member not authenticated.');

die('Work in Progress...');
//TODO check if username==author or username.hasPermissions

//TODO delete question