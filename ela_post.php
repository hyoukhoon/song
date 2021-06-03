<?php
   $postdata = array(
    "tenantId"=> "test",
    "serviceId"=> "every",
    "baseTime"=> time()
  );
  $postdata=json_encode($postdata);

$url="182.162.21.6:9200/everyboard/info?pretty";

  $ch = curl_init(); // 리소스 초기화
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
  ));
 
  $output = curl_exec($ch); // 데이터 요청 후 수신
  $output=json_decode($output);
  curl_close($ch);  // 리소스 해제
echo "<pre>";
  print_r($output);
 
?>