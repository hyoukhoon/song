<?php
$query=array(
	"from"=>0,
  "size"=> 10,
  "sort" => array(
					"site_reg_date"=>"desc"),
	"query"=>array(
		"match"=>array(
			"site_name" => "todayhumor"
			)
		)
	);

/*
$query=array(
		"query"=>array(
			"filterd"=>array(
							"filter"=>array(
										"term"=>array("subject"=>"게임")
										),
							"query"=>array(
										"math"=>array("site_name"=>"ppomppu")
							)
						)
					)
);
*/


$json=json_encode($query);


$url="182.162.21.6:9200/ebo/_search?pretty";

  $ch = curl_init(); // 리소스 초기화
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
  ));
 
  $output = curl_exec($ch); // 데이터 요청 후 수신
  $output=json_decode($output);
  curl_close($ch);  // 리소스 해제
  print_r($output);
 
?>