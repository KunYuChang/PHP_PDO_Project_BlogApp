<?php

require_once './blog.php';

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

$blog = new Blog();
$blog->blogCreate($blogs);
