<?php
include "./inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$today=date("Y-m-d");
$today_date=date("Y-m-d H:i:s");
$ord=$_GET['ord'];
$orderby=$_GET['orderby']??1;
$sword=$_GET['sword'];
$gubun=$_GET['gubun'];

$que3="select keywords from top100 where reg_date='$today'";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();
$words=json_decode(urldecode($rs3[0]));
echo "<pre>";
//print_r($words);

foreach($words as $w){
	if(strlen($w[0])>4){
		 print_r($w)."<br>";
	}
}

?>