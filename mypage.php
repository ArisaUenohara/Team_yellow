<?php
session_start();
// セッションからユーザー情報を取得
if (!isset($_SESSION['EMAIL'])) {
    // ログインしていない場合、ログインページにリダイレクト
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <style>
        
      body {
    width:100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0;
    background-color: #faf7f2;
    min: height 100vh;
}
.title {
    position:center;
    margin-top:100px;
    top: 100px;
    left: 20px;
    font-size: 24px;
    font-weight: bold;
    
}
.button-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 30px;
    align-items: center;
    width:100%;
    max-width:400px;
    text-align:center;
}
.button {
    width: 250px;
    padding: 15px;
    font-size: 18px;
    background-color: #8b7355;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button2{
    background-color: #8b7355;
            color: white;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            margin: 2rem 0;
            transition: opacity 0.3s;
        }
</style>
</head>
<body>
    <div class="title">マイページ</div>
    
    <div class="button-container">
      <button class="button" onclick="location.href ='con-result.php'">結果</button>
      <button class="button" onclick="location.href ='grouping.php'">グループ分け</button>
      <button class="button" onclick="location.href ='judge.php'">診断ページ</button>
      <button class="button2" onclick="location.href ='logout.php'">ログアウト</button>
  </div>
</body>
</html>