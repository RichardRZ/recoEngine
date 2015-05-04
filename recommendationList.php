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

    <title>Recommendation Movies Page</title>

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
              <li><a href="personalpage.php">Personal Profile</a></li>
              <li class="active"><a href="recommendation.php">Recommendation Movies</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Recommendation Movies:</h2>
		<h3><?= $usersite->UserEmail()?>, Here is a movie list for you:</h3>
		<p>
			<h3><?php 
      if ($_GET['value']=='all'){
        $command = escapeshellcmd('python recommendation_item_base.py -userId '.$usersite->GetIdFromEmail());
      }
      else{
        $command = escapeshellcmd('python recommendation_item_base.py -userId '.$usersite->GetIdFromEmail().' -genre '.$_GET['value']);
      }
      
      //$command = escapeshellcmd('python recommendation_item_base.py -userId 100 -genre Scifi');
      $output = shell_exec($command);
      $output = str_replace(array("\n", "\r"), '', $output);
      $ids = explode(",",$output);
      foreach ($ids as $value){
        $recommendationsite->GetMovieLinkeByMoiveId($value);
      }
      ?></h3>
		</p>

        
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

  

</body></html>
