
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
        <label for="username">ユーザーID:</label>
        <input type="email" id="username" name="email" required><br>

        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="class_code">クラスコード:</label>
        <input type="text" id="class_code" name="class_code" required><br>

        <button type="submit" value="新規登録">登録</button>
    </form>
    <p id="message"></p>
</body>
</html>
