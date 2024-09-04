<?php
declare(strict_types=1);
require_once(dirname(__DIR__) . "/library/database_access.php");
require_once(dirname(__DIR__) . "/library/logger.php");

if(mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'] ?? '';
        if (!empty($id)) {
            DatabaseAccess::deleteBy($id);
        }
    }
}

$data = DatabaseAccess::fetchAll();
writeLog("【表示】一覧画面");
require_once(dirname(__DIR__) . "/template/book.php");