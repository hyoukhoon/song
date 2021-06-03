<?php
//echo phpinfo();

$number = 300000;//2a5a058fc295ec000000
$number = $number.'000000000000000000';
//$num16=base_convert(gmp_init($number), 10, 16);
//$num10=base_convert($num16, 16, 10);

$number=gmp_init($number,10);
$num16=gmp_strval($number, 16);

$num10=gmp_init($num16,16);
$num10=gmp_strval($num10, 10);
echo $num16."<br>";
echo $num10;


?>