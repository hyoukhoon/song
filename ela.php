<?php
   $postdata = array(
    "tenantId"=> $org->ATTRIBUTE2,
    "serviceId"=> "lgedumadang",
    "baseTime"=> $apiDate
  );

  $postdata=json_encode($postdata);

  $ch = curl_init(); // 리소스 초기화
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'x-apikey: '.$apiKey,
    'Content-Type: application/json'
  ));
 
  $output = curl_exec($ch); // 데이터 요청 후 수신
  $output=json_decode($output);
  curl_close($ch);  // 리소스 해제
 
?>