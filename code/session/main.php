<?php  //Start the Session
//session_save_path('/public_html/project/session');
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
    echo "starting new session";
} else {
    echo "Session active";
}
$_SESSION['signin_failed']=FALSE;
//session_start();
require('connect.php');
// check for form submission
if (isset($_POST['username']) and isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM `users` WHERE userid='$username' and password='$password'";

    $result = mysql_query($query) or die(mysql_error());
    $count = mysql_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1){
        $_SESSION['username'] = $username;
    }else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        $msg = "Invalid Login Credentials.";
    }
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Hai " . $username . "
    ";
    echo "This is the Members Area
    ";
    echo "<a href='logout.php'>Logout</a>";

}else{
//3.2 When the user visits the page first time, simple login form will be displayed.

    require('signin.php');

}
?>