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
        /* ... 既存のスタイルは維持 ... */
        
        /* テーブル関連のスタイルを完全に書き換え */
        .user-list {
            width: 100%;
            margin-top: 1.2rem;
        }

        .user-card {
            background: #FFFFFF;
            border: 1px solid #E8DFD8;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .user-card-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .user-card-label {
            font-weight: bold;
            min-width: 100px;
        }

        .user-card-value {
            flex: 1;
        }

        .delete-form {
            margin-top: 1rem;
            text-align: right;
        }

        /* PCでの表示用のテーブル */
        @media screen and (min-width: 769px) {
            .user-list-table {
                display: table;
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
                background-color: #FFFFFF;
                border: 1px solid #E8DFD8;
                border-radius: 8px;
            }

            .user-row {
                display: table-row;
            }

            .user-cell {
                display: table-cell;
                padding: 1rem;
                border-bottom: 1px solid #E8DFD8;
            }

            .user-header {
                background-color: #F5EFE8;
                font-weight: bold;
            }

            /* モバイル表示用の要素を非表示 */
            .user-card {
                display: none;
            }
        }

        /* モバイルでの表示 */
        @media screen and (max-width: 768px) {
            .user-list-table {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>管理者ページ</h1>
    </header>
    <main>
        <!-- 検索セクションは変更なし -->
        <section class="content-section">
            <h2>ユーザー 一覧</h2>
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
                <div class="user-list">
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
                        <div class="delete-form">
                            <form method="post">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>該当するデータが見つかりません。</p>
            <?php endif; ?>

            <div class="box">
                <!-- 既存のボタン部分は変更なし -->
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 管理者ページ</p>
    </footer>
</body>
</html>
