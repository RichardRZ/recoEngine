<?php  //Start the Session
session_start(); 
//session_start();
require('connect.php');
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
    $email = $_SESSION['email'];
    echo "Hai " . $email . "
    ";
    echo "This is the Members Area
    ";
    echo "<a href='logout.php'>Logout</a>";

}else{
// When the user visits the page first time, simple login form will be displayed.

    require('signin.php');

}
?>