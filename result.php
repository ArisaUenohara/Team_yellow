<?php
require_once('config.php');

session_start(); // セッションを開始

// セッションからデータを取得
$userId = $_SESSION['ID'] ?? null;
$email = $_SESSION['EMAIL'] ?? null;
$userName=$_SESSION['NAME'] ?? null;
// 必須データがない場合はエラー処理
if (!$userId || !$email) {
    die("セッション情報が不足しています。");
}

// POSTリクエストが来た場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userClass = $_POST['userClass'] ?? null;
    $resultType = $_POST['resultType'] ?? null;
    // 条件分岐で処理
switch ($resultType) {
    case 'a':
        $resultType= '炎';
        break;
    case 'b':
        $resultType= 'クール';
        break;
    case 'c':
        $resultType= '雰囲気';
        break;
    case 'd':
        $resultType= '省エネ';
        break;
    default:
    $resultType= '無効な値です'; // 予期しない値が来た場合の処理
        break;
}
    // 必須データが揃っているか確認
    if ($userClass && $resultType) {
        try {
          $pdo = new PDO(DSN, DB_USER, DB_PASS);
          // データを挿入するSQLクエリ
            $sql = "INSERT INTO type_result (user_id, class, name, email, result) VALUES (:user_id, :class, :name, :email, :result)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,            // セッションから取得
                ':class' => $userClass,      // POSTデータから取得
                ':name' => $userName,        // POSTデータから取得
                ':email' => $email,          // セッションから取得
                ':result' => $resultType,    // POSTデータから取得
            ]);

            $sql = "INSERT INTO class_group (user_id, class, name, email, result) VALUES (:user_id, :class, :name, :email, :result)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,            // セッションから取得
                ':class' => $userClass,      // POSTデータから取得
                ':name' => $userName,        // POSTデータから取得
                ':email' => $email,          // セッションから取得
                ':result' => $resultType,    // POSTデータから取得
            ]);
            echo "データが正常に挿入されました。";
        } catch (PDOException $e) {
            echo "データベースエラー: " . $e->getMessage();
        }
    } else {
        echo "必要なデータが不足しています。";
    }
    exit;
}
?>
  
<script>
// PHPの値をJavaScript変数に埋め込む
const USER_ID = <?php echo json_encode($userId); ?>;
const EMAIL = <?php echo json_encode($email); ?>;
</script>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="result.css">
  <script src="result.js" defer></script>
  <title>診断結果</title>
</head>
<body>
    <div class="login-card">
        <div class="title" id="result_title"></div>
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
        <p id="result-description"></p>   
    </div>
</body>
<button class="mypage" onclick="location.href ='mypage.php'">マイページ</button>

</html>