<?php
// strict_types モードを有効にすることで、型の厳密なチェックを行う。
// 関数やメソッドに渡される引数や返り値の型を厳密に守るようにする。
declare(strict_types=1);

// database_access.php ファイルを親ディレクトリの library フォルダから読み込む。
// これは、データベースアクセスのためのクラスやメソッドが定義されているファイル。
require_once(dirname(__DIR__) . "/library/database_access.php");

// DatabaseAccessクラスのfetchAllメソッドを呼び出し、全データを取得。
// データベースからのレコードを全て取得して、$data変数に格納している。
$data = DatabaseAccess::fetchAll();

// templateディレクトリにある book.php ファイルを親ディレクトリから読み込む。
// 取得したデータを使ってWebページに表示するためのテンプレートファイル。
require_once(dirname(__DIR__) . "/template/book.php");