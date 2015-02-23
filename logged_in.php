<!DOCTYPE html>
<?php
    session_start();
    $current_username = $_SESSION['username'];
    if(!isset($_SESSION['username'])){
        header("location: news_site.php");
    }
?>
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
        You are logged in as <?php echo $current_username;?>.
        <br>
        <a href="logout.php">Logout</a>
        </p>
        
    </body>
</html>