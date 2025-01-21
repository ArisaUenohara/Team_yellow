<?php
require_once('config.php');
session_start();

// データベースへ接続する
$handle = new PDO(DSN, DB_USER, DB_PASS);
$handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $newPassword = $_POST['password'] ?? '';

    if (empty($email) || empty($newPassword)) {
        echo '<p style="color: red;">すべてのフィールドを入力してください。</p>';
    } else {
        try {
            // データベース接続
            $pdo = new PDO(DSN, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // ユーザーの存在確認
            $stmt = $pdo->prepare('SELECT * FROM userData2 WHERE email = :email');
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // パスワードの更新
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateStmt = $pdo->prepare('UPDATE userData2 SET password = :password WHERE email = :email');
                $updateStmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
                $updateStmt->bindValue(':email', $email, PDO::PARAM_STR);
                $updateStmt->execute();

                echo '<p style="color: green;">パスワードが更新されました。</p>';
            } else {
                echo '<p style="color: red;">メールアドレスが見つかりません。</p>';
            }
        } catch (PDOException $e) {
            echo '<p style="color: red;">エラーが発生しました: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    }
}
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パスワード再設定</title>
    <style>
        /* Previous styles remain the same */
        body {
            font-family: "MS PGothic", "Hiragino Kaku Gothic Pro", sans-serif;
            background-color: #faf7f5;
            margin: 0 auto;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .reuserresister-card {
            background-color: #8b7355;
            padding: 2rem;
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 380px;
            text-align: center;
            justify-content: center;
        }

        .title {
            color: #8b7355;
            font-size: 2.5rem;
            margin-bottom: 2.5rem;
            font-weight: bold;
        }

        .input-group {
            background-color: #f5f5f5;
            width: 90%;
            padding: 0.8rem 1.2rem;
            border-radius: 2.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            align-items: center;
            text-align: left;
            transition: opacity 0.3s;
        }

        .input-group input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            padding: 0.5rem;
            color: #333333d7;
        }

        .input-icon {
            color: #8b7355;
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        button {
            background-color: #f5f5f5;
            width: 100%;
            padding: 0.8rem 1.2rem;
            margin-bottom: 1rem;
            cursor: pointer;
            align-items: center;
            text-align: center;
            border-radius: 2.5rem;
            border: none;
            outline:none;
        }

        .button:hover {
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="reuserresister-card"><h2>パスワード再設定</h2>
    <form action="" method="post">

        <div class="input-group">
            <input type="text" name="email" placeholder="メールアドレス" required><br>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="新規パスワード" required><br>
        </div>

        <div class="button">
        <button type="submit">再登録</button>
        </div>
    </form>
    </div>
    <p id="message"></p>
</body>
</html>