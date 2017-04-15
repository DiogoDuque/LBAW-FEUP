<?php

class DatabaseGetter{

    function getCategory($category_id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM public.category WHERE id = ?");
        $stmt->execute(array($category_id));

        return $stmt->fetch();
    }

    function getMember($id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM public.member WHERE id = ?");
        $stmt->execute(array($id));

        return $stmt->fetch();
    }

    function getPost($post_id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM public.post WHERE id = ?");
        $stmt->execute(array($post_id));

        return $stmt->fetch();
    }

    function getQuestion($post_id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM public.question WHERE post_id = ?");
        $stmt->execute(array($post_id));

        return $stmt->fetch();
    }

    function getLatestPostVersion($post_id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM public.version WHERE post_id = ? ORDER BY date DESC LIMIT 1");
        $stmt->execute(array($post_id));

        return $stmt->fetch();
    }

    function getAnswersToQuestion($question_id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM public.answer WHERE question_id = ?");
        $stmt->execute(array($question_id));

        return $stmt->fetchAll();
    }

    function getCommentsToPost($post_id){
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM public.comment WHERE post_id = ?");
        $stmt->execute(array($post_id));

        return $stmt->fetchAll();
    }
}