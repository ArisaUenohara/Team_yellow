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
    <style>
        /* Previous styles remain the same */
        body {
            font-family: Arial, sans-serif;
            background-color: #faf7f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background-color: white;
            padding: 2rem;
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        .title {
            color: #8b7355;
            font-size: 2.5rem;
            margin-bottom: 2.5rem;
            font-weight: bold;
        }

        .bear {
            width: 120px;
            height: 120px;
            margin: 1rem auto 2rem;
            position: relative;
        }

        .bear-face {
            background-color: #8b7355;
            width: 100px;
            height: 80px;
            border-radius: 50px 50px 40px 40px;
            position: relative;
            margin: 0 auto;
        }

        .bear-ears {
            position: absolute;
            top: -20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 15px;
        }

        .ear {
            width: 30px;
            height: 30px;
            background-color: #8b7355;
            border-radius: 50%;
        }

        .bear-eyes {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding-top: 25px;
        }

        .eye {
            width: 8px;
            height: 8px;
            background-color: #333;
            border-radius: 50%;
        }

        .bear-nose {
            width: 15px;
            height: 12px;
            background-color: #333;
            border-radius: 30%;
            margin: 10px auto 0;
        }

        .bear-hat {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 25px;
            background-color: #a18cd1;
            border-radius: 20px 20px 0 0;
        }

        .input-group {
            background-color: #f5f5f5;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            text-align: left;
        }

        .input-group input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            padding: 0.5rem;
            color: #333;
        }

        .input-icon {
            color: #8b7355;
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        .button {
            background-color: #8b7355;
            color: white;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            margin: 0.5rem 0;
            transition: opacity 0.3s;
        }

        .button:hover {
            opacity: 0.9;
        }

        .secondary-button {
            background-color: #a18cd1;
        }

        .forgot-password {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            margin-top: 1rem;
        }

        .forgot-password:hover {
            color: #8b7355;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .button-group .button {
            flex: 1;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="title">こんにちは</div>
        <div class="bear">
            <div class="bear-hat"></div>
            <div class="bear-ears">
                <div class="ear"></div>
                <div class="ear"></div>
            </div>
            <div class="bear-face">
                <div class="bear-eyes">
                    <div class="eye"></div>
                    <div class="eye"></div>
                </div>
                <div class="bear-nose"></div>
            </div>
        </div>
        <form action="login.php" method="post">
            <div class="input-group">
                <span class="input-icon">✉️</span>
                <input type="email" placeholder="メールアドレス" name="email" required>
            </div>
            <div class="input-group">
                <span class="input-icon">🔑</span>
                <input type="password" placeholder="パスワード" name="password" required>
            </div>
            <button type="submit" class="button">ログイン</button>
        </form>
            <div class="button-group">
                <button onclick="location.href='userresiter.php'" type="button" class="button secondary-button">新規登録</button>
            </div>
            <a href="reuserresister.php" class="forgot-password">パスワードをお忘れの方はこちら</a>
            <a href="introduction.html" class="forgot-password">グループ活動マッチングサービスって何？➡</a>
    </div>
</body>

</html>