<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file=date("Ymd").".json";
$data=fopen("/var/www/html/json/".$file, "r") or die("파일을 열 수 없습니다！");
$data=fgets($data);
$dataArray=json_decode($data);

$dr=$dataArray->liveInfo;
echo "<pre>";

print_r($dr[0]->compSchedules);
//exit;

foreach($dr[0]->compSchedules->datas as $ps){
	print_r($ps);
}


//print_r($dataArray);

?>

`gameId`,
`gameRound`,
`istate`,
`gameGubun`,
`odds1`,
`odds2`,
`odds3`,
`choice1`,
`choice2`,
`choice3`,
`mark_box_rank`,
`block1`,
`block2`,
`block3`,
`islip`,
`home`,
`away`,
`iday`,
`handi1`,
`handi2`,
`handi3`,
`handi`,
`gubun`,
`gameTitle`,
`reg_date`,now()
`last_update`,now()
`homeScore`,
`awayScore`,
`gameResult`,
`comment_cnt`,
`naverGameId`,
`homePoll`,
`awayPoll`,
`comment`)
gameResult
승 1
무 0
패 -1
오버 8
언더 7
취소 2