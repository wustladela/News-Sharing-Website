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
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            echo "You are logged in as ";
            echo $username;
            echo ".";
        }else{
            echo "You will not be able to post a new story without logging in.  Please log in using the My Account page.";
        }
         $_SESSION['token'] = substr(md5(rand()), 0, 10);
        ?>
        </p>
        <h2>New Story?</h2>
        <br>
        <form name="PostNew" action="newstoryMysql.php" method="post">
            Story Title: <br>
            <input type="text" name="storyTitle" value="" required/>
            <br>
            <br>
            Link (Optional): <br>
            <input type="text" name="storyLink" value=""/>
            <br>
            <br>
            Story Body: <br>
            <textarea name="storyBody" rows=10 cols=20 required></textarea>
            <br>
            <br>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
            <input type="submit" name="postNewStory" value="Post Story"/>
        </form>
    </body>
</html>