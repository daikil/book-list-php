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
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = self::getInstance()->prepare($sql);
        $param['id'] = $id;
        $stmt->execute($param);
    }

    public static function insert(string $title, string $isbn, int $price, string $author, string $publisher_name, string $created) {
        // INSERT文を作成。booksテーブルに新しい書籍レコードを挿入する。
        // 各フィールドに対応するプレースホルダ (:title, :isbn, :price など) を使用。
        $sql = "INSERT INTO books (title, isbn, price, author, publisher_name, created) 
            VALUES (:title, :isbn, :price, :author, :publisher_name, :created);";

        // SQL文にバインドするためのパラメータを連想配列に格納。
        // 各プレースホルダに、引数として受け取った値がバインドされる。
        $param = [
            "title" => $title,
            "isbn" => $isbn,
            "price" => $price,
            "author" => $author,
            "publisher_name" => $publisher_name,
            "created" => $created
        ];

        // データベース接続のインスタンスを取得し、SQL文を準備する。
        $stmt = self::getInstance()->prepare($sql);

        // パラメータをバインドしてSQLを実行し、実行結果を返す。
        // 成功すれば true、失敗すれば false を返す。
        return $stmt->execute($param);
    }
}