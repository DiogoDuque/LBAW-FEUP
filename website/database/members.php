<?php

function checkIfUsernameExists($username){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM public.member WHERE username = ?");
        $stmt->execute(array($username));

        $list_of_names = $stmt->fetchAll();

        if(count($list_of_names) != 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
}

function createUser($username, $password, $email) {
    global $conn;


    if(checkIfUsernameExists($username))
    {
        echo "Username already exists.";
        return -1;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO member (username, email, hashed_pass)VALUES (?, ?, ?)");
        $stmt->execute(array($username, $email, sha1($password)));
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return 0;
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