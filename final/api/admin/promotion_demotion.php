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

$adminId = intval(getMemberByUsername($_SESSION['username'])['id']);
$targetMemberId = intval(getMemberByUsername($_POST['targetMemberUsername'])['id']);

var_dump($_POST['targetMemberUsername'], $targetMemberId);

if(!createPromotionDemotion($_POST['newPrivilegeLevel'], $targetMemberId, $adminId))
{
    $response['status'] = error;
    $response['errorMessage'] = "Could not create new Promotion/Demotion";
    echo json_encode($response);
    return;
}
else
{
    $response['status'] = success;
}

echo json_encode($response);




