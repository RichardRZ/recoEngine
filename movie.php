<?PHP
require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("logout.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if(true)
   {
        $fgmembersite->RedirectToURL("thankyou-rate-movie.php");
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

    <title>Movie Description</title>

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
            <a class="navbar-brand" href="http://getbootstrap.com/examples/navbar/#">RecMovie</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="main.php">Home</a></li>
              <li><a href="personalpage.php">Personal Profile</a></li>
              <li ><a href="recommendation.php">Recommendation Movies</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Movie Profile:</h2>
		<h3>Title: <?= $moviesite->GetTitleFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
		<h3>Release Date: <?= $moviesite->GetReleaseFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
		<h3>Categories:  <?= $moviesite->GetCatFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
		<h3>Average Review Rate:  <?= $movieratesite->GetAvgRateFromId(htmlspecialchars($_GET["movie_id"])) ?></h3>
      

		<h3>Rate this movie: 
		<input type="submit" name ="one" value ="1 star" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),1,$fgmembersite->GetIdFromEmail()) ?>"/> 
		<input type="submit" name ="two" value ="2 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),2,$fgmembersite->GetIdFromEmail()) ?>"/>
		<input type="submit" name ="three" value ="3 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),3,$fgmembersite->GetIdFromEmail()) ?>"/>
		<input type="submit" name ="four" value ="4 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),4,$fgmembersite->GetIdFromEmail()) ?>"/>
		<input type="submit" name ="five" value ="5 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),5,$fgmembersite->GetIdFromEmail()) ?>"/></h3>
	 </div>
    </div> <!-- /container -->
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

  

</body></html>