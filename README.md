# PHP_PDO_Project_BlogApp

## 操作流程

1. SQL 準備
2. SQL 執行 (PDOstatement)
3. SQL 結果取出

## 常見的 PDO 變數命名

1. $stmt = "statement"
2. $sth = "statement handle"
3. $dbh = "database handle"

## Prepare

1. 使用 placeholder,防止 SQL injection

## Namespace

1. 設置 Namespace 會引發找不到 PDO 物件的錯誤, 因此要宣告為根目錄的 PDO

## OOP

## 除錯

1. Apache 錯誤 (logs/apache_error.log)
2. Database 錯誤 (logs/mysql_error_log.err)
3. PHP 錯誤 (logs/php_error.log)
