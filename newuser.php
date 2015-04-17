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

$m1 = $mysqli->real_escape_string($_POST['movie1']);
$r1 = $mysqli->real_escape_string($_POST['movie1rating']);

$m2 = $mysqli->real_escape_string($_POST['movie2']);
$r2 = $mysqli->real_escape_string($_POST['movie2rating']);

$m3 = $mysqli->real_escape_string($_POST['movie3']);
$r3 = $mysqli->real_escape_string($_POST['movie4rating']);

$m4 = $mysqli->real_escape_string($_POST['movie4']);
$r4 = $mysqli->real_escape_string($_POST['movie4rating']);

$m5 = $mysqli->real_escape_string($_POST['movie5']);
$r5 = $mysqli->real_escape_string($_POST['movie5rating']);


$register_attempt = $mysqli->query("SELECT * FROM `users` WHERE email='$email'");

$movie_attempt = $mysqli->query("SELECT `id` FROM `movies` WHERE `title` LIKE '$m1' OR `title` 
    LIKE '$m2' OR `title` LIKE '$m3' OR `title` LIKE '$m4' OR `title` LIKE  '$m5' ");


while($row = $movie_attempt->fetch_row()) {
   $id_array[] = $row[0];
    
}

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

/*    $uidq = $mysqli->query("SELECT `userid` FROM `users` WHERE email='$email'");
    $uid = $uidq->fetch_row()

    $
*/



    $_SESSION['registration_success']=true;
    echo "$m1";
    echo "$r1";
/*    header("location:main.php");*/
/*    exit();*/
} else {
    echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
    exit();
}

?>