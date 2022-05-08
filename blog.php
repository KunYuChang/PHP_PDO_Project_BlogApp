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
