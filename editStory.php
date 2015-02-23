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
        <?php
        session_start();
        $story_id = $_POST['story_id'];
        //echo "storyid= " . $story_id;
        $_SESSION['token'] = substr(md5(rand()), 0, 10);
        ?>
        <p>
        <form name="edit_story" action="editStoryMysql.php" method="post">
        New Title:  <br><input type="text" name="edit_story_title" value="" /><br>
        New Link:  <br><input type="text" name="edit_story_link" value="" /><br>
        New Body: <br><textarea name="edit_story_body"></textarea>
        <br>
        <input type="submit" value="Submit" />
        <?php echo "<input type=hidden name=token value=" . $_SESSION['token'] . " />"; ?> 
        <?php echo "<input type=hidden name=story_id value= $story_id />"; ?>
        </form>
        </p>
        
    </body>
</html>