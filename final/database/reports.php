<?php
function submitReport($post_id, $author_id, $type, $description){
    global $conn;

    $stmt=$conn->prepare(
        "INSERT INTO report(post_id,creator_id,description, report_type)
                      VALUES (:post_id,:member_id,:description,:report_type);");
    $stmt->bindParam(':post_id',$post_id,PDO::PARAM_INT);
    $stmt->bindParam(':member_id',$author_id,PDO::PARAM_INT);
    $stmt->bindParam(':description',$description,PDO::PARAM_STR);
    $stmt->bindParam(':report_type',$type,PDO::PARAM_STR);
    $stmt->execute();

    return 0;
}