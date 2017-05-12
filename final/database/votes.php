<?php

function addVote($post_id, $member_id, $value)
{
    $vote = getVote($post_id, $member_id);

    if(!($vote === false)) {

        $convertedVote = ($vote["value"]) ? 'true' : 'false';

        if($convertedVote === $value){
            return deleteVote($post_id, $member_id);
        }
        else{
            $delete = deleteVote($post_id, $member_id);
            $create = createVote($post_id, $member_id, $value);

            return($delete && $create);
        }
    }
    else {

        return createVote($post_id, $member_id, $value);

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

function getPostsVotedOn($member_id){
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT vote.post_id, vote.value FROM public.vote WHERE vote.member_id = ?");
        $stmt->execute(array($member_id));

        $results = $stmt->fetchAll();

        return $results;
    }

    catch (PDOException $err) {
        echo $err->getMessage();
    }
}

function createVote($post_id, $member_id, $value){
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO public.vote(post_id, member_id, value) VALUES (?, ?, ?)");
        $stmt->execute(array($post_id, $member_id, $value));
        return true;
    } catch (PDOException $err) {

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

    $lastUpdate = getLastUpdateDate();

    if($lastUpdate == "")
    {
        $lastUpdate = date('2017-01-01 00:00:00');
    }

    global $conn;

    try {


        $stmt = $conn->prepare("SELECT update_votes_in_posts_f (?)");
        $stmt->execute(array($lastUpdate));

        $currentDate = date('Y-m-d H:i:s');

        $lastUpdate = $currentDate;
        updateLastUpdateDate($lastUpdate);

        return true;
    }

    catch (PDOException $err) {
        echo $err->getMessage();
        return false;
    }

}

function updateLastUpdateDate($date) {
    $file = 'lastUpdate.txt';

    file_put_contents($file, $date);
}

function getLastUpdateDate(){
    $file = 'lastUpdate.txt';

    return file_get_contents($file);
}


