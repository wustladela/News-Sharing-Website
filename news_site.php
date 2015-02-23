<!DOCTYPE html>
<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("location: logged_in.php");
    }
    $_SESSION['token'] = substr(md5(rand()), 0, 10);
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
        <br>
        <h1>Our News Site</h1>
        <form name="login" action="check_login.php" method="post" >
            Username:  <input type="text" name="username" value="" required />
            Password:  <input type="password" name="password" value="" required />
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
            <input type="submit" name="submitbutton" value="Submit"/>
        </form> 
    </body>
</html>