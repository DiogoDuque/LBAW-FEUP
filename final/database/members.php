<?php

if(isset($_POST['action']) && function_exists($_POST['action'])) {

    $action = $_POST['action'];
    $getData = $action();
    echo $getData ? 'true' : 'false';
}

function getMemberById($id){
    global $conn;

    $stmt = $conn->prepare("
        SELECT member.*, image.filename
        FROM public.member 
        LEFT JOIN image ON (member.image_id = image.id)
        WHERE member.id = ?");
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getMemberByUsername($username){
    global $conn;

    $stmt = $conn->prepare("SELECT member.*, image.filename FROM public.member LEFT JOIN image ON (member.image_id = image.id) WHERE username = ?");
    $stmt->execute(array($username));

    return $stmt->fetch();
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

    return false;
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

    return false;
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
        $_SESSION['error_messages'] = "An account is already associated with the email given.";

        return -2;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO member (username, email, hashed_pass)VALUES (?, ?, ?)");
        $stmt->execute(array($username, $email, password_hash($password, PASSWORD_BCRYPT)));
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
                            WHERE username = ?");
    $stmt->execute(array($username));

    $user = $stmt->fetch();
    if($user == null)
        return "User does not exist!";
    else if(!password_verify($password, substr($user['hashed_pass'],0,60)))
        return "Password was not correct!";
    else if ($user['isbanned'])
        return "User is banned and cannot login right now!";
    else return $user;
}

function getAllUsernamesAndPrivileges(){
    global $conn;
    $stmt = $conn->prepare("SELECT username, privilege_level FROM member ORDER BY username");
    $stmt->execute();
    return $stmt->fetchAll();
}



function updateUser($user,$username, $password, $email) {
    global $conn;


    if(checkIfUsernameExists($username))
    {
        $_SESSION['error_messages'] = "Username already exists.";

        return -1;
    }

    if(checkIfEmailExists($email))
    {
        $_SESSION['error_messages'] = "An account is already associated with the email given.";

        return -2;
    }

    try {
        $stmt = $conn->prepare("UPDATE public.member SET username=?, email=?, hashed_pass=? WHERE username=?");
        $stmt->execute(array($username, $email, password_hash($password, PASSWORD_BCRYPT),$user));
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

    return 0;
}

function getNumberOfMembers(){

    global $conn;

    $stmt = $conn->prepare("SELECT reltuples::bigint AS estimate FROM pg_class WHERE  oid = 'public.member'::regclass;");
    $stmt->execute();

    return $stmt->fetch()["estimate"];

}

function searchMemberByName($username){

    $search = "%".$username."%";

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM member WHERE LOWER(username) LIKE LOWER(?) ORDER BY username");
    $stmt->execute(array($search));

    return $stmt->fetchAll();

}


