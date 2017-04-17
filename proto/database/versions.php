<?php

function addVersion($text, $post_id, $member_id){
    global $conn;

    $stmt=$conn->prepare("INSERT INTO public.version(text, post_id, member_id) VALUES (?, ?, ?)");
    $stmt->execute(array($text, $post_id, $member_id));

    $version_id = intval($conn->lastInsertId());

    return $version_id;
}
