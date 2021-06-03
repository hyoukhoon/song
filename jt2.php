<?php include "./inc/dbcon.php";

$at=$_POST['at'];
$jat=json_decode($at);

foreach($jat as $ja){
    if($ja[14]){
        $gubun=$ja[14]."_".$ja[11];
        $que="('G101','180053','".$ja[0]."','".$ja[1]."','".$ja[2]."','".$ja[3]."','".$ja[4]."','".$ja[5]."','".$ja[6]."','".$ja[7]."','".$ja[8]."','".$ja[9]."','".$ja[10]."','".$ja[11]."','".$ja[12]."','".$ja[13]."','".$ja[14]."','".$ja[15]."','".$ja[16]."','".$ja[17]."','".$ja[18]."','".$gubun."')";

        $query="insert into proto (gameId, gameRound, istate, odds1, odds2, odds3, choice1, choice2, choice3, mark_box_rank, block1, block2, block3, islip, home, away, iday, handi1, handi2, handi3, handi, gubun) values ".$que." ON DUPLICATE KEY UPDATE istate='".$ja[0]."',odds1='".$ja[1]."',odds2='".$ja[2]."',odds3='".$ja[3]."',choice1='".$ja[4]."',choice2='".$ja[5]."',choice3='".$ja[6]."',mark_box_rank='".$ja[7]."',block1='".$ja[8]."',block2='".$ja[9]."',block3='".$ja[10]."',handi1='".$ja[15]."',handi2='".$ja[16]."',handi3='".$ja[17]."',handi='".$ja[18]."',last_update=now()";
        $sql = $mysqli->query($query) or die("2:".$mysqli->error);
    }
}


if($sql){
    echo "ok";
}

?>