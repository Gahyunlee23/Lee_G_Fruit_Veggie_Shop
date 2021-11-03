<?php
// 유저가 선택하고 입력한 값을 variable 처리
$category = $_POST['category'];
$list = $_POST['list'];

if($category === 'fruit') {
    // 과일 가게 토큰을 발급
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, 'http://fruit.api.postype.net/token');
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    $jsonRes = JSON_DECODE($response, true);
    $header_data = $jsonRes['accessToken'];

    if (isset($list) && $list !== '' && $list !== NULL) {
        // 유저의 검색어가 목록에 있는지 확인.
        $header[] = 'Authorization:' . $header_data;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://fruit.api.postype.net/product');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        $fruit_lists = JSON_DECODE($result, true);
        $exist = array_search($list, $fruit_lists);
        curl_close($ch);

        if ($exist !== false) {
            $url = 'http://fruit.api.postype.net/product';
            $param = array(
                'name' => $list
            );
            $fruit_price_url = $url . '?' . http_build_query($param, '');

            $cInit = curl_init();
            curl_setopt($cInit, CURLOPT_URL, $fruit_price_url);
            curl_setopt($cInit, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cInit, CURLOPT_HTTPHEADER, $header);
            $res = curl_exec($cInit);
            $fruit_price_result = JSON_DECODE($res);
            $fruit_price = $fruit_price_result->price;

            //redirect
            header('Location: /index.php?price=' . $fruit_price);
        } else {
            $exist_msg = '찾으시는 과일이 목록에 존재하지 않습니다!';
            echo "<script>alert('$exist_msg');</script>";
            echo "<a href='/index.php'>Back</a>";
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("가격 검색을 위해, 원하는 과일의 이름을 입력해 주세요!");';
        echo 'document.location.href = "/index.php";';
        echo '</script>';
    }
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

    if (isset($list) && $list !== '' && $list !== NULL) {
        // 유저의 검색어가 목록에 있는지 확인.
        $header[] = 'Authorization:' . $header_data;
        $base_url = 'http://vegetable.api.postype.net/item';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $base_url);
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
            $veggie_price_url = $base_url . '?' . http_build_query($param, '');

            $cInit = curl_init();
            curl_setopt($cInit, CURLOPT_URL, $veggie_price_url);
            curl_setopt($cInit, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cInit, CURLOPT_HTTPHEADER, $header);
            $res = curl_exec($cInit);
            $veggie_price_result = JSON_DECODE($res);
            $veggie_price = $veggie_price_result->price;

            //redirect
            header('Location: /index.php?price=' . $veggie_price);
        } else {
            $exist_msg = '찾으시는 채소가 목록에 존재하지 않습니다!';
            echo "<script>alert('$exist_msg');</script>";
            echo "<a href='/index.php'>Back</a>";
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("가격 검색을 위해, 원하는 채소의 이름을 입력해 주세요!");';
        echo 'document.location.href = "/index.php";';
        echo '</script>';
    }

}

