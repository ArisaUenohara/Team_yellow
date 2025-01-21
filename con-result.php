<?php
require_once('config.php');
session_start();

// セッションからユーザー情報を取得
if (!isset($_SESSION['EMAIL'])) {
    // ログインしていない場合、ログインページにリダイレクト
    header('Location: index.php');
    exit;
}

$resultDescription = "診断結果が見つかりませんでした。"; // デフォルトメッセージ

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['key'])) {
    try {
        // データベースへ接続する
        $handle = new PDO(DSN, DB_USER, DB_PASS);
        $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // GETリクエストからクラス名を取得
        $className = htmlspecialchars($_GET['key'], ENT_QUOTES, 'UTF-8');
        $userEmail=$_SESSION['EMAIL'];

         // データベースからクラス名とメールアドレスが一致するデータを検索
         $sql = "SELECT * FROM class_group WHERE class = :class AND email = :email";
         $stmt = $handle->prepare($sql);
         $stmt->bindParam(':class', $className, PDO::PARAM_STR);
         $stmt->bindParam(':email', $userEmail, PDO::PARAM_STR);
         $stmt->execute();

        // 結果を取得 (1行だけ取得する場合)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

         // 結果がある場合に説明を更新
         if ($result && isset($result['result'])) {
            $resultDescription = htmlspecialchars($result['result'], ENT_QUOTES, 'UTF-8');
        }
} catch (PDOException $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結果</title>
    <link rel="stylesheet" href="con-result.css">
</head>
<body>
<div class="container">
        <form method="get">
                <input type="text" name="key" placeholder="クラス名を入力してください" value="<?php echo htmlspecialchars($_GET['key'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <button class="search" type="submit">検索</button>
        </form>
        <h1>あなたの診断結果</h1>
        <div class="username">ユーザー：<?php echo htmlspecialchars($_SESSION['NAME'], ENT_QUOTES, 'UTF-8');?></div>
        <p id="result-description"><?php echo $resultDescription; ?></p>
        <button class="mypage" onclick="location.href ='mypage.php'">前に戻る</button>
    </div>
</body>
</html>

