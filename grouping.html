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
    // データベースへ接続
    $handle = new PDO(DSN, DB_USER, DB_PASS);
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 検索処理
    $result = [];
    $user_group =[];
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['key'])) {
        // GETリクエストから検索条件を取得
        $classname = htmlspecialchars($_GET['key'], ENT_QUOTES, 'UTF-8');
        $conn="SELECT * FROM class_group WHERE class=:class AND email=:email";
        $stmt2 = $handle->prepare($conn);
        $stmt2->bindParam(':class', $classname, PDO::PARAM_STR);
        $stmt2->bindParam(':email', $_SESSION['EMAIL'], PDO::PARAM_STR);
        $stmt2->execute();
       
        $user_group= $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $user_group_number=$user_group[0]['group_number'];

        // 検索用のSQLを準備
        $sql = "SELECT * FROM class_group WHERE class = :class AND group_number=:group_number" ;
        $stmt = $handle->prepare($sql);
        $stmt->bindParam(':class', $classname, PDO::PARAM_STR);
        $stmt->bindParam(':group_number', $user_group_number, PDO::PARAM_STR);
        $stmt->execute();
        
        // 結果を取得
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
    }
    
} catch (PDOException $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="grouping.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザーグループ</title>
</head>
<body>
    <div class="container">
        <form method="get">
                <input type="text" name="key" placeholder="クラス名を入力してください" value="<?php echo htmlspecialchars($_GET['key'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <button class="search" type="submit">検索</button>
        </form>
        <h1>グループ分け</h1>
        <div class="username">ユーザー：<?php echo htmlspecialchars($_SESSION['NAME'], ENT_QUOTES, 'UTF-8');?></div>
         <!-- 最初に検索結果が空でない場合に表示 -->
         <?php if (!empty($result)): ?>
            <div class="group-badge">
                第<?php echo htmlspecialchars($user_group_number, ENT_QUOTES, 'UTF-8'); ?>グループ
            </div>
            <div class="group-members">
                <h3>グループメンバー</h3>
                <ul class="member-list">
                    <?php foreach ($result as $row): ?>
                        <li><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <p>グループを覚えておいてください。今後のアクティビティはこのグループに従って行われます。</p>
        <?php else: ?>
            <p> </p>
        <?php endif; ?>
        <button class="mypage" onclick="location.href ='mypage.php'">前に戻る</button>
    </div>
</body>
</html>