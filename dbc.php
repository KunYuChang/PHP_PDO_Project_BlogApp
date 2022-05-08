<?php

function dbConnect()
{
    $dsn = 'mysql:host=localhost;dbname=blog_app;charset=utf8';
    $user = 'blog_user';
    $pass = 'test123456';

    try {
        $dbh = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $dbh;
    } catch (PDOException $e) {
        echo '資料庫連線失敗' . $e->getMessage();
        exit();
    }
}

function getAllBlog()
{
    $dbh = dbConnect();
    // 1. SQL準備
    $sql = 'SELECT * FROM blog';
    // 2. SQL執行
    $stmt = $dbh->query($sql);
    // 3. SQL結果取出
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $result;
}

$blogData = getAllBlog();

function setCategoryName($category)
{
    if ($category === '1') return '技術';
    if ($category === '2') return '日常';
    return '其他';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章列表</title>
</head>

<body>
    <table>
        <tr>
            <th>No</th>
            <th>標題</th>
            <th>分類</th>
        </tr>
        <?php foreach ($blogData as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= setCategoryName($row['category']) ?></td>
                <td><a href="./detail.php?id=<?= $row['id'] ?>">查看文章</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>