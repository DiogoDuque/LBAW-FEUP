<?php

// TODO: Verify with professor if we can use these functions or the PDO's exceptions should be enough

if(isset($_POST['action']) && function_exists($_POST['action'])) {

    $action = $_POST['action'];
    $getData = $action();
    echo $getData ? 'true' : 'false';

}

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

function checkIfEmailExists($email){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM public.member WHERE email = ?");
        $stmt->execute(array($email));

        $list_of_emails = $stmt->fetchAll();

        if(count($list_of_emails) != 0)
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
        $_SESSION['error_messages'] = "Username already exists.";

        return -1;
    }

    if(checkIfEmailExists($email))
    {
        $_SESSION['error_messages'] =  "An account is already associated with the email given.";

        return -2;
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
                            WHERE username = ? AND hashed_pass = ?");
    $stmt->execute(array($username, sha1($password)));

    return ($stmt->fetch()["id"] != null);
}
