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

function setCategoryName($category)
{
    if ($category === '1') return '技術';
    if ($category === '2') return '日常';
    return '其他';
}

function getBlogById($id)
{
    if (empty($id)) {
        exit('發生錯誤!');
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

    return $result;
}
