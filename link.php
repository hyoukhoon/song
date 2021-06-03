<?php
include "./inc/dbcon.php";

//$url=explode("?",$_GET['url']);
$url=$_GET['url'];
if(strpos($url,"etorrent")){
	$url=str_replace("etorrent","etoland",$url);
}
$num=$_GET['num'];
//echo $url.'<br>';
//echo $uid;

$que="insert into count_table (pnum,cnt) values ('".$num."','1') ON DUPLICATE KEY UPDATE cnt=cnt+1";
$sql=$mysqli->query($que) or die("3:".$mysqli->error);
?>
<meta http-equiv="refresh" content="0; url=<?=$url?>"></meta>
