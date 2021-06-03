<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

	$uid=removeHackTag($_POST['uid']);
//	$uname=removeHackTag($_POST['uname']);
//	$birth=removeHackTag($_POST['birth']);
//	$nickname=removeHackTag($_POST['nickname']);
//	$mobile=removeHackTag($_POST['mobile']);
	$passwd=removeHackTag($_POST['passwd']);
//	$referee=removeHackTag($_POST['referee']);
//	$memberGubun=removeHackTag($_POST['memberGubun']);
//	$isPush=removeHackTag($_POST['isPush']);
//	$cookieSaveToken=$_COOKIE['cookieSaveToken'];
	$memberGubun="U";

/*
	if(!$uname){
		$data=array("result"=>-3,"val"=>"본인인증을 확인하셔야 가입하실 수 있습니다.");
		echo json_encode($data);
		exit;
	}

	if(!$birth){
		$data=array("result"=>-3,"val"=>"본인인증을 확인하셔야 가입하실 수 있습니다.");
		echo json_encode($data);
		exit;
	}

	if((date("Y")-substr($birth,0,4))<19){
		$data=array("result"=>-3,"val"=>"만 19세 미만 청소년은 가입할 수 없습니다.");
		exit;
	}

	if(!$uid or !$mobile or !$passwd or !$memberGubun or !$nickname){
		$data=array("result"=>-1,"val"=>"no Value");
		echo json_encode($data);
		exit;
	}
*/

	if(!$uid or !$passwd){
		$data=array("result"=>-1,"val"=>"no Value");
		echo json_encode($data);
		exit;
	}

//	$mobile=hash('sha512',$mobile);
	$passwd=hash('sha512',$passwd);
	$isAuth=1;//픽스터 픽등록 제한
	$isUse=1;

	if($memberGubun=="P"){
		$cashDb="pixterCashList";
		$tokenDb="pixterTokenList";
		$cashIncome=10000;
		$isRefund=0;
	}else if($memberGubun=="U"){
		$cashDb="punterCashList";
		$tokenDb="punterTokenList";
		$cashIncome=5000;
		$isRefund=0;
	}

/*
	if($_POST['mobile']){//휴대폰 사용여부 체크

		$que3="SELECT count(*) FROM member WHERE mobile = '".$mobile."'";
		$result3 = $mysqli->query($que3) or die("2:".$mysqli->error);
		$rs3 = $result3->fetch_array();

		if($rs3[0]){
			$data=array("result"=>-2,"val"=>"no Value");
			echo json_encode($data);
			exit;
		}

	}
*/
/*
	$que5="SELECT Token FROM users WHERE myPhone = '".$mobile."'";
	$result5 = $mysqli->query($que5) or die("2:".$mysqli->error);
	$rs5 = $result5->fetch_array();
	$cookieSaveToken=$rs5[0];
*/

	$mysqli->autocommit(FALSE);

	$query="INSERT INTO `propick`.`member`
				(
				`uid`,
				`uname`,
				`birth`,
				`mobile`,
				`passwd`,
				`nickName`,
				`isPush`,
				`memberGubun`,
				`regDate`,
				`lastLogin`,
				`isAuth`,
				`isUse`,
				`referee`,
				`token`,
				`passUpDate`)
				VALUES
				('$uid',
				'$uname',
				'$birth',
				'$mobile',
				'$passwd',
				'$nickname',
				'$isPush',
				'$memberGubun',
				now(),
				'$lastLogin',
				'$isAuth',
				'$isUse',
				'$referee',
				'$cookieSaveToken',
				now())
				";

	$sql1=$mysqli->query($query) or die("3:".$mysqli->error);

	$gubun=12;//회원가입

	$que2="INSERT INTO $cashDb 
	(`uid`,
	`income`,
	`nowCash`,
	`gubun`,
	`isRefund`)
	VALUES 
	('".$uid."',
	'$cashIncome',
	'$cashIncome',
	'$gubun',
	'0')
	";
	$sql2=$mysqli->query($que2) or die("75:".$mysqli->error);

	$que2="INSERT INTO $cashDb 
	(`uid`,
	`income`,
	`nowCash`,
	`gubun`,
	`isRefund`)
	VALUES 
	('".$uid."',
	'0',
	'0',
	'0',
	'1')
	";
	$sql2=$mysqli->query($que2) or die("75:".$mysqli->error);


	$gubun=8;//회원가입
	$income=1000;
	$que3="INSERT INTO $tokenDb 
	(`uid`,
	`income`,
	`nowCash`,
	`gubun`,
	`isRefund`)
	VALUES 
	('".$uid."',
	'$income',
	'$income',
	'$gubun',
	'0')
	";

	$sql3=$mysqli->query($que3) or die("94:".$mysqli->error);


	if($sql1 && $sql2 && $sql3){

		//추천인 이벤트
/*
		$eventIncome="5000";
		$gubun="13";
		$isRefund=0;

		$que3="SELECT num,memberGubun FROM member WHERE isUse=1 and uid = '".$referee."'";//추천인이 존재하는지 확인
		$result3 = $mysqli->query($que3) or die("2:".$mysqli->error);
		$rs3 = $result3->fetch_array();

		if($rs3[0]){

			$query2="insert into ".$cashDb." (uid, income, nowCash, gubun,isRefund) select uid, ".$eventIncome.", nowCash+".$eventIncome.", ".$gubun.", ".$isRefund." from ".$cashDb." where isRefund='".$isRefund."' and uid='".$uid."' order by num desc limit 1";
			$sql2=$mysqli->query($query2) or die("4:".$mysqli->error);

			if($rs3[1]=="P"){
				$rfDb="pixterCashList";
			}else if($rs3[1]=="U"){
				$rfDb="punterCashList";
			}

			$query3="insert into ".$rfDb." (uid, income, nowCash, gubun,isRefund) select uid, ".$eventIncome.", nowCash+".$eventIncome.", ".$gubun.", ".$isRefund." from ".$rfDb." where isRefund=".$isRefund." and uid='".$referee."' order by num desc limit 1";
			$sql3=$mysqli->query($query3) or die("4:".$mysqli->error);

		}
*/
		$mysqli->commit();


		$data=array("result"=>1,"val"=>"성공"); 

	}else{
		$data=array("result"=>0,"val"=>"실패"); 
	}

	echo json_encode($data);
?>