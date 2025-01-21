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
        }

        header {
            background-color: #D4C4B7;
            color: #4A4A4A;
            text-align: center;
            padding: 1.2rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            font-weight: 500;
            font-size: 1.8rem;
        }

        main {
            padding: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .search-section,
        .content-section {
            margin-bottom: 2.5rem;
            background-color: #FFF9F0;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .search-section form {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            justify-content: center;
            margin-bottom: 1.2rem;
        }

        .search-section input[type="text"] {
            padding: 0.8rem;
            font-size: 1rem;
            border: 1px solid #E8DFD8;
            border-radius: 6px;
            width: 100%;
            max-width: 300px;
            background-color: #FFFFFF;
        }

        /* テーブルコンテナのスタイル */
        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 1.2rem;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            min-width: 800px; /* テーブルの最小幅を設定 */
            border-collapse: separate;
            border-spacing: 0;
            background-color: #FFFFFF;
            border: 1px solid #E8DFD8;
            border-radius: 8px;
        }

        table th, table td {
            text-align: left;
            padding: 0.8rem;
            border-bottom: 1px solid #E8DFD8;
            white-space: nowrap; /* セル内の改行を防ぐ */
        }

        table th {
            background-color: #F5EFE8;
            color: #4A4A4A;
            font-weight: 500;
        }

        button, a {
            background-color: #D4B5B0;
            color: #FFFFFF;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0.5rem 0;
        }

        .box {
            margin-top: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        footer {
            text-align: center;
            padding: 1.2rem 0;
            background-color: #D4C4B7;
            color: #4A4A4A;
            margin-top: 2.5rem;
        }

        /* メディアクエリ */
        @media screen and (max-width: 768px) {
            header h1 {
                font-size: 1.5rem;
            }

            main {
                padding: 0.5rem;
            }

            .search-section,
            .content-section {
                padding: 0.8rem;
            }

            button, a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>管理者ページ</h1>
    </header>
    <main>
        <section class="search-section">
            <!-- 検索フォーム部分は変更なし -->
        </section>
        <section class="content-section">
            <h2>ユーザー 一覧</h2>
            <?php if (!empty($result)): ?>
            <div class="table-container">
                <table>
                    <!-- テーブルの内容は変更なし -->
                </table>
            </div>
            <?php else: ?>
                <p>該当するデータが見つかりません。</p>
            <?php endif; ?>

            <div class="box">
                <!-- ボタン部分は変更なし -->
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 管理者ページ</p>
    </footer>
</body>
</html>
