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
			<!-- <li class="nav-item <?if($gubun=="gallery"){?>active<?}?>">
              <a class="nav-link" href="/gallery.php?gubun=gallery">갤러리</a>
			  <?if($gubun=="review"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="review"){?>active<?}?>">
              <a class="nav-link" href="/?gubun=review">리뷰</a>
			  <?if($gubun=="review"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="top50"){?>active<?}?>">
              <a class="nav-link" href="/top50.php?gubun=top50">주간TOP50</a>
			  <?if($gubun=="top50"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="crypto"){?>active<?}?>">
              <a class="nav-link" href="/crypto.php?gubun=crypto">가상화폐</a>
			  <?if($gubun=="crypto"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="conven"){?>active<?}?>">
              <a class="nav-link" href="/conven.php?gubun=conven">편의점</a>
			  <?if($gubun=="conven"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="black"){?>active<?}?>">
              <a class="nav-link" href="/black.php?gubun=black">검사인벤</a>
			  <?if($gubun=="black"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			
			<!-- <li class="nav-item <?if($gubun=="info"){?>active<?}?>">
              <a class="nav-link" href="/?gubun=info">정보</a>
			  <?if($gubun=="info"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="shop"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=shop">쇼핑</a>
			  <?if($gubun=="shop"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="probb"){?>active<?}?>">
              <a class="nav-link" href="/bb.php?gubun=probb">프로야구</a>
			  <?if($gubun=="probb"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			
			<!-- <li class="nav-item <?if($gubun=="tour"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=tour">여행</a>
			  <?if($gubun=="tour"){?><span class="sr-only">(current)</span><?}?>
            </li>
			<li class="nav-item <?if($gubun=="rentcar"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=rentcar">렌트카</a>
			  <?if($gubun=="rentcar"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
			<!-- <li class="nav-item <?if($gubun=="bestseller"){?>active<?}?>">
              <a class="nav-link" href="/shopping.php?gubun=bestseller">베스트셀러</a>
			  <?if($gubun=="bestseller"){?><span class="sr-only">(current)</span><?}?>
            </li> -->
          </ul>
        </div>