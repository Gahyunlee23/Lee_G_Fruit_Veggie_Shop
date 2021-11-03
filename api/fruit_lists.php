<?php

//accessToken 발급을 위한 api 통신 시작
$cURLConnection = curl_init();

curl_setopt($cURLConnection, CURLOPT_URL, 'http://fruit.api.postype.net/token');
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($cURLConnection);
//JSON 형태의 데이터로 변환
$jsonRes = JSON_DECODE($response, true);
curl_close($cURLConnection);

$header_data = $jsonRes['accessToken'];


// 과일 목록 조회
$ch = curl_init();
$header[] = 'Authorization:' . $header_data;

curl_setopt($ch, CURLOPT_URL, 'http://fruit.api.postype.net/product');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$res = curl_exec($ch);
$fruit_lists = JSON_DECODE($res, true);
