<?php

class Dbc
{
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
        $dbh = $this->dbConnect();
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


        $dbh = $this->dbConnect();

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

    function blogCreate($blogs)
    {
        $sql = 'INSERT INTO blog(title, content, category, publish_status) VALUES(:title, :content, :category, :publish_status)';
        $dbh = $this->dbConnect();
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
    }
}
