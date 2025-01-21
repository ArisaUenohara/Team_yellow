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
  background-color: #F5F5DC; /* Light beige background */
}

header {
  background-color: #D4C4B7; /* Soft beige header */
  color: #4A4A4A; /* Darker gray text for contrast */
  text-align: center;
  padding: 1.2rem 0;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

header h1 {
  margin: 0;
  font-weight: 500;
}

main {
  padding: 2.5rem;
  max-width: 1200px;
  margin: 0 auto;
}

.search-section,
.content-section {
  margin-bottom: 2.5rem;
  background-color: #FFF9F0; /* Very light beige */
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.search-section form {
  display: flex;
  gap: 0.8rem;
  justify-content: center;
  margin-bottom: 1.2rem;
}

.search-section input[type="text"] {
  padding: 0.8rem;
  font-size: 1rem;
  border: 1px solid #E8DFD8; /* Light beige border */
  border-radius: 6px;
  width: 300px;
  background-color: #FFFFFF;
  transition: border-color 0.3s ease;
}

.search-section input[type="text"]:focus {
  outline: none;
  border-color: #C4B0A1; /* Darker beige on focus */
  box-shadow: 0 0 4px rgba(196,176,161,0.2);
}

.search-section button {
  padding: 0.8rem 1.2rem;
  font-size: 1rem;
  background-color: #C4B0A1; /* Beige button */
  color: #FFFFFF;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-section button:hover {
  background-color: #B39E8C; /* Darker beige on hover */
}

table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  margin-top: 1.2rem;
  background-color: #FFFFFF;
  border: 1px solid #E8DFD8;
  border-radius: 8px;
  overflow: hidden;
}

table th, table td {
  text-align: left;
  padding: 1rem;
  border-bottom: 1px solid #E8DFD8;
}

table th {
  background-color: #F5EFE8; /* Very light beige header */
  color: #4A4A4A;
  font-weight: 500;
}

table tr:hover {
  background-color: #FFF9F0; /* Light beige hover effect */
}

button{
  background-color: #D4B5B0; /* Soft pink-beige */
color: #FFFFFF;
border: none;
padding: 0.6rem 1.2rem;
border-radius: 6px;
cursor: pointer;
transition: background-color 0.3s ease;
}

a{
  background-color: #D4B5B0; /* Soft pink-beige */
color: #FFFFFF;
border: none;
padding: 0.6rem 1.2rem;
border-radius: 6px;
cursor: pointer;
transition: background-color 0.3s ease;
text-decoration: none;
}
.delete-btn {
  background-color: #D4B5B0; /* Soft pink-beige */
  color: #FFFFFF;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.delete-btn:hover {
  background-color: #C4A59E; /* Darker pink-beige */
}

footer {
  text-align: center;
  padding: 1.2rem 0;
  background-color: #D4C4B7; /* Matching header */
  color: #4A4A4A;
  margin-top: 2.5rem;
  box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
}

    </style>
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
                        <th>クラス</th>
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
                        <td><?php echo htmlspecialchars($row['class'], ENT_QUOTES, 'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($row['group_number'], ENT_QUOTES, 'UTF-8');?></td>
                        <td><form method="post">
                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                      </form></td>
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

