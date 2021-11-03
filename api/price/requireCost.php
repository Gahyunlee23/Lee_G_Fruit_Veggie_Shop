<?php
// 유저가 선택하고 입력한 값을 variable 처리
$category = $_POST['category'];
$list = $_POST['list'];
//base api url
$base_url = '.api.postype.net';
$list_api = 'http://' . $category . $base_url;

//목록 확인과 가격 확인을 위한 토큰 발급 api build
if($category === 'fruit') {
    // 과일 가게 토큰을 발급
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, 'http://fruit.api.postype.net/token');
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    $jsonRes = JSON_DECODE($response, true);
    $header_data = $jsonRes['accessToken'];

    //과일일 경우, 그에 맞는 url 생성
    $list_api_url = $list_api . '/product';
    $msg_category = '과일';

} else {
    //채소가게 토큰 발급
    $url = 'http://vegetable.api.postype.net/token';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    $response = curl_exec($ch);

    $madeUp1 = explode(':', $response);
    $madeUp2 = explode(';', $madeUp1[7]);
    $madeUp3 = explode('=', $madeUp2[0]);
    $header_data = $madeUp3[1];

    //채소일 경우 그에 맞는 url 생성
    $list_api_url = $list_api . '/item';
    $msg_category = '채소';
}

// 유저의 검색어가 우선, 목록에 있는지부터 확인
if (isset($list) && $list !== '' && $list !== NULL) {
    $header[] = 'Authorization:' . $header_data;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $list_api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($ch);
    $fruit_lists = JSON_DECODE($result, true);
    $exist = array_search($list, $fruit_lists);
    curl_close($ch);

    if ($exist !== false) {
        $param = array(
            'name' => $list
        );
        $price_url = $list_api_url . '?' . http_build_query($param, '');

        $cInit = curl_init();
        curl_setopt($cInit, CURLOPT_URL, $price_url);
        curl_setopt($cInit, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cInit, CURLOPT_HTTPHEADER, $header);
        $res = curl_exec($cInit);
        $price_result = JSON_DECODE($res);
        $price = $price_result->price;

        //redirect
        header('Location: /index.php?price=' . $price);
    } else {
        $exist_msg = '찾으시는' . $msg_category . '은(는) 목록에 존재하지 않습니다!';
        echo "<script>alert('$exist_msg');</script>";
        echo "<a href='/index.php'>Back</a>";
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("가격 검색을 위해, 원하는' . $msg_category . '의 이름을 입력해 주세요!");';
    echo 'document.location.href = "/index.php";';
    echo '</script>';
}

