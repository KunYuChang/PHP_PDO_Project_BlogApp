<?php

require_once('./dbc.php');

$dbc = new Dbc();
$blogData = $dbc->getAllBlog();

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
    <h2>文章列表</h2>
    <a href="./form.html">新增文章</a>
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
                <td><?= $dbc->setCategoryName($row['category']) ?></td>
                <td><a href="./detail.php?id=<?= $row['id'] ?>">查看文章</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>