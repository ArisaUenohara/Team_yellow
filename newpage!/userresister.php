
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <script src="/static/register.js"></script>
</head>
<body>
    <h2>新規登録</h2>
    <form action="signUp.php" method="post">
        
        <label for="name">名前</label>
        <input type="name" id="name" name="name" required><br>

        <label for="username">ユーザーID:</label>
        <input type="email" id="username" name="email" required><br>

        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required><br>
        <p>※英数字8文字以上</p>

        <button type="submit" value="新規登録">登録</button>
    </form>
    <p id="message"></p>
</body>
</html>
