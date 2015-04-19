<?PHP
require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("signin.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if(true)
   {
        $fgmembersite->RedirectToURL("rate-movie.html");
   }
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Movie Description</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>

<form id='changepwd' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>


<input type='hidden' name='submitted' id='submitted' value='1'/>

<div id='movie_description_content'>
<h2>Movie Description</h2>
<p>

 <br>
Title: <?= $moviesite->GetTitleFromId(htmlspecialchars($_GET["movie_id"])) ?><br>
Release Date: <?= $moviesite->GetReleaseFromId(htmlspecialchars($_GET["movie_id"])) ?><br>
Categories:  <?= $moviesite->GetCatFromId(htmlspecialchars($_GET["movie_id"])) ?><br>
Average Review Rate:  <?= $movieratesite->GetAvgRateFromId(htmlspecialchars($_GET["movie_id"])) ?><br>
</p>
</div>
<div class='container'>
Rate this movie: 
<input type="submit" name ="one" value ="1 star" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),1,$fgmembersite->GetIdFromEmail()) ?>"/> 
<input type="submit" name ="two" value ="2 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),2,$fgmembersite->GetIdFromEmail()) ?>"/>
<input type="submit" name ="three" value ="3 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),3,$fgmembersite->GetIdFromEmail()) ?>"/>
<input type="submit" name ="four" value ="4 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),4,$fgmembersite->GetIdFromEmail()) ?>"/>
<input type="submit" name ="five" value ="5 stars" onclick="<?= $movieratesite->rateMovie(htmlspecialchars($_GET["movie_id"]),5,$fgmembersite->GetIdFromEmail()) ?>"/>
</div>


</form>



<p>
<a href='main.php'>Home</a>
</p>
</div>
</body>
</html>
