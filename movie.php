<?PHP
require_once("./include/config.php");
if(!$usersite->CheckLogin())
{

    $usersite->RedirectToURL("logout.php");
    exit;
}



if($usersite->CheckLogin() && isset($_POST['Submit']) && isset($_POST['rating']))
{
  $string = str_replace(array("\n", "\r"), '', $_POST['rating']);
  $pieces = explode(",",$string);
  $movieratesite->rateMovie($pieces[1],$pieces[0],$usersite->GetIdFromEmail());
  $usersite->RedirectToURL("thankyou-rate-movie.php"); 

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

<fieldset >
<legend>Movie Profile:</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>





<div class='container'>
    <h3>Title: <?= $moviesite->GetTitleFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
    <h3>Release Date: <?= $moviesite->GetReleaseFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
    <h3>Categories:  <?= $moviesite->GetCatFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
    <h3>Average Review Rate:  <?= $movieratesite->GetAvgRateFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
</div>

<br>
<form id='movie' action='<?php echo $usersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
  <h3>Rate this movie:
    <input type="radio" name ="rating" value ="1,<?= $_GET['movie_id'] ?>" /> 1 star
    <input type="radio" name ="rating" value ="2,<?= $_GET['movie_id'] ?>" /> 2 star
    <input type="radio" name ="rating" value ="3,<?= $_GET['movie_id'] ?>" /> 3 stars
    <input type="radio" name ="rating" value ="4,<?= $_GET['movie_id'] ?>" /> 4 stars
    <input type="radio" name ="rating" value ="5,<?= $_GET['movie_id'] ?>" /> 5 stars
    <input type="submit" class="btn btn-lg btn-primary" name ="Submit" value="Submit" /></h3>
</form>


</fieldset>










       
      </div>







    </div> <!-- /container -->







    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  

</body></html>