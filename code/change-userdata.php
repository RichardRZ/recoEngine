<?PHP
require_once("./include/config.php");

if($usersite->CheckLogin() && isset($_POST['submitted']))
{
   if($personalsite->ChangeUserData($usersite->GetIdFromEmail()))
   {
        $usersite->RedirectToURL("personalpage.php");
   }
}

?>
<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/navbar/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Personal Profile Setting</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="http://getbootstrap.com/examples/navbar/navbar.css" rel="stylesheet">
 -->

  </head>

  <body>

    <div class="container">

      <?php include 'header.php' ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div id='change-userdatsite'>
<form id='register' action='<?php echo $usersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Personal Information Register</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>





<div class='container'>
    <label for='age' >Age*:</label><br/>
    <input type='text' name='age' id='age' value='<?php echo $usersite->SafeDisplay('age') ?>' maxlength="50" /><br/>
    <span id='register_age_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='gender' >Gender(Type F/M)*: </label><br/>
    <form action="">
      <input type="radio" name="gender" value="M">Male<br>
      <input type="radio" name="gender" value="F">Female
    </form>

    <span id='register_gender_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='occupation' >occupation*: </label><br/>
    <input type='text' name='occupation' id='occupation' value='<?php echo $usersite->SafeDisplay('occupation') ?>' maxlength="50" /><br/>
    <span id='register_occupation_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='zipcode' >zip_code*: </label><br/>
    <input type='text' name='zipcode' id='name' value='<?php echo $usersite->SafeDisplay('zipcode') ?>' maxlength="50" /><br/>
    <span id='register_zipcode_errorloc' class='error'></span>
</div>
<br>
<div class='container'>
    <input type='submit' class="btn btn-lg btn-primary" name='Submit' value='Submit' />
</div>

</fieldset>
</form>
       
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

  

</body></html>