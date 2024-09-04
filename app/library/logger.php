<?php
declare(strict_types=1);

// ログメッセージを書き込む関数
function writeLog(string $message): void {
    // 現在の日時を "YYYY/MM/DD HH:MM:SS" 形式で取得
    $now = date("Y/m/d H:i:s");

    // ログのフォーマットを作成。現在時刻とメッセージを含む1行のログエントリを作成
    $log = "{$now}: {$message}\n";

    // ログファイルのパスを決定。カレントディレクトリの親ディレクトリに "log/app.log" ファイルを作成/使用。
    $fileName = dirname(__DIR__) . "/log/app.log";

    // ログファイルが存在しない場合、空のファイルを作成。
    if (!file_exists($fileName)) {
        file_put_contents($fileName, '');
    }

    // ログファイルを追記モード ("a") で開く。ファイルが存在しない場合は作成される。
    $handle = fopen($fileName, "a");

    // 開いたファイルにログメッセージを書き込む
    fwrite($handle, $log);

    // ファイルを閉じる
    fclose($handle);
}