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
        require "database.php";
        if($_SESSION['token'] !== $_POST['token']){
            die("Request forgery detected");
        }
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            echo "You are logged in as ";
            echo $username;
            echo ".";
        }else{
            echo "You must be logged in to post a new story.  Please log in on the My Account page.";
            exit;
        }
        $storyTitle = $_POST['storyTitle'];
        $storyBody = $_POST['storyBody'];
        $storyLink = $_POST['storyLink'];
        
        if($storyLink == ""){
            $storyLink = "N/A";
        }
        $user_id = $_SESSION['userid'];
        //$sql = "INSERT INTO stories (story_title, story_body) VALUES ('$_POST['storyTitle'], $_POST['storyBody']')";
        $stmt = $mysqli->prepare("insert into stories (user_id, story_title, story_body, story_link) values (?, ?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('isss', $user_id, $storyTitle, $storyBody, $storyLink); 
        $stmt->execute();
        $stmt->close();
        echo "<br>" . "Story Posted successfully!";
        ?>
        </p>    
    </body>
</html>