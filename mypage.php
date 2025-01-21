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
        font-family: Arial, sans-serif;
            background-color: #faf7f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
}
.mypage-card {
    background-color: white;
            padding: 2rem;
            border-radius: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 380px;
            text-align: center;
}
.title {
    color: #8b7355;
            font-size: 2.5rem;
            margin-bottom: 2.5rem;
            font-weight: bold;
    
}
h2:before {
    content: url("bear.png");
    margin-right:20px;


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
.button:hover {
            opacity: 0.9;
        } 
.button2 {
    width: 250px;
    padding: 15px;
    font-size: 18px;
    background-color: #a18cd1;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}   
.button2:hover {
            opacity: 0.9;
        } 

</style>
</head>
<body>
  <div class="mypage-card">
     <h2 class="title">MyPage</h2>
    
     <div class="button-container">
       <button class="button" onclick="location.href ='con-result.php'">結果</button>
       <button class="button" onclick="location.href ='grouping.php'">グループ分け</button>
       <button class="button" onclick="location.href ='judge.php'">診断ページ</button>
       <button class="button2" onclick="location.href ='logout.php'">ログアウト</button>
    </div>
  </div>
</body>
</html>