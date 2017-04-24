<?php

function addVersion($text, $post_id, $member_id){
    global $conn;

    $stmt=$conn->prepare("INSERT INTO public.version(text, post_id, member_id) VALUES (?, ?, ?)");
    $stmt->execute(array($text, $post_id, $member_id));

    $version_id = intval($conn->lastInsertId());

    return $version_id;
}

function getLatestPostVersion($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.version WHERE post_id = ? ORDER BY date DESC LIMIT 1");
    $stmt->execute(array($post_id));

    return $stmt->fetch();
}
