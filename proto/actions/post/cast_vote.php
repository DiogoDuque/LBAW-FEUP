<?php
header('Content-Type: application/json');
$result = array();

//TODO - RECEBER AJAX e dar às variaveis
$voteValue = "true";
$questionId = 1;
$voterUsername = "Sofia";
$posterUsername = "Giada";
$text = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus";
global $conn;

//get question infos
$stmt = $conn->prepare("SELECT * FROM question WHERE id=:questionId");
$stmt->bindParam(':questionId', $questionId, PDO::PARAM_INT);
$stmt->execute();
$question = $stmt->fetch();

//get voter's id
$stmt = $conn->prepare("SELECT id FROM member WHERE username=:username");
$stmt->bindParam(':username', $voterUsername,PDO::PARAM_STR);
$stmt->execute();
$voterId = $stmt->fetch();

//TODO - process info - Isto é para usar perto da fase final
/*               if post_id==question_id
                   vote.post_id=question_id
                 else vote.post_id=answer_id WHERE answer with postId was made by questionAuthor AND version is latest (use 'WHERE MAX(date)')
                    */

$stmt = $conn->prepare("INSERT INTO vote(post_id, member_id, value) VALUES(:postId, :voterId, :voteValue)");
$stmt->bindParam(); //TODO
$stmt->bindParam(':voterId', $voterId, PDO::PARAM_INT);
$stmt->bindParam(':voteValue', $voteValue, PDO::PARAM_BOOL);
$stmt->execute();



//TODO send


echo json_encode($result);
?>