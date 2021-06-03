<?php include "dbcon.php";

$at=$_POST['at'];
$gameRound=$_POST['gameRound'];
$jat=json_decode($at);


foreach($jat as $ja){
    if($ja[0]){
        $gubun=$ja[2]."_".$ja[0];
		if($ja[17]>0){//핸디가 0보다 큰경우일때 gameTitle 구하기
			$que3="select islip from proto where gameRound='".$gameRound."' and iday='".$ja[2]."' and home='".$ja[4]."' and away='".$ja[5]."' and handi='0'";
			$result3 = $mysqli->query($que3) or die("2:".$mysqli->error);
			$rs3 = $result3->fetch_array();
			$gameTitle=$ja[2]."_".$rs3[0];
		}else{
			$gameTitle=$ja[2]."_".$ja[0];
		}

		

        $que="('G101','".$gameRound."','".$ja[6]."','".$ja[3]."','".$ja[7]."','".$ja[8]."','".$ja[9]."','','','','','".$ja[12]."','".$ja[13]."','".$ja[14]."','".$ja[0]."','".$ja[4]."','".$ja[5]."','".$ja[2]."','".$ja[18]."','".$ja[19]."','".$ja[20]."','".$ja[17]."','".$gubun."','".$gameTitle."','None')";

        $query="insert into proto (gameId, gameRound, istate, gameGubun, odds1, odds2, odds3, choice1, choice2, choice3, mark_box_rank, block1, block2, block3, islip, home, away, iday, handi1, handi2, handi3, handi, gubun,gameTitle,gameResult) values ".$que." ON DUPLICATE KEY UPDATE istate='".$ja[6]."',odds1='".$ja[7]."',odds2='".$ja[8]."',odds3='".$ja[9]."',block1='".$ja[10]."',block2='".$ja[11]."',block3='".$ja[12]."',handi1='".$ja[18]."',handi2='".$ja[19]."',handi3='".$ja[20]."',handi='".$ja[17]."',last_update=now()";
        $sql = $mysqli->query($query) or die("2:".$mysqli->error);
    }
}


if($sql){
    echo "ok";
}

?>