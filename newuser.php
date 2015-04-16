<?php
session_start();
require('connect.php');

// Prep email for testing against database

$email = $mysqli->real_escape_string($_POST['email']);
$password = $mysqli->real_escape_string($_POST['password']);
$age = $mysqli->real_escape_string($_POST['age']);
$gender = $mysqli->real_escape_string($_POST['gender']);
$occupation = $mysqli->real_escape_string($_POST['occupation']);
$zip = $mysqli->real_escape_string($_POST['zip']);

$register_attempt = $mysqli->query("SELECT * FROM `users` WHERE email='$email'");

if ($register_attempt->num_rows >= 1){
    $_SESSION['email_fail'] = true;
    $failed=true;
    $_SESSION['registration_failed']=true;
    header("location:main.php");
    exit();
}

$_SESSION['registration_failed']=false;

$insert = "INSERT  INTO `users`  (`email`, `password`, `age`,`gender`,`occupation`,`zip_code`) 
                VALUES ('{$email}', '{$password}', '{$age}', '{$gender}', '{$occupation}','{$zip}')";
if ($mysqli->query($insert)) {
    $_SESSION['registration_success']=true;
    header("location:main.php");
    exit();
} else {
    echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
    exit();
}

?>