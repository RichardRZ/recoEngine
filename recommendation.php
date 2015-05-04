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
        <h2>Choose your recommendation options:</h2>
        <div class="dropdown">
        <h3>Recommends by </h3>
    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Genre
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=all">All</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=action">Action</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Adventure">Adventure</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Animation">Animation</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Childrens">Childrens</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Comedy">Comedy</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Crime">Crime</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Documentary">Documentary</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Drama">Drama</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Fantasy">Fantasy</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Filmnoir">Filmnoir</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Horror">Horror</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Musical">Musical</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Mystery">Mystery</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Romance">Romance</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Scifi">Scifi</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Thriller">Thriller</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=War">War</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="recommendationList.php?value=Western">Western</a></li>
    </ul>
  </div>
		

        
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

  

</body></html>
