<?php
        require "database.php";
        session_start();
        if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
        }
        $story_id = $_POST['story_id'];
        $new_story_title = $_POST['edit_story_title'];
        $new_story_body = $_POST['edit_story_body'];
        $new_story_link = $_POST['edit_story_link'];
        echo $story_id . "<br>" . $new_story_title . "<br>" . $new_story_body;
        if($new_story_title!=""){
                $stmt = $mysqli->prepare("update stories set story_title = ? where story_id = ?");
                if(!$stmt){
                        printf("Query Prep Failed: %s\n", $mysqli->error);
                        exit;
                }
                $stmt->bind_param('si', $new_story_title, $story_id); 
                $stmt->execute();
                $stmt->close();       
        }
        if($new_story_body != ""){
                $stmt2 = $mysqli->prepare("update stories set story_body = ? where story_id = ?");
                if(!$stmt2){
                        printf("Query Prep Failed: %s\n", $mysqli->error);
                        exit;
                }
                $stmt2->bind_param('si', $new_story_body, $story_id); 
                $stmt2->execute();
                $stmt2->close();
        }
        if($new_story_link != ""){
                $stmt3 = $mysqli->prepare("update stories set story_link = ? where story_id = ?");
                if(!$stmt3){
                        printf("Query Prep Failed: %s\n", $mysqli->error);
                        exit;
                }
                $stmt3->bind_param('si', $new_story_link, $story_id); 
                $stmt3->execute();
                $stmt3->close();
        }
        header("location: individualStoryPage.php?id=$story_id");
?>