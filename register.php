<!DOCTYPE html>
<?php
session_start();
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
        <h1>Our News Site</h1>
        <h2>New User?</h2>
        <form name="register" action="registerMysql.php" method="post">
            Username: <input type="text" name="new_username" value="" required/>
            Password: <input type="password" name="new_password" value="" required/>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
            <input type="submit" name="registerbutton" value="Register"/>
        </form>
        <br>
        <p>
        <?php
        if(isset($_SESSION['new_username'])){
            echo "Your registration is complete, ";
            echo $_SESSION['new_username'];
            echo ". Please log in on the My Account page.";
        }
        unset($_SESSION['new_username']);
        ?>
        </p>
    </body>
</html>