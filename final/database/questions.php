<?php

function getMostRecentQuestions($category, $number_of_questions){
    return searchAll( "date DESC", $category,$number_of_questions, 1);
}

function getMostPopularQuestions($category, $number_of_questions){
    return searchAll( "score DESC", $category,$number_of_questions, 1);
}

function getMostControversialQuestions($category, $number_of_questions){
    return searchAll( "post.down_votes DESC", $category,$number_of_questions, 1);
}

function getQuestion($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.question WHERE post_id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetch();
}

function submitQuestion($title, $category, $text, $author_id){
    global $conn;

    $stmt=$conn->prepare("INSERT INTO public.post(author_id) VALUES(:author_id)");
    $stmt->bindParam(':author_id',$author_id,PDO::PARAM_INT);
    $stmt->execute();

    $post_id = intval($conn->lastInsertId());

    $stmt = $conn->prepare("SELECT id FROM public.category WHERE name=?");
    $stmt->execute(array($category));

    $category_id = intval($stmt->fetch()["id"]);

    $stmt=$conn->prepare("INSERT INTO public.question (post_id,title,category_id) VALUES(:post_id,:title,:category_id)");
    $stmt->bindParam(':post_id',$post_id,PDO::PARAM_INT);
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':category_id',$category_id,PDO::PARAM_INT);
    $stmt->execute();

    $stmt=$conn->prepare("INSERT INTO public.version (post_id,member_id,text) VALUES ($post_id,$author_id,:text)");
    $stmt->bindParam(':text',$text,PDO::PARAM_STR);
    $stmt->execute();

    return $post_id;
}

function searchAll($search_order,$search_categories,$limit,$page){
    $offset = ($page-1)*$limit;
    $cat_list = "{".implode(', ',$search_categories)."}";
    global $conn;

    $stmt = $conn->prepare(
        "SELECT question.post_id AS id, question.title AS title, (post.up_votes - post.down_votes) AS score,
                          member.id AS author_id ,member.username AS author, question.answer_count AS answer_count,
                          category.id AS category_id, category.name AS category, version.date AS date, count(*) OVER() as count
                    FROM question 
                    JOIN post ON question.post_id = post.id
                    JOIN version ON version.post_id = post.id
                    JOIN member ON post.author_id = member.id
                    JOIN category ON category.id = question.category_id
                    WHERE category.id = ANY (:search_categories::int[])
                    AND version.date=(SELECT MAX(version2.date) FROM version AS version2 WHERE version.id=version2.id)
 
 
                    ORDER BY $search_order
                    LIMIT :limit
                    OFFSET :offset;"
    );
    $stmt->bindParam(':search_categories',$cat_list);
    $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
    $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);


    $stmt->execute();
    $res =  $stmt->fetchAll();

    $questions = [];
    foreach($res as $key => $question){
        $q = [
            "id" => $question['id'],
            "title" => $question['title'],
            "score" => $question['score'],
            "answer_count" => $question['answer_count'],
            "author_id" => $question['author_id'],
            "author" => $question['author'],
            "category_id" => $question['category_id'],
            "category" => $question['category'],
            "date" => $question['date'],
            "count" => $question['count'],
        ];
        array_push($questions, $q);
    }
    return $questions;
}

function search($query, $search_titles, $search_descriptions,$search_answers,$search_order,$search_categories,$limit,$page){
    $offset = ($page-1)*$limit;
    $cat_list = "{".implode(', ',$search_categories)."}";
    global $conn;

    $stmt = $conn->prepare(
        "SELECT question.post_id AS id, question.title AS title, (post.up_votes - post.down_votes) AS score,
                          member.id AS author_id ,member.username AS author, question.answer_count AS answer_count,
                          category.id AS category_id, category.name AS category, version.date AS date, count(*) OVER() as count
                    FROM question 
                    JOIN post ON question.post_id = post.id
                    JOIN version ON version.post_id = post.id
                    JOIN member ON post.author_id = member.id
                    JOIN category ON category.id = question.category_id
                    WHERE category.id = ANY (:search_categories::int[])
                    AND version.date=(SELECT MAX(version2.date) FROM version AS version2 WHERE version.id=version2.id)
                    AND(
                    (:search_titles AND to_tsvector(question.title) @@ plainto_tsquery(:query))
                    OR (:search_descriptions AND to_tsvector(version.text) @@ plainto_tsquery(:query))
                    OR (:search_answers AND EXISTS (
                        SELECT *
                        FROM answer
                        JOIN post AS postA ON answer.post_id = postA.id
                        JOIN version AS versionA ON postA.id = versionA.post_id
                        WHERE answer.question_id =question.post_id
                        AND versionA.date =(SELECT MAX(versionA2.date) FROM version AS versionA2 WHERE versionA.id=versionA2.id)
                        AND to_tsvector(version.text) @@ plainto_tsquery(:query)
                        ))
                    )
 
 
                    ORDER BY $search_order
                    LIMIT :limit
                    OFFSET :offset;"
    );
    $stmt->bindParam(':search_categories',$cat_list);
    $stmt->bindParam(':query',$query,PDO::PARAM_STR);
    $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
    $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
    $stmt->bindParam(':search_titles',$search_titles,PDO::PARAM_BOOL);
    $stmt->bindParam(':search_descriptions',$search_descriptions,PDO::PARAM_BOOL);
    $stmt->bindParam(':search_answers',$search_answers,PDO::PARAM_BOOL);

    $stmt->execute();
    $res =  $stmt->fetchAll();

    $questions = [];
    foreach($res as $key => $question){
        $q = [
            "id" => $question['id'],
            "title" => $question['title'],
            "score" => $question['score'],
            "answer_count" => $question['answer_count'],
            "author_id" => $question['author_id'],
            "author" => $question['author'],
            "category_id" => $question['category_id'],
            "category" => $question['category'],
            "date" => $question['date'],
            "count" => $question['count'],
        ];
        array_push($questions, $q);
    }
    return $questions;
}

function getQuestionTitle($post_id){
    global $conn;

    $stmt = $conn->prepare("SELECT question.title FROM public.question WHERE post_id = ?");
    $stmt->execute(array($post_id));

    return $stmt->fetch();
}
