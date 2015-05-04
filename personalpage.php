<?PHP
require_once("./include/config.php");

if(!$usersite->CheckLogin())
{
    $usersite->RedirectToURL("logout.php");
    exit;
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

    <title>Personal Profile Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="http://getbootstrap.com/examples/navbar/navbar.css" rel="stylesheet">
 -->

  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main.php">RecMovie</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="main.php">Home</a></li>
              <li class="active"><a href="personalpage.php">Personal Profile</a></li>
              <li><a href="recommendation.php">Recommendation Movies</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Personal Information:</h2>
		<h3>Email: <?= $personalsite->UserEmail() ?></h3>
		<h3>age: <?= $personalsite->GetAgeFromId($usersite->GetIdFromEmail()) ?></h3>
		<h3>gender: <?= $personalsite->GetGenderFromId($usersite->GetIdFromEmail()) ?></h3>
		<h3>occupation: <?= $personalsite->GetOcpFromId($usersite->GetIdFromEmail()) ?></h3>
		<h3>zip_code: <?= $personalsite->GetZCFromId($usersite->GetIdFromEmail()) ?></h3>
		<h3>rated movies: <?= $movieratesite->GetRatedMoviesFromId($usersite->GetIdFromEmail()) ?></h3>

        <br><br>
          <a class="btn btn-lg btn-primary" href="change-userdata.php" role="button">Change Personal Information »</a>
       
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

  

</body></html>
