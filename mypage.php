<?php
session_start();

// セッションからユーザー情報を取得
if (!isset($_SESSION['user'])) {
    // ログインしていない場合、ログインページにリダイレクト
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];

session_start();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <link rel="stylesheet" href="mypage.css">
</head>
<body>
    <div class="container">
        <h1>マイページ</h1>
        
        <!-- ユーザー情報 -->
        <div class="user-info">
            <p><strong>名前:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>ユーザーID (メール):</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>

        <!-- クラス入力フォーム -->
        <form id="class-form" method="POST" action="judge.php">
            <label for="class-input">クラスを入力してください:</label>
            <input type="text" id="class-input" name="class" required>
            <button type="submit">タイプ診断へ</button>
        </form>
    </div>
    <script src="mypage.js"></script>
</body>
</html>
