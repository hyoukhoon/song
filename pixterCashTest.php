<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$query2="delete from pixterCashList where uid='pixter'";
//					$sql2=$mysqli->query($query2) or die("4:".$mysqli->error);

//exit;

for($i=0;$i<=10000;$i++){

					$gubun=1;//픽수입
					$resultFee=0;
					$spending=0;
					$resultFee=substr(rand(),0,5);
					//$spending=substr(rand(),0,5);
					$query2="INSERT INTO `pixterCashList`
					(`uid`,
					`income`,
					`spending`,
					`gubun`,
					`regDate`)
					VALUES
					('pixter',
					'$resultFee',
					'$spending',
					'$gubun',
					now())";
					$sql2=$mysqli->query($query2) or die("4:".$mysqli->error);
}

exit;


for($i=0;$i<=500000;$i++){

					$gubun=1;//픽수입
					$resultFee=0;
					$spending=0;
					$resultFee=substr(rand(),0,5);
					//$spending=substr(rand(),0,5);
					$query.="('pixter','$resultFee','$spending','$gubun',now()),";
					
}

$query=substr($query,0,-1);
$query2="INSERT INTO `pixterCashList` (`uid`,
					`income`,
					`spending`,
					`gubun`,
					`regDate`)
					VALUES ".$query;
$sql2=$mysqli->query($query2) or die("4:".$mysqli->error);


?>