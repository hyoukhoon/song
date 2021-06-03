<?php

$siteJson=$_POST['siteJson'];

$result=SetCookie("saveCookieSite",$siteJson,time()+86400*365,"/");//선택한 사이트 쿠키로 저장
echo $result;
?>