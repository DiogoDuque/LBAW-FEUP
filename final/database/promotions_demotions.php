<?php


function createPromotionDemotion($newPrivilegeLevel, $targetMemberId, $adminId){
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO public.promotiondemotion(privilege_level, member_id, admin_id) VALUES (?, ?, ?)");
        $stmt->execute(array($newPrivilegeLevel, $targetMemberId, $adminId));
        return true;
    } catch (PDOException $err) {

        echo $err->getMessage();

        return false;
    }
}
