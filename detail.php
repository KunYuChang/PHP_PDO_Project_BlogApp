<?php

require_once('./dbc.php');

$dbc = new Dbc();
$result = $dbc->getBlogById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章內容</title>
</head>

<body>
    <h2>詳細內容</h2>
    <h3>標題 : <?= $result['title'] ?></h3>
    <p>投稿日期 : <?= $result['post_at'] ?></p>
    <p>分類 : <?= $dbc->setCategoryName($result['category']) ?></p>
    <hr>
    <p>本文 : <?= $result['content'] ?></p>
</body>

</html>