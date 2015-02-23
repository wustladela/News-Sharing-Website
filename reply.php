<?php
    session_start();
    require "database.php";
    if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
    }
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $user_id = $_SESSION['userid'];
        $story_id = $_SESSION['story_id'];
        $comment_body = $_POST['reply-content'];
        }else{
            echo "You cannot post a new reply without logging in.  Please log in using the My Account page.";
            exit;
        }
        
        $stmt = $mysqli->prepare("insert into comments (user_id, story_id, comment_body) values (?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }

        $stmt->bind_param('iis', $user_id, $story_id, $comment_body); 
        $stmt->execute();
        $stmt->close();
        header("location: StoryListPage.php");
       
        ?>
        </p>
    </body>
</html>