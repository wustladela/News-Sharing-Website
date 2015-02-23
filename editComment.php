<!DOCTYPE html>
<?php
session_start();
$comment_id = $_POST['comment_id'];
//echo "comment_id= " . $comment_id;
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
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
        <p>
        <form name="edit_comment" action="editCommentMysql.php" method="post">
        New Comment: <br><textarea name="edit_comment_body"></textarea>
        <br>
        <input type="submit" value="Submit" />
        <?php echo "<input type=hidden name=token value=" . $_SESSION['token'] . " />"; ?>
        <?php echo "<input type=hidden name=comment_id value=" . $comment_id .  " />"; ?>
        </form>
        </p>
        
    </body>
</html>