<?php
require_once('config.php');

session_start();

// セッションからユーザー情報を取得
if (!isset($_SESSION['EMAIL'])) {
    // ログインしていない場合、ログインページにリダイレクト
    header('Location: index.php');
    exit;
}

try {
    // データベースへ接続する
    $handle = new PDO(DSN, DB_USER, DB_PASS);

    // PDO実行時のエラーモードを設定する
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ログイン中のユーザーのメールアドレスを取得
    $email = $_SESSION['EMAIL'];

    // SQL文の準備 (ステートメントオブジェクトを作成)
    $stmt = $handle->prepare("SELECT result FROM type_result WHERE email = :email");

    // パラメータをバインドして実行
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // 結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $userResult = $result['result'];
    } else {
        $userResult = "診断結果が見つかりませんでした。";
    }
} catch (PDOException $e) {
    $userResult = "エラーが発生しました: " . $e->getMessage();
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
        <h1>あなたの診断結果</h1>
        <p id="result-description"><?php echo htmlspecialchars($userResult, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
</body>
</html>
