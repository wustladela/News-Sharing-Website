<?php
session_start();
require "database.php";
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$stmt = $mysqli->prepare("SELECT COUNT(*), user_id, password FROM users WHERE username=?");
$user = $_POST['username'];
$stmt->bind_param('s', $user);
$stmt->execute();
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();
 
$pwd_guess = $_POST['password'];

if( $cnt == 1 && crypt($pwd_guess, '$1$awagawag$')==$pwd_hash){

	$_SESSION['username'] = $user;
        $_SESSION['userid'] = $user_id;
        header("location:logged_in.php");
	
}else{
	
         echo "Wrong Username or Password";
        
}

//ob_end_flush();
?>