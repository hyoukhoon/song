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

//if($orderby and !$gubun){
//	$gubun="free";
//}

if($sword){
	$query="insert into search_words values ('','$sword','',now())";
	$sql = $mysqli->query($query) or die("1:".$mysqli->error);
}


$que3="select keywords from top100 where reg_date='$today'";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
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
			case "etorrent":$rs="<font color='#008000'>이토</font>";
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
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?if(!$gubun){?>active<?}?>">
              <a class="nav-link" href="/">Home
                <?if(!$gubun){?><span class="sr-only">(current)</span><?}?>
              </a>
            </li>
            <li class="nav-item <?if($gubun=="free"){?>active<?}?>">
              <a class="nav-link" href="/?gubun=free">자유</a>
			  <?if($gubun=="free"){?><span class="sr-only">(current)</span><?}?>
            </li>
			<li class="nav-item <?if($gubun=="sisa"){?>active<?}?>">
              <a class="nav-link" href="/?gubun=sisa">시사</a>
			  <?if($gubun=="sisa"){?><span class="sr-only">(current)</span><?}?>
            </li>
            <li class="nav-item <?if($gubun=="humor"){?>active<?}?>">
              <a class="nav-link" href="/?gubun=humor">유머</a>
			  <?if($gubun=="humor"){?><span class="sr-only">(current)</span><?}?>
            </li>
			<li class="nav-item <?if($gubun=="star"){?>active<?}?>">
              <a class="nav-link" href="/?gubun=star">연예인</a>
			  <?if($gubun=="star"){?><span class="sr-only">(current)</span><?}?>
            </li>
			<li class="nav-item <?if($gubun=="shopping"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=shopping">쇼핑</a>
			  <?if($gubun=="shopping"){?><span class="sr-only">(current)</span><?}?>
            </li>
			<li class="nav-item <?if($gubun=="tour"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=tour">여행</a>
			  <?if($gubun=="tour"){?><span class="sr-only">(current)</span><?}?>
            </li>
			<!-- <li class="nav-item <?if($gubun=="rentcar"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=rentcar">렌트카</a>
			  <?if($gubun=="rentcar"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="bestseller"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=bestseller">베스트셀러</a>
			  <?if($gubun=="bestseller"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>
<script>
	function search_words(words){
				location.href='/?sword='+words
			}
</script>
    <!-- Page Content -->
    <div class="container">
		
		<div style="padding-bottom:10px;padding-top:10px;text-align:center;">
			<?
			$style_type=array("btn-outline-primary","btn-outline-secondary","btn-outline-success","btn-outline-danger","btn-outline-warning","btn-outline-info","btn-outline-dark");
			$t=1;
			foreach($words as $w){
				$n=array_rand($style_type);
				$st=$style_type[$n];
				if(strlen($w[0])>4 and $t<21){
					//echo "<a href='/?sword=".$w[0]."'>".$w[0]."</a>&nbsp;";
					echo "<button type=\"button\" class=\"btn ".$st."\" onclick=\"search_words('".$w[0]."')\"  style=\"margin:3px;\">".$t.".".$w[0]."</button>&nbsp;&nbsp;";
					 $t++;
				}
			}
			?>
		</div>
		<div >
			<p  style="text-align:center;">
				<input type="radio" name="orderby" value="1" <?if($orderby==1){?>checked<?}?> onclick="location.href='/?sword=<?=$sword?>&gubun=<?=$gubun?>&orderby=1&ord=order by site_reg_date desc'">최근순 / 
				<input type="radio" name="orderby" value="2" <?if($orderby==2){?>checked<?}?> onclick="location.href='/?sword=<?=$sword?>&gubun=<?=$gubun?>&orderby=2&ord=order by site_cnt desc'">인기순</p>
			</p>
		</div>
      <div class="row">

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

if(!$ord){
	$ord="order by site_reg_date desc";
}

if($gubun){
	$where=" and multi='$gubun'";
}

if($sword){
	$where.=" and subject like '%".$sword."%'";
}

	$LIMIT=$_GET['LIMIT']?$_GET['LIMIT']:50;
	$page=$_GET['page']?$_GET['page']:1;


	$que2="select count(1) from every_board where multi in ('free','sisa','humor','star') and site_reg_date > DATE_ADD(now(), INTERVAL -24 HOUR) and site_reg_date<='$today_date' $where";
	$que2.=$where1;
//	echo $que2."<br>";
	$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
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

$que="SELECT * FROM every_board where multi in ('free','sisa','humor','star') and site_reg_date > DATE_ADD(now(), INTERVAL -24 HOUR) and site_reg_date<='$today_date'  $where $ord  limit $start_page, $end_page";

//echo $que."<br>";
$result = $mysqli->query($que) or die("3:".$mysqli->error);
while($rs = $result->fetch_object()){

	if(isMobile()){
		if($rs->site_name=="etorrent"){
			$url=str_replace("/bbs/","/plugin/mobile/",$rs->url);
		}else if(isMobile() and $rs->site_name=="ruliweb"){
			$url=str_replace("//bbs.","//m.",$rs->url);
		}else{
			$url=$rs->url;
		}
	}else{
		$url=$rs->url;
	}

//	echo $url."<br>";

?>
			<tr style="line-height:30px;cursor:pointer;" >
			  <th scope="row" onclick="move_page('<?=$url?>')"><?=$rs->site_cnt?></th>
			  <td><a href="<?=$url?>" target="_blank"><?=$rs->subject?></a> </td>
			  <td onclick="move_page('<?=$url?>')"><?echo site_name_is($rs->site_name);?><?//echo date("H:i:s", strtotime($rs->site_reg_date));?></td>
			</tr>

<?
$no--;
}?>

  </tbody>
</table>
<script>
function move_page(url){
		window.open(url, '_blank');
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
						<input type="text" name="sword" value="<?=$sword?>" id="sword" >&nbsp;<button  type="submit" id="search" class="btn btn-primary">Search</button><!-- &nbsp;<button  type="button" id="search2" class="btn btn-danger" onclick="location.href='/mobile/board/'">Reset</button> -->
						</form>
		<br /><br />

		</ul>
		<ul class="pagination justify-content-center">
        <li class="page-item">
			<?if($f_no!=1){?>
          <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&orderby=<?=$orderby?>" aria-label="Previous">
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
						  <a class="page-link" href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&orderby=<?=$orderby?>"><?=$i?></a>
						</li>
					<?}?>
				<?}?>
        
        <li class="page-item">
			<?if($l_no<$total_page){?>
          <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&orderby=<?=$orderby?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
		  <?}?>
        </li>
      </ul>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; everyboardy 2018</p>
		<p class="m-0 text-center text-white"><a href="mailto:partenon@hanmail.net">Contact Us</a></p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
