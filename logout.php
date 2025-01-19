<?php
session_start();
$output = '';
if (isset($_SESSION["EMAIL"])) {
  $output = 'Logoutしました。';
} else {
  $output = 'SessionがTimeoutしました。';
}
//セッション変数のクリア
$_SESSION = array();
//セッションクッキーも削除
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
//セッションクリア
@session_destroy();

echo $output;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログアウト</title>
    <style>
      body {
        text-align:center;
        height: 10rem;
      }
  .logout {
            background-color: #8b7355;
            color: white;
            width: 15%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            margin: 0.5rem 0;
            transition: opacity 0.3s;
        }

</style>
    <script src="/static/register.js"></script>
</head>
<body>
<button class="logout" onclick="location.href='index.php'" type="button">ログイン</button>
</body>
</html>