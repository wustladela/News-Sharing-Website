<!DOCTYPE html>
<?php
session_start();
require "database.php";
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
if( !preg_match('/^[\w_\-]+$/', $_POST['new_username'])){
            echo "Invalid username";
            exit;
}
$new_user = $_POST['new_username'];
$new_pass = $_POST['new_password'];
$crypt_pass = crypt ($new_pass, '$1$awagawag$');


$check = $mysqli->prepare("SELECT COUNT(*), user_id FROM users WHERE username=?");
$check->bind_param('s', $new_user);
$check->execute();
$check->bind_result($cnt, $user_id);
$check->fetch();
$check->close();

if( $cnt == 0){
$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ss', $new_user, $crypt_pass); 
$stmt->execute();
$stmt->close();

$_SESSION['new_username'] = $_POST['new_username'];
session_destroy();
header("location: register.php");
}else{
    echo "This username already exists.";
}
?>
