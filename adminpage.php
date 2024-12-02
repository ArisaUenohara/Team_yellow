<?php
require_once('config.php');

try {
	// データベースへ接続する
	$handle = new PDO(DSN, DB_USER, DB_PASS);

	// PDO実行時のエラーモードを設定する
	$handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// SQL文の準備
	$sql = "SELECT * FROM userData";
	
	// SQL文の実行
	$stmt = $handle->query($sql);
	
	// SQL文の結果の取り出し
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// データベースとの接続を終了する
	$handle = null;
} catch (PDOException $e) {
	// エラー内容を表示する
	echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
	exit;
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ページ</title>
    <link rel="stylesheet" href="adminpage.css">
</head>
<body>
    <header>
        <h1>管理者ページ</h1>
    </header>
    <main>
        <section class="search-section">
            <form action="/search" method="get">
                <input type="text" name="codename" placeholder="コード名を入力してください" required>
                <button type="submit">検索</button>
            </form>
        </section>
        <section class="content-section">
            <h2>管理コンテンツ</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>ユーザーID</th>
                        <th>診断結果</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <!-- ここでPHPのforeachを使って結果をループさせる -->
                 <?php foreach ($result as $row):?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');?></td>
                        <td></td>
                        <td><button class="delete-btn">削除</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 管理者ページ</p>
    </footer>
</body>
</html>
