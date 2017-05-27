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

function getReports($page, $category = "any"){
    global $conn;

    if($category == "any") {

        $stmt = $conn->prepare(
            "SELECT report.report_type AS type, report.description AS description, report.id AS id,
            member.username AS report_author,
            member.id AS report_author_id,
            member2.username AS post_author,
            member2.id AS post_author_id,
            main_question.main_id AS question_id,
            main_question.category_id AS category_id,
            version.text AS post_text
            FROM report
            JOIN post ON report.post_id = post.id
            JOIN member ON  report.creator_id = member.id
            JOIN (
              SELECT question.category_id AS category_id, question.post_id AS main_id, question.post_id AS out_id
              FROM question
              UNION ALL
              SELECT question.category_id AS category_id, question.post_id AS main_id, answer.post_id AS out_id
              FROM question
              JOIN answer ON question.post_id = answer.question_id
            ) main_question ON main_question.out_id = report.post_id
            JOIN version ON post.id = version.post_id
            JOIN member AS member2 ON version.member_id = member2.id
            WHERE version.date=(SELECT MAX(version2.date) FROM version AS version2 WHERE version.post_id=version2.post_id)
            ORDER BY report.creation_date DESC
            LIMIT 10
            OFFSET :page * 10;");
        $stmt->bindParam(':page',$page,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    return 0;
}