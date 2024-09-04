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
        $sql = "INSERT INTO books (title, isbn, price, author, publisher_name, created) VALUES (:title, :isbn, :price, :author, :publisher_name, :created);";
        $param = [
            "title" => $title,
            "isbn" => $isbn,
            "price" => $price,
            "author" => $author,
            "publisher_name" => $publisher_name,
            "created" => $created
        ];
        $stmt = self::getInstance()->prepare($sql);
        return $stmt->execute($param);
    }

    public static function update(string $id, string $title, string $isbn, int $price, string $author, string $publisher_name, string $created) {
        // UPDATE文を作成。指定された'id'のレコードに対して、各フィールドを更新する。
        // ':title', ':isbn', ':price' などはプレースホルダで、後でパラメータにバインドされる。
        $sql = "UPDATE books 
            SET title=:title, isbn=:isbn, price=:price, author=:author, publisher_name=:publisher_name, created=:created 
            WHERE id = :id;";
        // SQLクエリにバインドするパラメータを連想配列で定義する。
        // プレースホルダにそれぞれの値がバインドされる。
        $param = [
            "id" => $id,                            // 更新対象のレコードのID
            "title" => $title,                      // 更新するタイトル
            "isbn" => $isbn,                        // 更新するISBN
            "price" => $price,                      // 更新する価格
            "author" => $author,                    // 更新する著者
            "publisher_name" => $publisher_name,    // 更新する出版社名
            "created" => $created                   // 更新する作成日時
        ];
        // データベース接続インスタンスを取得し、SQL文を準備する。
        $stmt = self::getInstance()->prepare($sql);
        // パラメータをバインドしてSQL文を実行する。成功すればtrue、失敗すればfalseを返す。
        return $stmt->execute($param);
    }
}