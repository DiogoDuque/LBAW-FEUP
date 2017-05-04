<?php

function getMostRecentQuestions($number_of_questions){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.question JOIN public.post ON question.post_id = post.id ORDER BY creation_date DESC LIMIT ?");
    $stmt->execute(array($number_of_questions));

    return $stmt->fetchAll();
}

function getMostPopularQuestions($number_of_questions){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.question ORDER BY view_count DESC LIMIT ?");
    $stmt->execute(array($number_of_questions));

    return $stmt->fetchAll();
}

function getMostControversialQuestions($number_of_questions){
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM public.question JOIN public.post ON question.post_id = post.id ORDER BY down_votes DESC LIMIT ?");
    $stmt->execute(array($number_of_questions));

    return $stmt->fetchAll();
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

    $stmt=$conn->prepare("INSERT INTO public.question (post_id,title,category_id) VALUES($post_id,:title,:category_id)");
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':category_id',$category_id,PDO::PARAM_STR);
    $stmt->execute();

    $stmt=$conn->prepare("INSERT INTO public.version (post_id,member_id,text) VALUES ($post_id,$author_id,:text)");
    $stmt->bindParam(':text',$text,PDO::PARAM_STR);
    $stmt->execute();

    return $post_id;
}

function search($query, $search_titles, $search_descriptions,$search_answers,$search_order,$search_categories,$limit,$page){
    $offset = ($page-1)*$limit;
    $cat_list = "{".implode(', ',$search_categories)."}";
    global $conn;

    $stmt = $conn->prepare(
        "SELECT question.post_id, question.title, post.up_votes, post.down_votes, member.id ,member.username, question.answer_count, category.id, category.name, version.date, count(*) OVER() as count
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
 
                    ORDER BY :order
                    LIMIT :limit
                    OFFSET :offset;"
    );
    $stmt->bindParam(':search_categories',$cat_list);
    $stmt->bindParam(':query',$query,PDO::PARAM_STR);
    $stmt->bindParam(':order',$search_order,PDO::PARAM_STR);
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
            "id" => $question['post_id'],
            "title" => $question['title'],
            "score" => $question['up_votes'] - $question['down_votes'],
            "answer_count" => $question['answer_count'],
            "author_id" => $question['id'],
            "author_name" => $question['username'],
            "category_id" => $question['category.id'],
            "category_name" => $question['name'],
            "date" => $question['date'],
            "count" => $question['count'],
        ];
        array_push($questions, $q);
    }
    return $questions;
}