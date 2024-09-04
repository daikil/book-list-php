<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>書籍一覧</title>
</head>
<body>
<div id="header">
    <h1>
        <div class="clearfix">
            <div class="fl">書籍管理システム</div>
        </div>
    </h1>
</div>
<div id="main">
    <div class="container">
        <h3 id="title">書籍一覧画面</h3>
        <a href="logout.php">ログアウト</a>
    </div>
    <div>
        <table class="table_design01">
            <thead>
            <tr>
                <th>タイトル</th>
                <th>著者</th>
                <th>出版社</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["publisher_name"]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>