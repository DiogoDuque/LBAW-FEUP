<?php

function addVote($post_id, $member_id, $value)
{
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO public.vote(post_id, member_id, value) VALUES (?, ?, ?)");
        $stmt->execute(array($post_id, $member_id, $value));
        $result = $stmt->fetch();
        return $result;
    }

    catch (PDOException $err) {
        // 1062 - Duplicate entry
        if ($err->getCode() == 1062)
        {
            echo "Duplicate entry";
        }

        return false;
    }
}