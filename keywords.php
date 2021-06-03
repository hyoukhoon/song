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

			$query = "delete from keywords";
			$sql = $mysqli->query($query) or die($mysqli->error);

$que3="select keywords from top100 order by num desc limit 7";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
while($rs3 = $result3->fetch_array()){

	$words=json_decode(urldecode($rs3[0]));

	foreach($words as $w){

		if(strlen($w[0])>4){

			$query = "INSERT INTO `python`.`keywords`
							(`words`,
							`cnt`)
							VALUES
							('".$w[0]."',
							'".$w[1]."') ON DUPLICATE KEY UPDATE cnt=cnt +".$w[1]."";
			$sql = $mysqli->query($query) or die($mysqli->error);

		}
	}

}
?>