<?php
declare(strict_types=1);
require_once(dirname(__DIR__) . "/library/database_access.php");

// リクエストがPOSTメソッドで送信されたかどうかをチェック
if (mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    //mb_strtolower 全て小文字にする
    // 'delete'というキーが$_POSTにセットされているかを確認
    if (isset($_POST['delete'])) {
        // 'id'というキーの値を$_POSTから取得。存在しない場合は空文字を代入
        $id = $_POST['id'] ?? '';
        // $idが空でないか（nullや空文字でないか）を確認
        if (!empty($id)) {
            // DatabaseAccessクラスのdeleteByメソッドを呼び出して、指定されたIDのレコードを削除
            DatabaseAccess::deleteBy($id);
        }
    }
}

$data = DatabaseAccess::fetchAll();
require_once(dirname(__DIR__) . "/template/book.php");