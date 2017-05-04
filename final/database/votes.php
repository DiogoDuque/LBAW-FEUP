<?php

function addVote($post_id, $member_id, $value)
{
    global $conn;

    $vote = getVote($post_id, $member_id);

    if(!$vote === false) {

        $convertedVote = ($vote["value"]) ? 'true' : 'false';

        if($convertedVote === $value){
            echo 'Deleted vote with value '.$value;
            return deleteVote($post_id, $member_id);
        }
        else{
            echo 'Updated vote with value '.$value;
            return updateVote($post_id, $member_id, $value);
        }
    }
    else {

        echo 'Inserted vote with value '.$value;

        try {
            $stmt = $conn->prepare("INSERT INTO public.vote(post_id, member_id, value) VALUES (?, ?, ?)");
            $stmt->execute(array($post_id, $member_id, $value));
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

function getPostsVotedOn($member_id){
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT vote.post_id FROM public.vote WHERE vote.member_id = ?");
        $stmt->execute(array($member_id));

        $results = $stmt->fetchAll();

        $ret = array();

        foreach ($results as $result)
        {
            array_push($ret, $result['post_id']);
        }

        return $ret;
    }

    catch (PDOException $err) {
        echo $err->getMessage();
    }
}

function updateVote($post_id, $member_id, $value){
    global $conn;

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

    $lastUpdate = getLastUpdateDate();

    if($lastUpdate == "")
    {
        $lastUpdate = date('2017-01-01 00:00:00');
    }

    global $conn;

    try {


        $stmt = $conn->prepare("SELECT update_votes_in_posts_f (?)");
        $stmt->execute(array($lastUpdate));

        var_dump($lastUpdate);

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