<?php
require_once('config.php');

session_start();

// 管理者かどうかを確認
if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN'] != 1) {
    header('Location: index.php');
    exit;
}

try {
    // データベースへ接続
    $handle = new PDO(DSN, DB_USER, DB_PASS);
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 検索処理
    $result = [];
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['key'])) {
        // GETリクエストから検索条件を取得
        $classname = htmlspecialchars($_GET['key'], ENT_QUOTES, 'UTF-8');
        // 検索用のSQLを準備
        $sql = "SELECT * FROM class_group WHERE class = :class";
        $stmt = $handle->prepare($sql);
        $stmt->bindParam(':class', $classname, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        // 全件表示用のSQLを準備
        $sql = "SELECT * FROM class_group";
        $stmt = $handle->query($sql);
    }

    // 結果を取得
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
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
            <form method="get">
                <input type="text" name="key" placeholder="コード名を入力してください" value="<?php echo htmlspecialchars($_GET['key'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <button type="submit">検索</button>
            </form>
            <?php if (!empty($_GET['key'])): ?>
                <!-- リセットボタン -->
                <form method="GET" action="">
                    <button type="submit" style="margin-top: 10px;">リセット</button>
                </form>
            <?php endif; ?>
        </section>
        <section class="content-section">
            <h2>ユーザー 一覧</h2>
            <?php if (!empty($result)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>ユーザーID</th>
                        <th>診断結果</th>
                        <th>グループ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <!-- ここでPHPのforeachを使って結果をループさせる -->
                 <?php foreach ($result as $row):?>
                    <tr>
                    <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($row['result'], ENT_QUOTES, 'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($row['group_number'], ENT_QUOTES, 'UTF-8');?></td>
                        <td><form method="post" action="delete.js"><button type="submit" class="delete-btn">削除</button></form></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>該当するデータが見つかりません。</p>
            <?php endif; ?>

            <div class="box">
                <form action="search.php" method="post">
                    <input type="hidden" name="class" value="<?php echo htmlspecialchars($_GET['key'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    <button>グループ分け</button>
                </form>
                <p><a href ="logout.php">ログアウト</a></p>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 管理者ページ</p>
    </footer>
</body>
</html>
