<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$_SESSION['ealbumUid']= "";
$uid=removeHackTag($_POST['uid']);
$passwd=removeHackTag($_POST['passwd']);
$passwd=hash('sha512',$passwd);

$que="select * from member where uid='".$uid."' and passwd='".$passwd."'";
$result = $mysqli->query($que) or die($mysqli->error);
$rs = $result->fetch_object();

if(!$rs->uid){
	location_is('','','아이디나 암호가 틀렸습니다. 다시한번 확인해주십시오.');
	exit;
}else{

	$_SESSION['ealbumUid']= $uid;
	location_is('ebo.html','','');
}
?>