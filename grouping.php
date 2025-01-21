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
    <style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  background-color: #faf7f5;
}
.container {
    background-color: white;
            padding: 2rem;
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 380px;
            text-align: center;
}

.container input {
  background-color: #f5f5f5;
  width: 60%;
  padding: 0.8rem 1.2rem;
  border-radius: 2.5rem;
  margin-bottom: 1rem;
  align-items: center;
  text-align: left;
  transition: opacity 0.3s;
  border: none;
  background: none;

}
h1 {
    color: #8b7355;
            font-size: 2.5rem;
            margin-bottom: 2.5rem;
            font-weight: bold;
}

.search {
  width:15%;
  background-color: #a18cd1;

}
button {
  background-color: #8b7355;
  color: white;
  padding: 0.8rem 1.2rem;
  margin-bottom: 1rem;
  cursor: pointer;
  align-items: center;
  text-align: center;
  border-radius: 2.5rem;
  border: none;
  outline:none;
}

.group-badge {
  background-color: white;
  color: #8b7355;
  padding: 15px;
  border-style:dashed ;
  border-radius: 8px;
  margin-top: 20px;
  font-size: 20px;
  font-weight: bold;
}
.username {
  color: #333;
  margin-bottom: 20px;
}
.group-members {
  background-color: #f1f1f1;
  border-radius: 8px;
  padding: 15px;
  margin-top: 15px;
  text-align: left;
}
.group-members h3 {
  margin-top: 0;
  color: #8b7355;
  border-bottom: 2px solid #a18cd1;
  padding-bottom: 5px;
}
.member-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
.member-list li {
  padding: 5px 0;
  border-bottom: 1px solid #ddd;
}
.member-list li:last-child {
  border-bottom: none;
}

.mypage {
  background-color: #a18cd1;
  color: white;
  width: 60%;
  padding: 1rem;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  font-size: 1rem;
  margin: 0.5rem 0;
  transition: opacity 0.3s;
}
</style>
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