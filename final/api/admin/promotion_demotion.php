<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/promotions_demotions.php");
include_once ($BASE_DIR."database/members.php");

if(!isset($_SESSION['username']))
    die("No logged in account detected.");

if(!isset($_POST['targetMemberUsername']))
    die("No member to apply promotion or demotion.");

if(!isset($_POST['newPrivilegeLevel']))
    die("No privilege level to apply.");

header('Content-Type: application/json');
$response = array();

$admin = getMemberByUsername($_SESSION['username']);

if(strcmp($admin['privilege_level'],"Administrator")!=0)
    die("Only Administrators have access to this feature!");

$adminId=intval($admin['id']);
$targetMemberId = intval(getMemberByUsername($_POST['targetMemberUsername'])['id']);
$response = createPromotionDemotion($_POST['newPrivilegeLevel'], $targetMemberId, $adminId);

echo json_encode($response);




