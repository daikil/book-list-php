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
        // SQLクエリを定義します。'books'テーブルから特定の'id'のレコードを取得し、
        // id順に並べ替えます。:idはプレースホルダで、後で実際の値に置き換えられます。
        $sql = "SELECT * FROM books WHERE id = :id";

        // self::getInstance()はデータベースへの接続インスタンス(PDO)を取得し、
        // prepareメソッドでSQLクエリを準備します。
        $stmt = self::getInstance()->prepare($sql);

        // プレースホルダ ':id' に対応する実際のパラメータを設定します。
        // $param配列に 'id' キーとして、引数 $id の値を設定します。
        $param['id'] = $id;

        // SQLクエリを実行します。executeメソッドで、プレースホルダに対応するパラメータを渡します。
        $stmt->execute($param);

        // 結果セットの最初の行を連想配列として取得します。該当するレコードがあれば返し、
        // なければ false が返されます。
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}