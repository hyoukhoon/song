<?php
include "./inc/dbcon.php";

$url=$_GET['url'];
$num=$_GET['num'];

$que="insert into count_table (pnum,cnt) values ('".$num."','1') ON DUPLICATE KEY UPDATE cnt=cnt+1";
$sql=$mysqli->query($que) or die("3:".$mysqli->error);

echo "ok";
?>
