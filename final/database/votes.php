<?php

function addVote($post_id, $member_id, $value)
{
    global $conn;

    $vote = getVote($post_id, $member_id);

    if(!$vote === false) {

        $convertedVote = ($vote["value"]) ? 'true' : 'false';

        if($convertedVote === $value){
            echo "Vote deleted.";
            return deleteVote($post_id, $member_id);
        }
        else{
            echo "Vote updated.";
            return updateVote($post_id, $member_id, $value);
        }
    }
    else {

        try {
            $stmt = $conn->prepare("INSERT INTO public.vote(post_id, member_id, value) VALUES (?, ?, ?)");
            $stmt->execute(array($post_id, $member_id, $value));
            echo "Vote inserted.";
            return true;
        } catch (PDOException $err) {

            echo $err->getMessage();

            return false;
        }
    }
}

function getVote($post_id, $member_id){
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM public.vote WHERE vote.post_id = ? AND vote.member_id = ?");
        $stmt->execute(array($post_id, $member_id));

        return $stmt->fetch();
    }

    catch (PDOException $err) {
        echo $err->getMessage();
    }
}

function updateVote($post_id, $member_id, $value){
    global $conn;

    echo "Update: ";
    var_dump($post_id, $member_id, $value);

    try {
        $stmt = $conn->prepare("UPDATE public.vote SET value = ? WHERE post_id = ? AND member_id = ?");
        $stmt->execute(array($value, $post_id, $member_id));
        return true;
    }

    catch (PDOException $err) {
        echo $err->getMessage();
        return false;
    }
}

function deleteVote($post_id, $member_id){
    global $conn;

    try {
        $stmt = $conn->prepare("DELETE FROM public.vote WHERE vote.post_id = ? AND vote.member_id = ?");
        $stmt->execute(array($post_id, $member_id));
        return true;
    }

    catch (PDOException $err) {
        echo $err->getMessage();
        return false;
    }
}

function updateVotes(){

    global $conn;

    $stmt = $conn->prepare("SELECT update_votes_in_posts_f (?)");
    $stmt->execute(array(date('Y-m-d')));

}