<?php
declare(strict_types=1);
// データベース接続用のライブラリをインクルードする
require_once(dirname(__DIR__) . "/library/database_access.php");

// リクエストがPOSTメソッドで送信されたか確認
if (mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post') {

    // POSTデータに 'detail' が存在する場合、編集画面のデータ準備を行う
    if (isset($_POST['detail'])) {
        // 'detail' の内容をJSONとしてデコードし、配列として取得
        $data = json_decode($_POST['detail'], true);

        // デコードしたデータから 'id' を取得
        $id = $data['id'];

        // DateTimeオブジェクトを作成し、'created' の日時文字列を解析
        $dateTime = new DateTime($data['created']);

        // 'Y-m-d\TH:i' 形式でdatetime-local入力フォームに対応した形式に変換
        $formattedDateTime = $dateTime->format('Y-m-d\TH:i');

        // 編集用テンプレートファイル 'edit.php' をインクルードし、編集画面を表示
        require_once(dirname(__DIR__) . "/template/edit.php");

    } else {
        // POSTデータに 'detail' が存在しない場合、更新処理を行う
        $data = json_decode($_POST['data'], true);

        // 各書籍情報をPOSTデータから取得。無い場合は空文字を代入。
        $id = (string)$data['id'];
        $title = $_POST['title'] ?? '';
        $isbn = $_POST['isbn'] ?? '';
        $price = $_POST['price'] ?? '';
        $author = $_POST['author'] ?? '';
        $publisher_name = $_POST['publisher_name'] ?? '';
        $created = $_POST['created'] ?? '';

        // DateTimeオブジェクトを作成し、'created' の日時文字列を解析
        $dateTime = new DateTime($created);

        // 'Y-m-d\TH:i' 形式でdatetime-local入力フォームに対応した形式に変換
        $formattedDateTime = $dateTime->format('Y-m-d\TH:i');

        // データベースを更新するため、updateメソッドを呼び出し
        DatabaseAccess::update($id, $title, $isbn, (int)$price, $author, $publisher_name, $formattedDateTime);

        // 更新後、書籍リストページへリダイレクト
        require_once(dirname(__DIR__) . "/htdocs/book.php");
    }
}