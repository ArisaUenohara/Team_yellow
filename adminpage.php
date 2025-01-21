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

    // データ削除処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
      $delete_id = intval($_POST['delete_id']);
      $delete_sql = "DELETE FROM class_group WHERE id = :id";
      $delete_stmt = $handle->prepare($delete_sql);
      $delete_stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
      $delete_stmt->execute();
      header('Location: adminpage.php'); // リロードして最新状態を反映
      exit;
    }
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F5DC;
            min-height: 100vh;
            position: relative;
            padding-bottom: 60px; /* フッターの高さ分 */
        }

        /* ヘッダー部分のスタイリング */
        .page-header {
            background: linear-gradient(145deg, #E6D5CA, #F0E6E0);
            padding: 1.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .page-title {
            background: linear-gradient(145deg, #F0E6E0, #FFF5EC);
            padding: 1rem;
            border-radius: 10px;
            margin: 0 auto;
            max-width: 600px;
            text-align: center;
        }

        .page-title h1 {
            margin: 0;
            color: #5D4037;
            font-size: 1.8rem;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* 検索セクション */
        .search-section {
            background: #FFF9F0;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .search-input {
            padding: 0.8rem;
            border: 1px solid #E8DFD8;
            border-radius: 6px;
            flex: 1;
            max-width: 300px;
            font-size: 1rem;
        }

        /* ユーザー一覧セクション */
        .content-section {
            background: #FFF9F0;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .section-title {
            background: linear-gradient(145deg, #F0E6E0, #FFF5EC);
            padding: 1rem;
            border-radius: 8px;
            margin: -1.5rem -1.5rem 1.5rem -1.5rem;
        }

        .section-title h2 {
            margin: 0;
            color: #5D4037;
            font-size: 1.4rem;
            text-align: center;
        }

        /* ユーザーリスト */
        .user-list-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .user-row {
            display: table-row;
        }

        .user-cell {
            display: table-cell;
            padding: 1rem;
            border-bottom: 1px solid #E8DFD8;
            color: #5D4037;
        }

        .user-header {
            background: #F0E6E0;
            font-weight: bold;
        }

        /* モバイル用カード */
        .user-card {
            background: #FFFFFF;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: none;
        }

        .user-card-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: #5D4037;
        }

        .user-card-label {
            font-weight: bold;
            min-width: 100px;
        }

        /* ボタンスタイル */
        button, 
        .button {
            background: linear-gradient(145deg, #D4B5B0, #E8C7C2);
            color: #5D4037;
            border: none;
            padding: 0.8rem 1.2rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        button:hover,
        .button:hover {
            background: linear-gradient(145deg, #E8C7C2, #D4B5B0);
        }

        /* フッター */
        .footer {
            background: linear-gradient(145deg, #E6D5CA, #F0E6E0);
            padding: 0.8rem;
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 0.8rem;
            color: #5D4037;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }

        /* レスポンシブ対応 */
        @media screen and (max-width: 768px) {
            .page-title h1 {
                font-size: 1.5rem;
            }

            .section-title h2 {
                font-size: 1.2rem;
            }

            .user-list-table {
                display: none;
            }

            .user-card {
                display: block;
            }

            .search-form {
                flex-direction: column;
            }

            .search-input {
                max-width: 100%;
            }

            button,
            .button {
                width: 100%;
                text-align: center;
            }
        }

        /* タブレット対応 */
        @media screen and (min-width: 769px) and (max-width: 1024px) {
            main {
                padding: 1.5rem;
            }

            .user-list-table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="page-title">
            <h1>管理者ページ</h1>
        </div>
    </header>

    <main>
        <section class="search-section">
            <form method="get" class="search-form">
                <input type="text" name="key" class="search-input" 
                       placeholder="コード名を入力してください" 
                       value="<?php echo htmlspecialchars($_GET['key'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                       required>
                <button type="submit">検索</button>
            </form>
            <?php if (!empty($_GET['key'])): ?>
                <form method="GET" action="" style="margin-top: 1rem; text-align: center;">
                    <button type="submit">リセット</button>
                </form>
            <?php endif; ?>
        </section>

        <section class="content-section">
            <div class="section-title">
                <h2>ユーザー 一覧</h2>
            </div>

            <?php if (!empty($result)): ?>
                <!-- PC用テーブル表示 -->
                <div class="user-list-table">
                    <div class="user-row user-header">
                        <div class="user-cell">名前</div>
                        <div class="user-cell">ユーザーID</div>
                        <div class="user-cell">診断結果</div>
                        <div class="user-cell">クラス</div>
                        <div class="user-cell">グループ</div>
                        <div class="user-cell"></div>
                    </div>
                    <?php foreach ($result as $row): ?>
                    <div class="user-row">
                        <div class="user-cell"><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="user-cell"><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="user-cell"><?php echo htmlspecialchars($row['result'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="user-cell"><?php echo htmlspecialchars($row['class'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="user-cell"><?php echo htmlspecialchars($row['group_number'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="user-cell">
                            <form method="post" style="margin: 0;">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- モバイル用カード表示 -->
                <?php foreach ($result as $row): ?>
                <div class="user-card">
                    <div class="user-card-row">
                        <span class="user-card-label">名前：</span>
                        <span class="user-card-value"><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div class="user-card-row">
                        <span class="user-card-label">ユーザーID：</span>
                        <span class="user-card-value"><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div class="user-card-row">
                        <span class="user-card-label">診断結果：</span>
                        <span class="user-card-value"><?php echo htmlspecialchars($row['result'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div class="user-card-row">
                        <span class="user-card-label">クラス：</span>
                        <span class="user-card-value"><?php echo htmlspecialchars($row['class'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div class="user-card-row">
                        <span class="user-card-label">グループ：</span>
                        <span class="user-card-value"><?php echo htmlspecialchars($row['group_number'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <div style="text-align: right; margin-top: 1rem;">
                        <form method="post">
                            <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: #5D4037;">該当するデータが見つかりません。</p>
            <?php endif; ?>

            <div style="text-align: center; margin-top: 2rem; gap: 1rem; display: flex; justify-content: center; flex-wrap: wrap;">
                <form action="search.php" method="post">
                    <input type="hidden" name="class" value="<?php echo htmlspecialchars($_GET['key'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit">グループ分け</button>
                </form>
                <a href="logout.php" class="button">ログアウト</a>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2025 管理者ページ</p>
    </footer>
</body>
</html>
