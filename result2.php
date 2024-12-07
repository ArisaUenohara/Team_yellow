<?php

require_once('config.php');
session_start();

$resultType = $_SESSION['resultType'] ?? null;

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
// ユーザー情報の取得

// 必要な情報があるか確認
if ($userClass && $userId && $userName && $userEmail && $resultType) {
    // データベース接続情報
    $host = 'localhost'; // サーバのホスト名
    $db = 'database_name'; // データベース名
    $user = 'username'; // ユーザー名
    $pass = 'password'; // パスワード
    $charset = 'utf8mb4';

    // PDOを使用してデータベースに接続
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        // データを挿入するSQLクエリ
        $sql = "INSERT INTO type_result (id, class, name, email, result) VALUES (:id, :class, :name, :email, :result)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $userId,
            ':class' => $userClass,
            ':name' => $userName,
            ':email' => $userEmail,
            ':result' => $resultType,
        ]);

        echo "データが正常に挿入されました。";
    } catch (PDOException $e) {
        echo "データベースエラー: " . $e->getMessage();
    }
} else {
    echo "必要なデータが不足しています。";
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="result.css">
  <script src="result.js" defer></script>
  <title>診断結果</title>
</head>
<div class="result">
  <h1 id="result_title"></h1>
  <p id="result-description"></p>
</div>

</html>