<?php

require_once './dbc.php';

$blogs = $_POST;

if (empty($blogs['title'])) {
    return ('請輸入標題!');
}

if (mb_strlen($blogs['title']) > 191) {
    return ('標題文字請輸入191字以內!');
}

if (empty($blogs['content'])) {
    return ('請輸入本文!');
}

if (empty($blogs['content'])) {
    return ('請選擇分類!');
}

if (empty($blogs['publish_status'])) {
    return ('請選擇發佈狀態!');
}

$sql = 'INSERT INTO blog(title, content, category, publish_status) VALUES(:title, :content, :category, :publish_status)';
$dbh = dbConnect();
$dbh->beginTransaction();
try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
    $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
    $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
    $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
    $stmt->execute();
    $dbh->commit();
} catch (PDOException $e) {
    $dbh->rollBack();
    exit($e);
}
