<?php
include "./inc/dbcon.php";

$today=date("Y-m-d");
$today_date=date("Y-m-d H:i:s");
$ord=$_GET['ord'];
$orderby=$_GET['orderby']??1;
$sword=$_GET['sword'];
$gubun=$_GET['gubun'];

if($sword){
	$query="insert into search_words values ('','$sword','',now())";
	$sql = $mysqli->query($query) or die("1:".$mysqli->error);
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
			
			case "11st":$rs="<font color='#ff0000'>11번가</font>";
			break;
			case "gmarket":$rs="<font color='#ff8c00'>지마켓</font>";
			break;
			case "auction":$rs="<font color='#558000'>옥션</font>";
			break;
			case "coupang":$rs="<font color='#008000'>쿠팡</font>";
			break;
			case "wmp":$rs="<font color='#800080'>위메프</font>";
			break;
			case "tmon":$rs="<font color='#0000ff'>티몬</font>";
			break;
			case "yes24":$rs="<font color='#ff1100'>예스24</font>";
			break;
			case "aladin":$rs="<font color='#ff8c55'>알라딘</font>";
			break;
			case "kshop":$rs="<font color='#000000'>K쇼핑</font>";
			break;
			case "gearbest":$rs="<font color='#aa8000'>gearbest</font>";
			break;
			case "cjmall":$rs="<font color='#008055'>cjmall</font>";
			break;
			case "emart":$rs="<font color='#bb0055'>이마트</font>";
			break;

		}

		return $rs;

	}

//echo "isM:".isMobile();

function json_link($data){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.linkprice.com/ci/service/custom_link_xml");
	curl_setopt($ch, CURLOPT_GET, false);
	curl_setopt($ch, CURLOPT_GETFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$rs=curl_exec($ch);
	$ce=curl_errno($ch);
	$cr=curl_error($ch);
	return $rs;
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>국내 인기 커뮤니티 게시판을 한곳에</title>

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

    <!-- Page Content -->
    <div class="container">

      <div class="row">


	  <table class="table table-sm">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">상품명</th>
			  <th scope="col" style="width:60px;">몰</th>
			</tr>
		  </thead>
		  <tbody>

<?php

if(!$ord){
	$ord="order by site_cnt asc, reg_date desc";
}

if($gubun){
	$where=" and multi='$gubun'";
}

if($sword){
	$where.=" and subject like '%".$sword."%'";
}

	$LIMIT=$_GET['LIMIT']?$_GET['LIMIT']:50;
	$page=$_GET['page']?$_GET['page']:1;

	$que2="select count(1) from every_board where multi='shop' and reg_date > CURRENT_DATE( ) $where";

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

$que="SELECT * FROM every_board where multi='shop' and reg_date > CURRENT_DATE( )  $where $ord  limit $start_page, $end_page";


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


//	$url="http://item.gmarket.co.kr/Item?goodscode=545258959";

/*
if($rs->site_name!="coupang"){
	$url=urlencode($url);
	$data="https://api.linkprice.com/ci/service/custom_link_xml?a_id=A100610984&mode=json&url=".$url;
	$ds=file_get_contents($data);
	//echo $ds."<br>";
	$ds1=json_decode($ds);
	//print_r($ds1);
	$url=$ds1->url;
	
}
*/


//	echo $url."<br>";

?>
			<tr style="line-height:30px;cursor:pointer;">
			  <th scope="row"><?echo $rs->site_cnt;?></th>
			  <td><a href="<?=$url?>" target="_blank"><img src="<?=$rs->imgurl?>" width="50"><?=$rs->subject?> (<?echo $rs->price;?><?if($rs->site_name=="gearbest"){?>$<?}else if($rs->site_name=="11st"){?> <?}else{?>원<?}?>) <?if($rs->etc1){echo " - ".$rs->etc1;}?></a> </td>
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
						<input type="text" name="sword" value="<?=$sword?>" id="sword" >&nbsp;<button  type="submit" id="search" class="btn btn-primary">Search</button><!-- &nbsp;<button  type="button" id="search2" class="btn btn-danger" onclick="location.href='/mobile/board/'">Reset</button> -->
						</form>
		<br /><br />

		</ul>
		<ul class="pagination justify-content-center">
        <li class="page-item">
			<?if($f_no!=1){?>
          <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&orderby=<?=$orderby?>" aria-label="Previous">
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
						  <a class="page-link" href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&orderby=<?=$orderby?>"><?=$i?></a>
						</li>
					<?}?>
				<?}?>
        
        <li class="page-item">
			<?if($l_no<$total_page){?>
          <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&orderby=<?=$orderby?>" aria-label="Next">
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
