<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/posts.php");
include_once ($BASE_DIR."database/members.php");

header('Content-Type: application/json');
$data = json_decode(stripslashes($_POST['data']));
$author=$data[0];
$text=$data[1];
$questionId=$data[2];

if (!isset($_SESSION['username']))
    die('Member not authenticated.');

//delete only happens if user.hasPermissions
$member = getMemberByUsername($_SESSION['username']);
if($member['privilege_level'] == "Member")
	die('You don\'t have permissions for deleting an answer...');

//TODO check if post has right text
global $conn;
$stmt = $conn->prepare("SELECT answer.post_id FROM answer JOIN version ON answer.post_id=version.post_id JOIN post ON post.id=answer.post_id JOIN member ON member.id=post.author_id WHERE answer.question_id=? AND version.text=? AND member.username=? AND version.date=(SELECT MAX(version2.date) FROM version AS version2 WHERE version.id=version2.id)");
$stmt->execute(array($questionId,$text,$author));
$post = $stmt->fetch();

if($post===false)
	die('An error occurred fetching the post');

$post = getPost($post['post_id']);
if($post===false)
	die('Answer does not exist!');

//try to delete answer
if(deletePost($post['id']))
	$response['message'] = "Post deleted successfully!";
else $response['message'] = "Error: could not delete post...";

echo json_encode($response);
?>