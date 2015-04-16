<?php

require('connect.php');


if (!isset($_GET['keyword'])) {
    die();
}

$keyword = $_GET['keyword'];
$keyword = $keyword . '%';

$qry = $mysqli->query("SELECT `title` FROM `movies` WHERE `title` LIKE '$keyword' ORDER BY title");

$rows = array();
while($row = $qry->fetch_row()) {
    $rows[] = $row;
}

echo json_encode($rows);

?>