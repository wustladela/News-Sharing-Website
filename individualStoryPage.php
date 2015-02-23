<!DOCTYPE html>
<html>
    <head>
        <title>Module 3</title>
        <link rel="stylesheet" type="text/css" href="news_site_stylesheet.css" />
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <meta charset="utf-8" />
    </head>
    <body>
         <ul id="navigation">
            <li><a href="register.php">&#10029; Register</a></li>
            <li><a href="logged_in.php">&#10029; My Account</a></li>
            <li><a href="logout.php">&#10029; Logout</a></li>
            <li><a href="StoryListPage.php">&#10029; View Stories</a></li>
            <li><a href="postStory.php">&#10029; Post New Story</a></li>
        </ul>
        <br>
        <br>
        <h1>Our News Site</h1>
        <br>

        <?php
        session_start();
        require "database.php";
        $_SESSION['token'] = substr(md5(rand()), 0, 10);
    
        $story_id = $_GET['id'];
        
        $stmt = $mysqli->prepare("select story_link, story_title, story_body, story_votes, users.username from stories join users on (stories.user_id=users.user_id) where story_id = ?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('i', $story_id); 
        $stmt->execute();
        $stmt->bind_result($story_link, $story_title, $story_body, $story_votes, $story_poster);
        $stmt->fetch();
        $stmt->close();
   
        $get_comments = $mysqli->prepare("select comment_body, comment_id , comment_votes, users.username from comments join users on (comments.user_id=users.user_id) where story_id = ? order by comment_votes desc");
        if(!$get_comments){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $get_comments->bind_param('i', $story_id);
        $get_comments->execute();
        $result = $get_comments->get_result();
        $get_comments->close();
   
        
        echo "<div class=title>";
        echo "Title:  " . $story_title . "</div>";
        echo "<div class=story_info>";
        if($story_link!="N/A"){
            echo "Link:  " . "<a href=$story_link>$story_link</a>" . "<br><br>";
        }else{
            echo "Link:  " . $story_link . "<br><br>"; 
        }
        echo "Posted by:  " . $story_poster . "<br><br>";
        echo "Votes:  " . $story_votes . "<br><br>";
        echo "Body:";
        echo "<br><br>";
        echo $story_body . "<br><br>";
        if(isset($_SESSION['username'])){
            if($_SESSION['username']==$story_poster){
                echo "<form name=delete_story action=deleteStory.php method=post>";
                echo "<input type=submit value='Delete Story' />";
                echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
                echo "<input type=hidden name=story_id value=$story_id />";
                echo "</form>";
                
                echo "<form name=edit_story action=editStory.php method=post>";
                echo "<input type=submit value='Edit Story' />";
                echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
                echo "<input type=hidden name=story_id value=$story_id />";
                echo "</form>";
            }
        }
        echo "<br><br>";
        echo "<form name=upvote action=upvote.php method=post>";
        echo "<input type=submit value='Upvote' />";
        echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
        echo "<input type=hidden name=story_id value=" . $story_id . " />";
        echo "<input type=hidden name=story_votes value=" . $story_votes . " />";
        echo "</form>";
        
        echo "<form name=downvote action=downvote.php method=post>";
        echo "<input type=submit value='Downvote' />";
        echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
        echo "<input type=hidden name=story_id value=" . $story_id . " />";
        echo "<input type=hidden name=story_votes value=" . $story_votes . " />";
        echo "</form>";
        
        echo "</div>" . "<br><br>";
        echo "<h2>" . "Comments:  " . "</h2>";
        echo "<form name=add_comment action=AddComment.php method=post>";
        echo "<input type=submit value='Add Comment' />";
        echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
        echo "<input type=hidden name=id value=$story_id />" . "</form>" . "<br>";
        
        while($row = $result->fetch_assoc()){
        echo "<div class=comment_info>";
        echo "Comment ID:  " . $row['comment_id'] . "   Posted by:  " . $row['username'];
        echo "   Votes:  " . $row['comment_votes'];
        echo "<br><br>" . $row['comment_body'] . "<br>";
        if(isset($_SESSION['username'])){
            if($_SESSION['username']==$row['username']){
                echo "<form name=delete_comment action=deleteComment.php method=post>";
                echo "<input type=submit value='Delete Comment' />";
                echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
                echo "<input type=hidden name=comment_id value=" . $row['comment_id'] . " />";
                echo "</form>";
                
                echo "<form name=edit_comment action=editComment.php method=post>";
                echo "<input type=submit value='Edit Comment' />";
                echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
                echo "<input type=hidden name=comment_id value=" . $row['comment_id'] . " />";
                echo "</form>";
            }
            echo "<form name=upvote_comment action=upvote.php method=post>";
            echo "<input type=submit value='Upvote' />";
            echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
            echo "<input type=hidden name=comment_id value=" . $row['comment_id'] . " />";
            echo "<input type=hidden name=comment_votes value=" . $row['comment_votes'] . " />";
            echo "</form>";
            
            echo "<form name=downvote_comment action=downvote.php method=post>";
            echo "<input type=submit value='Downvote' />";
            echo "<input type=hidden name=token value=" . $_SESSION['token']. " />";
            echo "<input type=hidden name=comment_id value=" . $row['comment_id'] . " />";
            echo "<input type=hidden name=comment_votes value=" . $row['comment_votes'] . " />";
            echo "</form>";
            
            
        }
        }
        echo "</div>";
        ?>
    
    </body>
</html>