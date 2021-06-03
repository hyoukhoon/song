<?php
include "./inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$today=date("Y-m-d");
$today_date=date("Y-m-d H:i:s");
$ord=$_GET['ord'];
$orderby=$_GET['orderby']??1;
$sword=removeHackTag($_GET['sword']);
$gubun=$_GET['gubun'];
$site_json=$_GET['site_json'];

if($site_json){
	$site=json_decode(urldecode($site_json));
}else{
	$site=$_REQUEST['site'];
}

$site_json=urlencode(json_encode($site));

//print_r($site);
//echo $site_json;


//if($orderby and !$gubun){
//	$gubun="free";
//}

if($sword){
	$query="insert into search_words values ('','$sword','',now())";
	$sql = $mysqli->query($query) or die("1:".$mysqli->error);
}


$que3="select keywords from top100 where reg_date='$today'";
$result3 = $mysqli->query($que3) or die("2:".$mysqli->error);
$rs3 = $result3->fetch_array();
$words=json_decode(urldecode($rs3[0]));


function isMobile(){
        $arr_browser = array ("iphone", "android", "ipod", "iemobile", "mobile", "lgtelecom", "ppc", "symbianos", "blackberry", "ipad");
        $httpUserAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        // 기본값으로 모바일 브라우저가 아닌것으로 간주함
        $mobile_browser = false;
        // 모바일브라우저에 해당하는 문자열이 있는 경우 $mobile_browser 를 true로 설정
        for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++){
            if(strpos($httpUserAgent, $arr_browser[$indexi]) == true){
                $mobile_browser = true;
                break;
            }
        }
        return $mobile_browser;
}


function site_name_is($n){

		switch($n) {
			
			case "ddanzi":$rs="<font color='#ff0000'>딴지</font>";
			break;
			case "82cook":$rs="<font color='#ff8c00'>빨리쿡</font>";
			break;
			case "clien":$rs="<font color='#558000'>클리앙</font>";
			break;
			case "etoland":$rs="<font color='#008000'>이토</font>";
			break;
			case "mpark":$rs="<font color='#800080'>엠팍</font>";
			break;
			case "ppomppu":$rs="<font color='#4b0082'>뽐뿌</font>";
			break;
			case "todayhumor":$rs="<font color='#0000ff'>오유</font>";
			break;
			case "utdae":$rs="<font color='#ff1100'>웃대</font>";
			break;
			case "bobaedream":$rs="<font color='#ff8c55'>보배</font>";
			break;
			case "inven":$rs="<font color='#000000'>인벤</font>";
			break;
			case "theqoo":$rs="<font color='#aa8000'>더쿠</font>";
			break;
			case "slrclub":$rs="<font color='#008055'>slrclub</font>";
			break;
			case "ruliweb":$rs="<font color='#bb0055'>루리웹</font>";
			break;
			case "fmkorea":$rs="<font color='#bbaa55'>펨코</font>";
			break;
			case "ddengle":$rs="<font color='#113355'>땡글</font>";
			break;
			case "hnhn":$rs="<font color='#bbcc55'>하늘</font>";
			break;
			case "dorosi":$rs="<font color='#ccee77'>도로시</font>";
			break;
			case "thezam":$rs="<font color='#dd11ee'>더잠</font>";
			break;
			case "bbongbra":$rs="<font color='#ee33aa'>뽕브라</font>";
			break;

		}

		return $rs;

	}

//echo "isM:".isMobile();

function cryptoPrice($symbol){
	global $mysqli;
	$que="select price from cryptoCurrency where csymbol='".$symbol."'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_object();
	return $rs->price;
}
 

$source=file_get_contents("https://api.bithumb.com/public/ticker/BTC");
$ss=json_decode($source);
$BTC=$ss->data->closing_price;
$OPENING_BTC=$ss->data->opening_price;
if(($OPENING_BTC-$BTC)<0){$BTC_ICON="<font color='red'>▲</font>";}else{$BTC_ICON="<font color='blue'>▼</font>";}

$source=file_get_contents("https://api.bithumb.com/public/ticker/ETH");
$ss=json_decode($source);
$ETH=$ss->data->closing_price;
$OPENING_ETH=$ss->data->opening_price;
if(($OPENING_ETH-$ETH)<0){$ETH_ICON="<font color='red'>▲</font>";}else{$ETH_ICON="<font color='blue'>▼</font>";}

//$source=file_get_contents("https://api.bithumb.com/public/ticker/DASH");
//$ss=json_decode($source);
//$DASH=$ss->data->closing_price;
/*
$source=file_get_contents("https://api.bithumb.com/public/ticker/LTC");
$ss=json_decode($source);
$LTC=$ss->data->closing_price;
$OPENING_LTC=$ss->data->opening_price;
if(($OPENING_LTC-$LTC)<0){$LTC_ICON="<font color='red'>▲</font>";}else{$LTC_ICON="<font color='blue'>▼</font>";}
*/

$source=file_get_contents("https://api.bithumb.com/public/ticker/XRP");
$ss=json_decode($source);
$XRP=$ss->data->closing_price;
$OPENING_XRP=$ss->data->opening_price;
if(($OPENING_XRP-$XRP)<0){$XRP_ICON="<font color='red'>▲</font>";}else{$XRP_ICON="<font color='blue'>▼</font>";}

/*
$source=file_get_contents("https://api.bithumb.com/public/ticker/ADA");
$ss=json_decode($source);
$ADA=$ss->data->closing_price;
$OPENING_ADA=$ss->data->opening_price;
if(($OPENING_ADA-$ADA)<0){$ADA_ICON="<font color='red'>▲</font>";}else{$ADA_ICON="<font color='blue'>▼</font>";}

$source=file_get_contents("https://api.bithumb.com/public/ticker/XEM");
$ss=json_decode($source);
$XEM=$ss->data->closing_price;
$OPENING_XEM=$ss->data->opening_price;
if(($OPENING_XEM-$XEM)<0){$XEM_ICON="<font color='red'>▲</font>";}else{$XEM_ICON="<font color='blue'>▼</font>";}
*/

$source=file_get_contents("https://api.upbit.com/v1/ticker?markets=KRW-ADA");
$ss=json_decode($source);
$ADA=$ss[0]->trade_price;
$OPENING_ADA=$ss[0]->opening_price;
if(($OPENING_ADA-$ADA)<0){$ADA_ICON="<font color='red'>▲</font>";}else{$ADA_ICON="<font color='blue'>▼</font>";}

$source=file_get_contents("https://api.upbit.com/v1/ticker?markets=KRW-XEM");
$ss=json_decode($source);
$XEM=$ss[0]->trade_price;
$OPENING_XEM=$ss[0]->opening_price;
if(($OPENING_XEM-$XEM)<0){$XEM_ICON="<font color='red'>▲</font>";}else{$XEM_ICON="<font color='blue'>▼</font>";}

//$source=file_get_contents("https://api.bithumb.com/public/ticker/POWR");
//$ss=json_decode($source);
//$POWR=$ss->data->closing_price;

//$source=file_get_contents("https://api.bithumb.com/public/ticker/STEEM");
//$ss=json_decode($source);
//$STEEM=$ss->data->closing_price;

/*
$source=file_get_contents("https://api.bithumb.com/public/ticker/EOS");
$ss=json_decode($source);
$EOS=$ss->data->closing_price;
$OPENING_EOS=$ss->data->opening_price;
if(($OPENING_EOS-$EOS)<0){$EOS_ICON="<font color='red'>▲</font>";}else{$EOS_ICON="<font color='blue'>▼</font>";}


$source=file_get_contents("https://api.bithumb.com/public/ticker/ZEC");
$ss=json_decode($source);
$ZEC=$ss->data->closing_price;
$OPENING_ZEC=$ss->data->opening_price;
if(($OPENING_ZEC-$ZEC)<0){$ZEC_ICON="<font color='red'>▲</font>";}else{$ZEC_ICON="<font color='blue'>▼</font>";}
*/
//$source=file_get_contents("https://api.bithumb.com/public/ticker/XEM");
//$ss=json_decode($source);
//$XEM=$ss->data->closing_price;

//$source=file_get_contents("https://api.bithumb.com/public/ticker/XLM");
//$ss=json_decode($source);
//$XLM=$ss->data->closing_price;

$source=file_get_contents("https://api.upbit.com/v1/ticker?markets=KRW-SNT");
$ss=json_decode($source);
$SNT=$ss[0]->trade_price;
$OPENING_SNT=$ss[0]->opening_price;
if(($OPENING_SNT-$SNT)<0){$SNT_ICON="<font color='red'>▲</font>";}else{$SNT_ICON="<font color='blue'>▼</font>";}

/*
$source=file_get_contents("https://api.upbit.com/v1/ticker?markets=KRW-MER");
$ss=json_decode($source);
$MER=$ss[0]->trade_price;
$OPENING_MER=$ss[0]->opening_price;
if(($OPENING_MER-$MER)<0){$MER_ICON="<font color='red'>▲</font>";}else{$MER_ICON="<font color='blue'>▼</font>";}
*/
$source=file_get_contents("https://api.upbit.com/v1/ticker?markets=KRW-SC");
$ss=json_decode($source);
$SC=$ss[0]->trade_price;
$OPENING_SC=$ss[0]->opening_price;
if(($OPENING_SC-$SC)<0){$SC_ICON="<font color='red'>▲</font>";}else{$SC_ICON="<font color='blue'>▼</font>";}

$source=file_get_contents("https://api.upbit.com/v1/ticker?markets=KRW-ZIL");
$ss=json_decode($source);
$ZIL=$ss[0]->trade_price;
$OPENING_ZIL=$ss[0]->opening_price;
if(($OPENING_ZIL-$ZIL)<0){$ZIL_ICON="<font color='red'>▲</font>";}else{$ZIL_ICON="<font color='blue'>▼</font>";}

/*
$source=file_get_contents("https://api.upbit.com/v1/ticker?markets=KRW-EOS");
$ss=json_decode($source);
$EOS=$ss[0]->trade_price;
$OPENING_EOS=$ss[0]->opening_price;
if(($OPENING_EOS-$EOS)<0){$EOS_ICON="<font color='red'>▲</font>";}else{$EOS_ICON="<font color='blue'>▼</font>";}
*/
/*
$source=file_get_contents("https://api.bithumb.com/public/ticker/ADA");
$ss=json_decode($source);
$ADA=$ss->data->closing_price;
$OPENING_ADA=$ss->data->opening_price;
if(($OPENING_ADA-$ADA)<0){$ADA_ICON="<font color='red'>▲</font>";}else{$ADA_ICON="<font color='blue'>▼</font>";}
*/
//$source=file_get_contents("https://api.bithumb.com/public/ticker/SNT");
//$ss=json_decode($source);
//$SNT=$ss->data->closing_price;

/*
$source=file_get_contents("https://api.bithumb.com/public/ticker/XMR");
$ss=json_decode($source);
$XMR=$ss->data->closing_price;
$OPENING_XMR=$ss->data->opening_price;
if(($OPENING_XMR-$XMR)<0){$XMR_ICON="<font color='red'>▲</font>";}else{$XMR_ICON="<font color='blue'>▼</font>";}
*/
//$source=file_get_contents("https://api.bithumb.com/public/ticker/TRX");
//$ss=json_decode($source);
//$TRX=$ss->data->closing_price;
//$OPENING_TRX=$ss->data->opening_price;
//if(($OPENING_TRX-$TRX)<0){$TRX_ICON="<font color='red'>▲</font>";}else{$TRX_ICON="<font color='blue'>▼</font>";}
/*
$source=file_get_contents("https://api.bithumb.com/public/ticker/INS");
$ss=json_decode($source);
$INS=$ss->data->closing_price;
$OPENING_INS=$ss->data->opening_price;
if(($OPENING_INS-$INS)<0){$INS_ICON="<font color='red'>▲</font>";}else{$INS_ICON="<font color='blue'>▼</font>";}
*/
//▲▼
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>국내 인기 커뮤니티 게시판을 한곳에 - 에브리보디</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/4-col-portfolio.css" rel="stylesheet">
	<style>
		.float1 { float: left; padding: 10px;}
	</style>
	<style type="text/css">
		a:link{color: black;}
		a:visited{color: silver;}
</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117095829-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-117095829-1');
</script>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">everyboardy.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu.php";?>
      </div>
    </nav>
<script>

function sitePr(){
	a=document.site_search;
	a.submit();
}

	function search_words(words){
				a=document.site_search;
				a.sword.value=words
				a.submit();
			}
</script>
    <!-- Page Content -->
    <div class="container">

		<!-- <div style="padding-bottom:10px;padding-top:10px;text-align:center;">
			<?
			$style_type=array("btn-outline-primary","btn-outline-secondary","btn-outline-success","btn-outline-danger","btn-outline-warning","btn-outline-info","btn-outline-dark");
			$t=1;
			foreach($words as $w){
				$n=array_rand($style_type);
				$st=$style_type[$n];
				if(strlen($w[0])>4 and $t<21 and $w[0]!="이유" and $w[0]!="사람" and $w[0]!="우리" and $w[0]!="여자" and $w[0]!="남자" and $w[0]!="유머" and $w[0]!="근황" and $w[0]!="관련" and $w[0]!="오늘" and $w[0]!="이번" and $w[0]!="이거"){
					echo "<button type=\"button\" class=\"btn ".$st."\" onclick=\"search_words('".$w[0]."')\"  style=\"margin:3px;\">".$t.".".$w[0]."</button>&nbsp;&nbsp;";
					 $t++;
				}
			}
			?>
		</div>

		<div >
			<p  style="text-align:center;">
				<input type="radio" name="orderby" value="1" <?if($orderby==1){?>checked<?}?> onclick="sitePr()">최근순 / 
				<input type="radio" name="orderby" value="2" <?if($orderby==2){?>checked<?}?> onclick="sitePr()">인기순</p>
			</p>
		</div> -->
		<table class="table">
		  <thead class="thead-dark">
			<tr style="line-height:20px;text-align:center" >
			  <th scope="col">구분</th>
			  <th scope="col">국내</th>
			  <th scope="col">글로벌</th>
			</tr>
		  </thead>
		  <tbody>

		<tr style="line-height:18px;text-align:center">
			  <th scope="row">비트코인</th>
			  <td style="text-align:right"><?=$BTC_ICON?> <?echo number_format($BTC);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("BTC"));?>원</td>
		</tr>

		<tr  style="line-height:18px;text-align:center">
			  <th scope="row">이더리움</th>
			  <td style="text-align:right"><?=$ETH_ICON?> <?echo number_format($ETH);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("ETH"));?>원</td>
		</tr>

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">대쉬</th>
			  <td style="text-align:right"><?echo number_format($DASH);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("DASH"));?>원</td>
		</tr> -->

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">라이트코인</th>
			  <td style="text-align:right"><?=$LTC_ICON?> <?echo number_format($LTC);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("LTC"));?>원</td>
		</tr> -->

		<tr  style="line-height:18px;text-align:center">
			  <th scope="row">리플</th>
			  <td style="text-align:right"><?=$XRP_ICON?> <?echo number_format($XRP,2);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("XRP"),2);?>원</td>
		</tr>

		<tr  style="line-height:18px;text-align:center">
			  <th scope="row">에이다</th>
			  <td style="text-align:right"><?=$ADA_ICON?> <?echo number_format($ADA,2);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("ADA"),2);?>원</td>
		</tr>

		<tr  style="line-height:18px;text-align:center">
			  <th scope="row">NEM</th>
			  <td style="text-align:right"><?=$XEM_ICON?> <?echo number_format($XEM,2);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("XEM"),2);?>원</td>
		</tr>

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">SNT</th>
			  <td style="text-align:right"><?echo number_format($STEEM);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("STEEM"));?>원</td>
		</tr> -->

		 <tr  style="line-height:18px;text-align:center">
			  <th scope="row">SNT</th>
			  <td style="text-align:right"><?=$SNT_ICON?> <?echo number_format($SNT,2);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("SNT"),2);?>원</td>
		</tr>
		
		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">머큐리</th>
			  <td style="text-align:right"><?=$MER_ICON?> <?echo number_format($MER,2);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("MER"),2);?>원</td>
		</tr> -->

		<tr  style="line-height:18px;text-align:center">
			  <th scope="row">시아코인</th>
			  <td style="text-align:right"><?=$SC_ICON?> <?echo number_format($SC,2);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("SC"),2);?>원</td>
		</tr>
		<tr  style="line-height:18px;text-align:center">
			  <th scope="row">질리카</th>
			  <td style="text-align:right"><?=$ZIL_ICON?> <?echo number_format($ZIL,2);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("ZIL"),2);?>원</td>
		</tr>

		<!-- <tr  style="text-align:center">
			  <th scope="row">지캐쉬</th>
			  <td style="text-align:right"><?=$ZEC_ICON?> <?echo number_format($ZEC);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("ZEC"));?>원</td>
		</tr> -->

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">NEM</th>
			  <td style="text-align:right"><?echo number_format($XEM);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("XEM"));?>원</td>
		</tr> -->

 <!-- <tr  style="text-align:center">
			  <th scope="row">스텔라</th>
			  <td style="text-align:right"><?=$XLM_ICON?> <?echo number_format($XLM);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("XLM"));?>원</td>
		</tr>  -->

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">에이다</th>
			  <td style="text-align:right"><?=$ADA_ICON?> <?echo number_format($ADA);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("ADA"));?>원</td>
		</tr> -->

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">SNT</th>
			  <td style="text-align:right"><?echo number_format($SNT);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("SNT"));?>원</td>
		</tr> -->

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">모네로</th>
			  <td style="text-align:right"><?=$XMR_ICON?> <?echo number_format($XMR);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("XMR"));?>원</td>
		</tr> -->

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">INS</th>
			  <td style="text-align:right"><?=$INS_ICON?> <?echo number_format($INS);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("INS"));?>원</td>
		</tr> -->

		<!-- <tr  style="line-height:18px;text-align:center">
			  <th scope="row">트론</th>
			  <td style="text-align:right"><?=$TRX_ICON?> <?echo number_format($TRX);?>원</td>
			  <td style="text-align:right"><?echo number_format(cryptoPrice("TRX"));?>원</td>
		</tr> -->

  </tbody>
</table>
      <div class="row">
		<div >

		
			<!-- 비트코인 : <span id="bitval"><?echo number_format($BTC);?>(<?echo number_format(cryptoPrice("BTC"));?>)</span> 원 / 이더리움 : <span id="ethval"><?echo number_format($ETH);?>(<?echo number_format(cryptoPrice("ETH"));?>)</span> 원 / 라이트코인 : <span id="ltcval"><?echo number_format($LTC);?>(<?echo number_format(cryptoPrice("LTC"));?>)</span>원 / 리플 : <span id="xrpval"><?echo number_format($XRP);?>(<?echo number_format(cryptoPrice("XRP"));?>)</span>원 / 스팀 : <span id="xrpval"><?echo number_format($STEEM);?>(<?echo number_format(cryptoPrice("STEEM"));?>)</span>원 / 이오스 : <span id="xrpval"><?echo number_format($EOS);?>(<?echo number_format(cryptoPrice("EOS"));?>)</span>원 / 지캐쉬 : <span id="xrpval"><?echo number_format($ZEC);?>(<?echo number_format(cryptoPrice("ZEC"));?>)</span>원 / NEM : <span id="xrpval"><?echo number_format($XEM);?>(<?echo number_format(cryptoPrice("XEM"));?>)</span>원
            
 -->
		</div>
	  <table class="table table-sm">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">조회</th>
			  <th scope="col">제목</th>
			  <th scope="col" style="width:60px;">출처</th>
			</tr>
		  </thead>
		  <tbody>

<?php

if($orderby==1){
	$ord="order by site_reg_date desc";
}else if($orderby==2){
	$ord="order by site_cnt desc";
}else{
	$ord="order by site_reg_date desc";
}

if($gubun){
	$where=" and multi='$gubun'";
}

if($sword){
	$where.=" and subject like '%".$sword."%'";
}

if(count($site)>0){

	if(!in_array("all",$site)){

		$where.=" and site_name in (";

		foreach($site as $s){
			$where.="'".$s."',";
		}

		$where=substr($where,0,-1);
		$where.=")";
	}

}


	$LIMIT=$_GET['LIMIT']?$_GET['LIMIT']:50;
	$page=$_GET['page']?$_GET['page']:1;


		$que2="select count(1) from every_board where multi in ('crypto') and site_reg_date > DATE_ADD(now(), INTERVAL -24 HOUR) and site_reg_date<='$today_date' $where";


//	echo $que2."<br>";
	$result2 = $mysqli->query($que2) or die("3:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];


$start_page=($page-1)*$LIMIT;
$end_page=$LIMIT;
$ps=$LIMIT;//한페이지에 몇개를 표시할지
$sub_size=7;//아래에 나오는 페이징은 몇개를 할지
$total_page=ceil($total/$ps);//몇페이지
$f_no=$_GET['f_no']?$_GET['f_no']:1;//첫페이지
if($f_no<1)$f_no=1;
$l_no=$f_no+$sub_size-1;//마지막페이지
if($l_no>$total_page)$l_no=$total_page;
$n_f_no=$f_no+$sub_size;//다음첫페이지
$p_f_no=$f_no-$sub_size;//이전첫페이지
$no=$total-($page-1)*$ps;//번호매기기

	$que="SELECT * FROM every_board where multi in ('crypto') and site_reg_date > DATE_ADD(now(), INTERVAL -24 HOUR) and site_reg_date<='$today_date'  $where $ord  limit $start_page, $end_page";

//echo $que."<br>";
$result = $mysqli->query($que) or die("4:".$mysqli->error);
while($rs = $result->fetch_object()){

	if(isMobile()){
		if($rs->site_name=="etoland"){
			$url=str_replace("/bbs/","/plugin/mobile/",$rs->url);
		}else if($rs->site_name=="ruliweb"){
			$url=str_replace("//bbs.","//m.",$rs->url);
		}else if($rs->site_name=="utdae"){
			$url=str_replace("web.humoruniv","m.humoruniv",$rs->url);
		}else{
			$url=$rs->url;
		}
	}else{
		$url=$rs->url;
	}

//	echo $url."<br>";

?>
			<tr style="line-height:30px;cursor:pointer;" >
			  <th scope="row" onclick="move_page('<?=urlencode($url)?>','<?=$rs->uid?>')"><?=$rs->site_cnt?></th>
			  <td><?if($rs->site_name=="hnhn" or $rs->site_name=="dorosi" or $rs->site_name=="thezam" or $rs->site_name=="bbongbra"){?>[후방]<?}?><a href="link.php?url=<?=urlencode($url)?>&uid=<?=$rs->uid?>" target="_blank"><?=$rs->subject?></a> </td>
			  <td onclick="move_page('<?=urlencode($url)?>','<?=$rs->uid?>')"><?echo site_name_is($rs->site_name);?><?//echo date("H:i:s", strtotime($rs->site_reg_date));?></td>
			</tr>

<?
$no--;
}?>

  </tbody>
</table>
<script>
function move_page(url,uid){
		window.open('link.php?url='+url+'&uid='+uid, '_blank');
  }
</script>
      </div>
      <!-- /.row -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 에브리보디 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3926380236997271"
     data-ad-slot="9145521929"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      <!-- Pagination -->
      <ul class="pagination justify-content-center">
		
		<form method="get" action="<?=$_SERVER['PHP_SELF']?>" name="sform">
			<input type="hidden" name="gubun" value="<?=$gubun?>">
			<input type="hidden" name="site_json" value="<?=$site_json?>">
						<input type="text" name="sword" value="<?=$sword?>" id="sword" >&nbsp;<button  type="submit" id="search" class="btn btn-primary">Search</button><!-- &nbsp;<button  type="button" id="search2" class="btn btn-danger" onclick="location.href='/mobile/board/'">Reset</button> -->
						</form>
		<br /><br />

		</ul>
		<ul class="pagination justify-content-center">
        <li class="page-item">
			<?if($f_no!=1){?>
          <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&site_json=<?=$site_json?>&m2=<?=$m2?>&orderby=<?=$orderby?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
		  <?}?>
        </li>
		<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page){?>
						<li class="page-item" style="text-decoration: underline;">
						  <a class="page-link" href="javascript:;"><b><?=$i?></b></a>
						</li>
					<?} else {?>
						<li class="page-item">
						  <a class="page-link" href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&site_json=<?=$site_json?>&m2=<?=$m2?>&orderby=<?=$orderby?>"><?=$i?></a>
						</li>
					<?}?>
				<?}?>
        
        <li class="page-item">
			<?if($l_no<$total_page){?>
          <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&site_json=<?=$site_json?>&m2=<?=$m2?>&orderby=<?=$orderby?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
		  <?}?>
        </li>
      </ul>
<div id="clicks" style="text-align:center;"></div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyleft &copy; everyboardy 2018</p>
		<p class="m-0 text-center text-white"><a href="mailto:partenon@hanmail.net">Contact Us</a></p>
		<!-- <p class="m-0 text-center text-white"><a href="#">Donate ethereum : 0x648e36442071d5d599267e3e1e5fa0cfc00b61a7</a></p> -->
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

<script>

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/*
$(function() {

		timer = setInterval( function () {

			$.ajax ({
				"url" : "https://api.bithumb.com/public/ticker/BTC",
				cache : false,
				dataType: 'json',
				success : function (html) { 
					$("#bitval").text(numberWithCommas(html.data.closing_price));
				}
			});

			$.ajax ({
				"url" : "https://api.bithumb.com/public/ticker/ETH",
				cache : false,
				dataType: 'json',
				success : function (html) { 
					$("#ethval").text(numberWithCommas(html.data.closing_price));
				}
			});

			$.ajax ({
				"url" : "https://api.bithumb.com/public/ticker/LTC",
				cache : false,
				dataType: 'json',
				success : function (html) { 
					$("#ltcval").text(numberWithCommas(html.data.closing_price));
				}
			});

			$.ajax ({
				"url" : "https://api.bithumb.com/public/ticker/XRP",
				cache : false,
				dataType: 'json',
				success : function (html) { 
					$("#xrpval").text(numberWithCommas(html.data.closing_price));
				}
			});

	}, 10000); 
});
*/

</script>