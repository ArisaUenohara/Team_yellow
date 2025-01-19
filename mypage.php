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
    background-color: #f4f4f4;
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
.button:hover {
    background-color: #8b7355;
}
.button:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
}
.buttton{
    background-color: #8b7355;
            color: white;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            margin: 0.5rem 0;
            transition: opacity 0.3s;
            opacity:0.3;
        }
        .buttton:hover {
            opacity: 1.0;
        }
        .button-group {
            gap: 1rem;
            margin-top: 1rem;
        }
 
        .button-group .button {
            flex: 1;
            margin: 0;
        }
.class-input-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
}
.class-input {
    padding: 10px;
    font-size: 16px;
    width: 200px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.error-message {
    color: red;
    font-size: 14px;
    margin-top: 10px;
    text-align: center;
}
</style>
</head>
<body>
    <div class="title">マイページ</div>
    
    <div class="button-container">
      <button id="resultButton" class="button" disabled>結果</button>
      <button id="groupButton" class="button" disabled>グループ分け</button>
      <button id="judgeButton" class="button" disabled>診断ページ</button>
      
      <div class="class-input-container">
          <label for="classInput">クラスを入力してください：</label>
          <input type="text" id="classInput" class="class-input" placeholder="クラス名を入力">
          <div id="errorMessage" class="error-message"></div>
      </div>
      <button class="buttton" onclick="location.href ='logout.php'">ログアウト</button>
  </div>
  <script>
      const classInput = document.getElementById('classInput');
      const resultButton = document.getElementById('resultButton');
      const groupButton = document.getElementById('groupButton');
      const judgeButton = document.getElementById('judgeButton');
      const errorMessage = document.getElementById('errorMessage');
      classInput.addEventListener('input', function() {
          const classValue = this.value.trim();
          
          if (classValue) {
              resultButton.disabled = false;
              groupButton.disabled = false;
              judgeButton.disabled = false;
              errorMessage.textContent = '';
          } else {
              resultButton.disabled = true;
              groupButton.disabled = true;
              judgeButton.disabled = true;
          }
      });
      function navigateTo(page) {
          const classValue = classInput.value.trim();
          
          if (!classValue) {
              errorMessage.textContent = 'クラス名を入力してください！';
              return;
          }
          
          localStorage.setItem('userClass', classValue);
          window.location.href = page;
      }
      resultButton.addEventListener('click', () => navigateTo('con-result.php'));
        groupButton.addEventListener('click', () => navigateTo('grouping.php'));
        judgeButton.addEventListener('click', () => navigateTo('judge.php'));
  </script>
</body>
</html>