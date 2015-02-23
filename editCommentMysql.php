<?php
        require "database.php";
        session_start();
        if($_SESSION['token'] !== $_POST['token']){
            die("Request forgery detected");
        }
        $comment_id = $_POST['comment_id'];
        $new_comment_body = $_POST['edit_comment_body'];
        
        $stmt = $mysqli->prepare("update comments set comment_body = ? where comment_id = ?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('si', $new_comment_body, $comment_id); 
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
        echo $story_id;
        
       header("location: individualStoryPage.php?id=$story_id");
?>