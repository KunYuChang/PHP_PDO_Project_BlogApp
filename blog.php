<?php

require_once('./dbc.php');

class Blog extends Dbc
{
    protected $table_name = 'blog';

    public function setCategoryName($category)
    {
        if ($category === '1') return '技術';
        if ($category === '2') return '日常';
        return '其他';
    }

    public function blogCreate($blogs)
    {
        $sql = "INSERT INTO $this->table_name(title, content, category, publish_status) VALUES(:title, :content, :category, :publish_status)";
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

    public function blogUpdate($blogs)
    {
        $sql = "UPDATE $this->table_name 
                SET title = :title, 
                    content = :content, 
                    category = : category, 
                    publish_status = :publish_status
                WHERE id = :id";
        $dbh = $this->dbConnect();
        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
            $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
            $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit();
        } catch (PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }
    }

    function blogValidate($blogs)
    {

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
    }
}
