<?php
include "./inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$today=date("Y-m-d");
$today_date=date("Y-m-d H:i:s");

	$result2 = $mysqli->query("select count(1) from taobao where price>0") or die("3:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];

	$que="select * from taobao where price>0";

    $LIMIT=$_GET['LIMIT']??10;
    $page=$_GET['page']??1;
    $start_page=($page-1)*$LIMIT;
    $end_page=$LIMIT;
    $ps=$LIMIT;//한페이지에 몇개를 표시할지
    $sub_size=10;//아래에 나오는 페이징은 몇개를 할지
    $total_page=ceil($total/$ps);//몇페이지
    $f_no=$_GET['f_no']??1;//첫페이지
    if($f_no<1)$f_no=1;
    $l_no=$f_no+$sub_size-1;//마지막페이지
    if($l_no>$total_page)$l_no=$total_page;
    $n_f_no=$f_no+$sub_size;//다음첫페이지
    $p_f_no=$f_no-$sub_size;//이전첫페이지
    $no=$total-($page-1)*$ps;//번호매기기

    $limit_query=" order by num desc limit $start_page, $end_page";
    $last_query=$que.$limit_query;
//	echo $last_query;
    $result = $mysqli->query($last_query) or die("3:".$mysqli->error);
    while($rs = $result->fetch_object()){
	 $rsc[]=$rs;
    }


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="국내 인기 커뮤니티의 각 게시판들을 한곳에 모아두었습니다. 조회수가 많은 인기글들을 확인할 수 있습니다.">
    <meta name="author" content="">
    <meta name="naver-site-verification" content="3560e8c5dcae0af03827b8b75f82faada6fdcf4f"/>

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

		
      <div class="row">

	  <table class="table table-sm">
		  <thead class="thead-light">
			<tr>
			  <th scope="col">대표이미지</th>
			  <th scope="col">상품명</th>
			  <th scope="col">가격</th>
			</tr>
		  </thead>
		  <tbody>
<?php
            foreach($rsc as $p){
				?>
			<tr style="line-height:30px;cursor:pointer;" >
				<td><img src="/thumb/<?echo $p->thumbFile?>" width="50"></td>
				<td><?=$p->subject?>
						<?
						$imgArray=json_decode($p->itemImage);
						foreach($imgArray as $img){
							if(!strpos(".gif",$img)){
								echo "<img src='/itemImage/".$img."' width='30'> , ";
							}
						}
				?>
				</td>
				<td><?=$p->price?></td>
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

      <!-- Pagination -->

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


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
