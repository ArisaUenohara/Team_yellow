<?php
require_once('config.php'); 

// クラス情報を取得
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['class'] = $_POST['class'];
}

// ユーザーデータ
$user = $_SESSION['user'];

// 仮の診断結果（ランダム）
$types = ['リーダータイプ', '協力タイプ', '分析タイプ', '実行タイプ'];
$result = $types[array_rand($types)];

// 診断結果をデータベースに保存
try {
    $stmt = $pdo->prepare("INSERT INTO type_result(class, name, email, result) VALUES (:class, :name, :email, :result)");
    $stmt->execute([
        ':class' => $_SESSION['class'],
        ':name' => $user['name'],
        ':email' => $user['email'],
        ':result' => $result
    ]);
} catch (PDOException $e) {
    die('データベースエラー: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タイプ診断結果</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>診断結果</h1>
        <p><strong>クラス:</strong> <?php echo htmlspecialchars($_SESSION['class']); ?></p>
        <p><strong>あなたのタイプ:</strong> <?php echo $result; ?></p>
        <a href="mypage.php" class="button">マイページに戻る</a>
    </div>
</body>
</html>
