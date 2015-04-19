<?php  //Start the Session
session_start(); 

require('connect.php');
require_once("./include/membersite_config.php");
// check for form submission
if (isset($_POST['email']) and isset($_POST['password'])){
    $_SESSION['registration_failed']=false;

    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);

    $signin_result = $mysqli->query("SELECT * FROM `users` WHERE email='$email' and password='$password'");

//If the posted values are equal to the database values, then session will be created for the user.
    if ($signin_result->num_rows == 1){
        $_SESSION['email'] = $email;
    }else{
// If the login credentials doesn't match, he will be shown with an error message.
        $msg = "Invalid Login Credentials.";
    }
}
// if the user is logged in Greets the user with message

if (isset($_SESSION['email'])) {


// Qiming, if you require('') the logged in site page here it will redirect there on successful login


    

}else{
// When the user visits the page first time, simple login form will be displayed.

    require('signin.php');

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Home page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<h2>Home Page</h2>
Welcome back <?= $fgmembersite->UserEmail(); ?>!

<p><a href='personalpage.php'>Personal Page</a></p>
<p><a href='recommendation.php'>Get your recommendation movies!</a></p>
<br><br><br>
<p><a href='signin.php'>Logout</a></p>
</div>
</body>
</html>