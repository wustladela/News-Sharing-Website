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
        <h2>Stories:</h2><br>
        <?php
        require "database.php";
        
        $stmt = $mysqli->prepare("select story_title, story_votes, story_id, users.username from stories join users on (stories.user_id=users.user_id) order by story_votes desc");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        } 
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        while($row = $result->fetch_assoc()){
            echo "<div class=comment_info>";
            ?> <a href="individualStoryPage.php?id=<?php echo $row['story_id'];?>" > <?php echo $row['story_title'];?></a><br>
            <?php
            echo "Posted by:  " . $row['username'] . "<br>";
            echo "Votes:  " . $row['story_votes'];
            echo "</div><br>";
            
        }
       ?>
    </body>
</html>