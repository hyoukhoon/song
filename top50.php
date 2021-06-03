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

if($_COOKIE['saveCookieSite']){
	$site_json=$_COOKIE['saveCookieSite'];
}

if($_GET['site_json']){
	$site_json=$_GET['site_json'];
}


if($_REQUEST['site']){
	$site=$_REQUEST['site'];
}else{
	$site=json_decode(urldecode($site_json));
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


$que3="select * from keywords order by cnt desc limit 50";
$result3 = $mysqli->query($que3) or die("2:".$mysqli->error);
while($rs3 = $result3->fetch_object()){
	$rsc[]=$rs3;
}



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

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="국내 인기 커뮤니티의 각 게시판들을 한곳에 모아두었습니다. 조회수가 많은 인기글들을 확인할 수 있습니다.">
    <meta name="author" content="">
    <meta name="naver-site-verification" content="3560e8c5dcae0af03827b8b75f82faada6fdcf4f"/>

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

		<div style="padding-bottom:10px;padding-top:10px;text-align:center;display:-webkit-inline-box;">
			<?
			$style_type=array("btn-outline-primary","btn-outline-secondary","btn-outline-success","btn-outline-danger","btn-outline-warning","btn-outline-info","btn-outline-dark");
			$t=1;
			foreach($rsc as $p){
				$n=array_rand($style_type);
				$st=$style_type[$n];
				if($t<21 and $p->words!="이유" and $p->words!="사람" and $p->words!="우리" and $p->words!="여자" and $p->words!="남자" and $p->words!="유머" and $p->words!="근황" and $p->words!="관련" and $p->words!="오늘" and $p->words!="이번" and $p->words!="이거" and $p->words!="나라"){
					echo "<button type=\"button\" class=\"btn ".$st."\" onclick=\"search_words('".$p->words."')\"  style=\"margin:3px;\">".$t.".".$p->words."</button>&nbsp;&nbsp;";
					 $t++;
				}
			}
			?>
		</div>
<form method="get" action="<?=$_SERVER['PHP_SELF']?>" name="site_search">
<input type="hidden" name="sword" value="<?=$sword?>">


		<!-- <div style="text-align:center;">
			<a href="https://play.google.com/store/apps/details?id=com.khh.gorchg.propick" target="_blank"><img src="/img/propick.png" style="max-width:340px;"></a>
		</div> -->

		
      <div class="row">
		<div >

			<!-- <input type="checkbox" name="site[]" onclick="sitePr()" value="all" <?if(in_array("all",$site)){?>checked<?}?>>전체&nbsp; -->
			<input type="checkbox" name="site[]" onclick="sitePr()" value="ddanzi" <?if(in_array("ddanzi",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('ddanzi');?>&nbsp;
			<!-- <input type="checkbox" name="site[]" onclick="sitePr()" value="82cook" <?if(in_array("82cook",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('82cook');?>&nbsp; -->
			<input type="checkbox" name="site[]" onclick="sitePr()" value="clien" <?if(in_array("clien",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('clien');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="etoland" <?if(in_array("etoland",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('etoland');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="mpark" <?if(in_array("mpark",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('mpark');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="ppomppu" <?if(in_array("ppomppu",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('ppomppu');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="todayhumor" <?if(in_array("todayhumor",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('todayhumor');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="utdae" <?if(in_array("utdae",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('utdae');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="bobaedream" <?if(in_array("bobaedream",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('bobaedream');?>&nbsp;
			<!-- <input type="checkbox" name="site[]" onclick="sitePr()" value="inven" <?if(in_array("inven",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('inven');?>&nbsp; -->
			<input type="checkbox" name="site[]" onclick="sitePr()" value="theqoo" <?if(in_array("theqoo",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('theqoo');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="slrclub" <?if(in_array("slrclub",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('slrclub');?>&nbsp;
			<input type="checkbox" name="site[]" onclick="sitePr()" value="ruliweb" <?if(in_array("ruliweb",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('ruliweb');?>&nbsp;
			<!-- <input type="checkbox" name="site[]" onclick="sitePr()" value="fmkorea" <?if(in_array("fmkorea",$site) or in_array("all",$site)){?>checked<?}?>><?echo site_name_is('fmkorea');?>&nbsp; -->
			<button type="button" class="btn btn-dark" onclick="saveSetting();">저장</button>
</form>
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
		  <!-- <tr style="line-height:30px;cursor:pointer;" >
			  <th scope="row">1</th>
			  <td><a href="https://www.propick.kr" target="_blank">틀리면 100%환불+10%위로금까지 프로픽만의 환불보상제 실시</a></td>
			  <td><a href="https://www.propick.kr" target="_blank">프로픽</a></td>
			</tr> -->

<?php

if($orderby==1){
	$ord="order by site_reg_date desc";
}else if($orderby==2){
	$ord="order by site_cnt desc";
}else{
	$ord="order by site_reg_date desc";
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

	$que="SELECT * FROM every_board where multi in ('free','sisa','humor','star','review') and site_reg_date >= DATE_ADD(now(), INTERVAL -192 HOUR) and site_reg_date<='$today_date'  $where order by site_cnt desc  limit 50";

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
			  <th scope="row" onclick="move_page('<?=urlencode($url)?>','<?=$rs->num?>')"><?=$rs->site_cnt?></th>
			  <td><?if($rs->site_name=="hnhn" or $rs->site_name=="dorosi" or $rs->site_name=="thezam" or $rs->site_name=="bbongbra"){?>[후방]<?}?><a href="link.php?url=<?=urlencode($url)?>&num=<?=$rs->num?>" target="_blank"><?=$rs->subject?></a> </td>
			  <td onclick="move_page('<?=urlencode($url)?>','<?=$rs->num?>')"><?echo site_name_is($rs->site_name);?><?//echo date("H:i:s", strtotime($rs->site_reg_date));?></td>
			</tr>

<?
$no--;
}?>

  </tbody>
</table>
<script>
function move_page(url,num){
		window.open('link.php?url='+url+'&num='+num, '_blank');
  }
</script>
      </div>
      <!-- /.row -->

      
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
function saveSetting(){

	if(!confirm('브라우저가 바뀌거나 쿠키가 삭제되면 설정은 초기화됩니다.\n 사이트를 저장하시겠습니까?')){
		return;
	}

	var total_cnt=0;
	var checkArray=new Array();
		
		if(!$("input[name='site[]']:checked").val()) {
			alert('최소한 하나의 사이트를 선택하십시오.');
			return;
		}

		$('input:checkbox[name="site[]"]').each(function() {
			if(this.checked){//checked 처리된 항목의 값
				checkArray[total_cnt]=this.value;//배열로 저장
				total_cnt++;
			}
		});

		var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈
		console.log(jsonCheck);
//		return;


		var params = "siteJson="+jsonCheck;
//		console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'siteSave.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
				//alert(data);
				if(data==1){
					alert('저장했습니다.');
				}else{
					alert('다시 시도해주십시오.');
					return;
				}
			  }
		});	
}

</script>