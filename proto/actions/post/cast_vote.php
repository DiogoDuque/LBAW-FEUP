<?php
header('Content-Type: application/json');
$result = array();

//TODO - RECEBER AJAX e dar às variaveis
$voteValue = "true";
$questionId = 1;
$voterUsername = "Sofia";
$posterUsername = "Giada";
$text = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus. Ut nec urna et arcu imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus";

//TODO - process info - Isto é o que é preciso fazer na bd
/*               if post_id==question_id
                   vote.post_id=question_id
                 else vote.post_id=answer_id WHERE answer with postId was made by questionAuthor AND version is latest (use 'WHERE MAX(date)')
                    */

//TODO send


echo json_encode($result);
?>