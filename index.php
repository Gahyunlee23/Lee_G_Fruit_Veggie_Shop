<?php
//require_once 'connections.php';
$price = $_GET['price'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fruits-Veggies Shop</title>
</head>
<body>
    <div>가격 조회</div>
    <form action="/api/price/requireCost.php" method="POST">
        <select name="category">
            <option value="fruit">과일</option>
            <option value="vegetable">채소</option>
        </select>
        <input type="text" id="list" name="list">
        <button type="submit">조회</button>
    </form>
    <div> <?php echo $price; ?>
    </div>
</body>
</html>