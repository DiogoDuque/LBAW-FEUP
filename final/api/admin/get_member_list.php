<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/members.php");

$_SESSION["member_search_input"] = $_GET["username"];
$_SESSION["member_infos"] = searchMemberByName($_GET["username"]);

echo json_encode($_SESSION["member_infos"]);
