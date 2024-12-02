<?php

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

session_start();
//ログイン済みの場合
if (isset($_SESSION['EMAIL'])) {
  echo 'ようこそ' .  h($_SESSION['EMAIL']) . "さん<br>";
  echo "<a href='logout.php'>ログアウトはこちら。</a>";
  exit;
}

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="loginpage.css">
    <script src="login.js"></script>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1>ログイン</h1>
            <form action="login.php" method="post">

                <div class="form-group">
                    <label for="username">ユーザーID</label>
                    <input type="email" id="username" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="login-button">ログイン</button>
            </form>
            <p><a href="userresister.php">新規登録</a></p>

            

            <p id="message" class="message"></p>
        </div>
    </div>
</body>
</html>

