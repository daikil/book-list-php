<?php
declare(strict_types=1);

class DatabaseAccess {

    private static PDO $pdo;

    private function __construct() {}

    private static function getInstance(): PDO {
        if(!isset(self::$pdo)) {
            $dsn = "pgsql:host=book_list_php_db_container;dbname=postgres";
            self::$pdo = new PDO($dsn, "root", "root");
        }
        return self::$pdo;
    }

    public static function fetchAll(): array {
        $sql = "SELECT * FROM books ORDER BY id";
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetchBy(string $id) {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = self::getInstance()->prepare($sql);
        $param['id'] = $id;
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteBy(string $id) {
        // DELETEクエリを作成。特定の'id'のレコードを削除する。
        // :idはプレースホルダで、実際のIDは後でバインドされる。
        $sql = "DELETE FROM books WHERE id = :id";

        // データベースへの接続インスタンスを取得し、SQL文を準備する。
        $stmt = self::getInstance()->prepare($sql);

        // SQL文のプレースホルダ ':id' にバインドするパラメータを設定する。
        $param['id'] = $id;

        // 準備したSQLを実行し、指定された'id'のレコードを削除する。
        $stmt->execute($param);
    }
}