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

<?php 
echo $_POST["name"];
$command = escapeshellcmd("python pytest.py " . $_POST["name"] . " " . (string) $_POST["numSquare"]);
$output = shell_exec($command);
echo $output;

?>

</body>
</html>