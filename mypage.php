<!DOCTYPE html>
<html lang="ja">
  <link rel="stylesheet" href="mypage.css">
    <meta charset="UTF-8">
    <title>マイページ</title>
    
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

      resultButton.addEventListener('click', () => navigateTo('result.php'));
        groupButton.addEventListener('click', () => navigateTo('grouping.php'));
        judgeButton.addEventListener('click', () => navigateTo('judge.php'));
  </script>
</body>
</html>
