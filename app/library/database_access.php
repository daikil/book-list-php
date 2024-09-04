<?php
declare(strict_types=1);

// DatabaseAccess クラスを定義する。
// このクラスはデータベースへの接続や、データの取得などのデータベース操作を管理する。
class DatabaseAccess {

    // 静的プロパティ $pdo はデータベース接続に使用する PDO インスタンスを保持する。
    private static PDO $pdo;

    // コンストラクタを private にすることで、このクラスのインスタンス化を禁止している。
    // DatabaseAccess は静的に動作するクラスで、インスタンス化する必要がない。
    private function __construct() {}

    // データベース接続のインスタンスを取得するメソッド。
    // 既に接続が確立されている場合は、その接続を返し、未接続の場合は新しい PDO インスタンスを作成する。
    private static function getInstance(): PDO {
        // $pdo がまだ設定されていなければ、新しく接続を確立する。
        if (!isset(self::$pdo)) {
            // DSN (Data Source Name) を使用して PostgreSQL データベースへの接続を指定する。
            // 'pgsql:host=book_list_php_db_container;dbname=postgres' で接続先ホストとデータベース名を指定。
            $dsn = "pgsql:host=book_list_php_db_container;dbname=postgres";

            // new PDO で新しい PDO インスタンスを作成。データベースのホスト、ユーザー名、パスワードを指定する。
            // ここではユーザー名 "root"、パスワード "root" を使用している。
            self::$pdo = new PDO($dsn, "root", "root");
        }
        // 既に作成された PDO インスタンスを返す。
        return self::$pdo;
    }

    // データベースから全ての書籍データを取得するメソッド。
    // fetchAll() は SELECT クエリを実行し、その結果を連想配列として返す。
    public static function fetchAll(): array {
        // 取得したいデータの SQL クエリ。'books' テーブルの全データを 'id' 順に並べ替える。
        $sql = "SELECT * FROM books ORDER BY id";

        // getInstance() を呼び出して PDO インスタンスを取得し、prepare メソッドで SQL を準備する。
        $stmt = self::getInstance()->prepare($sql);

        // 準備した SQL を実行する。
        $stmt->execute();

        // 実行結果をすべて取得し、連想配列（PDO::FETCH_ASSOC）として返す。
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}