<?php

function addVote($post_id, $member_id, $value)
{
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO public.vote(post_id, member_id, value) VALUES (?, ?, ?)");
        $stmt->execute(array($post_id, $member_id, $value));
        return true;
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

function updateVotes(){

    global $conn;

    $stmt = $conn->prepare("SELECT update_votes_in_posts_f (?)");
    $stmt->execute(array(date('Y-m-d')));

}