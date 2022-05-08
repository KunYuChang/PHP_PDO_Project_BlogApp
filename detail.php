<?php

$id = $_GET['id'];

if (empty($id)) {
    exit('發生錯誤!');
}

function dbConnect()
{
    $dsn = 'mysql:host=localhost;dbname=blog_app;charset=utf8';
    $user = 'blog_user';
    $pass = 'test123456';

    try {
        $dbh = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
        return $dbh;
    } catch (PDOException $e) {
        echo '資料庫連線失敗' . $e->getMessage();
        exit();
    }
}


$dbh = dbConnect();


// 1. SQL準備
$stmt = $dbh->prepare('SELECT * FROM blog WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

// 2. SQL執行
$stmt->execute();

// 3. SQL結果取出
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    exit('無此文章!');
}
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
    <p>分類 : <?= $result['category'] ?></p>
    <hr>
    <p>本文 : <?= $result['content'] ?></p>
</body>

</html>