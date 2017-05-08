<?php


function createPromotionDemotion($newPrivilegeLevel, $targetMemberId, $adminId){
    global $conn;

    $response = array();

    try {
        $stmt = $conn->prepare("INSERT INTO public.promotiondemotion(privilege_level, member_id, admin_id) VALUES (?, ?, ?)");
        $stmt->execute(array($newPrivilegeLevel, $targetMemberId, $adminId));

        $response['status'] = success;

    } catch (PDOException $err) {

        $response['status'] = error;
        $response['errorMessage'] = $err->getMessage();
        $response['errorCode'] = $err->getCode();
    }

    return $response;
}
