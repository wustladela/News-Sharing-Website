<?php
require "database.php";
session_start();
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$story_id = $_POST['story_id'];

$stmt2 = $mysqli->prepare("delete from comments where story_id = ?");
if(!$stmt2){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt2->bind_param('i', $story_id); 
$stmt2->execute();
$stmt2->close();

$stmt = $mysqli->prepare("delete from stories where story_id = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $story_id); 
$stmt->execute();
$stmt->close();



header("location: StoryListPage.php");
?>