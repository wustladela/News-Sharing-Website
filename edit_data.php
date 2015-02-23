<?php
require "database.php";
$mysqli = new mysqli($host, $username, $password, $db_name);
if($mysqli->connect_errno){
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
$con=mysqli_connect("localhost","wustl_inst","wustl_pass","module3");
$order= "SELECT * FROM stories"; 
$result=mysqli_query($con,$order);
$row = mysqli_fetch_array($result))
echo "so far so good";
//update sql with edited data
$order = "UPDATE stories 
SET story_title='$storyTitle', 
story_body='$storyBody'
WHERE 
story_id='$id'";
mysql_query($order);
?>
<html>
<head>
  <title>Module 3</title>
  <link rel="stylesheet" type="text/css" href="news_site_stylesheet.css" />
  <meta charset="utf-8" />
</head>
<body>
 <ul id="navigation">
  <li><a href="register.php">&#10029; Register</a></li>
  <li><a href="logged_in.php">&#10029; My Account</a></li>
  <li><a href="logout.php">&#10029; Logout</a></li>
  <li><a href="stories.php">&#10029; Stories</a></li>
</ul>
<br>
<h1>Our News Site</h1>

<form method="post" action="edit_data.php">
  <input type="hidden" name="id" value="<? echo "$row[story_id]"?>">
  <tr>        
    <td>Story Title</td>
    <td>
      <input type="text" name="storyTitle"
      value="<? echo "$row[storyTitle]"?>">
    </td>
  </tr>
  <tr>
    <td>Story Body</td>
    <td>
      <input type="text" name="storyBody" 
      value="<? echo "$row[storyBody]"?>">
    </td>
  </tr>
  <tr>
    <td align="right">
      <input type="submit"
      name="submit value" value="Edit">
    </td>
  </tr>
</form>


<br>
<a href="logout.php">Logout</a>
</p>

</body>
</html>
