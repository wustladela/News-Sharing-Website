<?php
require "database.php";
session_start();
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
if(!isset($_SESSION['username'])){
    echo "You must be logged in to vote.";
    exit;
}
if(isset($_POST['story_id'])){
    $story_id = $_POST['story_id'];
    $story_votes = $_POST['story_votes'];
    ++$story_votes;
    
    $stmt = $mysqli->prepare("update stories set story_votes = ? where story_id = ?");
     if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
    $stmt->bind_param('ii', $story_votes, $story_id); 
        $stmt->execute();
        $stmt->close();
        header("location: individualStoryPage.php?id=$story_id");  
}
if(isset($_POST['comment_id'])){
    $comment_id = $_POST['comment_id'];
    $comment_votes = $_POST['comment_votes'];
    ++$comment_votes;
    
    $stmt = $mysqli->prepare("update comments set comment_votes = ? where comment_id = ?");
     if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
    $stmt->bind_param('ii', $comment_votes, $comment_id); 
        $stmt->execute();
        $stmt->close();
    
    $stmt2 = $mysqli->prepare("select story_id from comments where comment_id = ?");
     if(!$stmt2){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
    $stmt2->bind_param('i', $comment_id); 
        $stmt2->execute();
        $stmt2->bind_result($story_id);
        $stmt2->fetch();
        $stmt2->close();
        header("location: individualStoryPage.php?id=$story_id");  
    
}



?>