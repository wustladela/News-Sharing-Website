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
        <h1>Our News Site</h1>
        <p>
        <?php
        session_start();
        $_SESSION['story_id'] = $_POST['id'];
        $_SESSION['token'] = substr(md5(rand()), 0, 10);
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            echo "You are logged in as ";
            echo $username;
            echo ".  Story Id =  ";
            echo $_SESSION['story_id'];
        }else{
            echo "You cannot post a new reply without logging in.  Please log in using the My Account page.";
            
        }
        
        ?>
        </p>
        <h2>New reply?</h2>
        <br>
        <form name="PostNew" action="reply.php" method="post">
            <textarea name="reply-content"></textarea>
            <br>
        <input type="submit" value="Submit reply" />
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        </form>
    </body>
</html>