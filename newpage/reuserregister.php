<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パスワード再設定</title>
    <script src="/static/register.js"></script>
</head>
<body>
    <h2>パスワード再設定</h2>
    <form action="login.php" method="post">
        <label for="username">ユーザーID:</label>
        <input type="text" id="username" required><br>

        <label for="class_code">クラスコード:</label>
        <input type="text" id="class_code" required><br>

        
        <label for="password">新規パスワード</label>
        <input type="password" id="password" required><br>

        <button type="submit">再登録</button>
    </form>
    <p id="message"></p>
</body>
</html>