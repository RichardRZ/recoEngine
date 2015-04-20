<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Jeremy Watson</title>
  <script script type="text/javascript"  
  src="/jquery/jquery.js"></script> <!-- -1.11.2.min.js -->

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>
<body>

<form action="execute.php" method="post">
Name: <input type="text" name="name"><br>
Number to square: <input type="text" name="numSquare"><br>
<input type="submit">
</form>



<?php 
// this is how you call a shell command from php

$command = escapeshellcmd('python pytest.py');
$output = shell_exec($command);
echo $output;

?>




</body>
</html>