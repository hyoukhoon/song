<?php include "./inc/dbcon.php";

$at=$_POST['at'];
$jat=json_decode($at);

foreach($jat as $ja){
    $gubun=$ja[14]."_".$ja[11];
    $que.="('".$ja[0]."','".$ja[1]."','".$ja[2]."','".$ja[3]."','".$ja[4]."','".$ja[5]."','".$ja[6]."','".$ja[7]."','".$ja[8]."','".$ja[9]."','".$ja[10]."','".$ja[11]."','".$ja[12]."','".$ja[13]."','".$ja[14]."','".$ja[15]."','".$ja[16]."','".$ja[17]."','".$ja[18]."','".$gubun."'),";
}

$que=substr($que,0,-1);

$query="insert into proto (istate, odds1, odds2, odds3, choice1, choice2, choice3, mark_box_rank, block1, block2, block3, islip, home, away, iday, handi1, handi2, handi3, handi,gubun) values ".$que;
$sql = $mysqli->query($query) or die("2:".$mysqli->error);

if($sql){
    echo "ok";
}

?>