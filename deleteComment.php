<?php
require "database.php";
session_start();
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$comment_id = $_POST['comment_id'];

$stmt = $mysqli->prepare("select story_id from comments where comment_id = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('i', $comment_id); 
$stmt->execute();
$stmt->bind_result($story_id);
$stmt->fetch();
$stmt->close();

$stmt2 = $mysqli->prepare("delete from comments where comment_id = ?");
if(!$stmt2){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt2->bind_param('i', $comment_id); 
$stmt2->execute();
$stmt2->close();

header("location: individualStoryPage.php?id=$story_id");
?>