<?php

function createUser($username, $password, $email) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO member (username, email, hashed_pass)VALUES (?, ?, ?)");
    try {
        $stmt->execute(array($username, $email, sha1($password)));
    }
    catch (PDOException $e)
    {

    }
}

function isLoginCorrect($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM member 
                            WHERE username = ? AND password = ?");
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() == true;
}
?>