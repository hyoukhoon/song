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
			case "inven":$rs="<font color='#000000'>인벤</font>";
			break;
			case "theqoo":$rs="<font color='#aa8000'>더쿠</font>";
			break;
			case "slrclub":$rs="<font color='#008055'>slrclub</font>";
			break;
			case "ruliweb":$rs="<font color='#bb0055'>루리웹</font>";
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

		#div1{
			display: table;
			width: 100%;
			height: 100%;
		}

		#div2 {
			display: table-cell;
			width: 100%;
			height: 100%;
			text-align: center;
			vertical-align: middle;
		}
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
<div class="container" style="padding-top:20px;">


      <p align="center">
<!-- 프로야구 시작 -->

		<iframe src="/bb/play.php" id="playbb" frameborder=0 style="width:800px;height:700px;"></iframe>

<!-- 프로야구 끝 -->
		</p>

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
<script>
 function re(){
  document.getElementById('playbb').contentWindow.location.reload(); //iframe 페이지를 리로드

 }

 setInterval(re,1000000000); 
</script>