

document.addEventListener("DOMContentLoaded", () => {
  const questions = document.querySelectorAll(".choose_box > div");
  const links = document.querySelectorAll(".btn");

  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = link.getAttribute("href").replace("#", "");

      questions.forEach(question => {
        question.classList.remove("active");
      });

      const target = document.getElementById(targetId);
      if (target) target.classList.add("active");
    });
  });
});
//選択肢を選んだら今のページを表示オフにし次のページを表示する

document.querySelectorAll('.before').forEach(button => {
  button.addEventListener('click', function(event) {
    event.preventDefault(); // デフォルトのリンク動作をキャンセル
    const currentPage = document.querySelector('.choose_box .active');
    const targetPage = document.querySelector(button.getAttribute('href'));
    currentPage.classList.remove('active'); // 現在のページのactiveクラスを削除
    targetPage.classList.add('active'); // 目標ページにactiveクラスを追加
  });
});
//前のページに戻る

document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll(".btn");

  // スコアを記録するオブジェクト
  const score = {
    a: 0,
    b: 0,
    c: 0,
    d: 0,
  };

  let currentQuestionIndex = 0; // 現在の質問番号
  const questions = document.querySelectorAll(".choose_box > div");

  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      // 回答のスコアを更新
      const dataValue = link.getAttribute("data_value");
      if (dataValue && score.hasOwnProperty(dataValue)) {
        score[dataValue]++;
      }

      // 現在の質問を非表示
      questions[currentQuestionIndex].classList.remove("active");
      currentQuestionIndex++;

      if (currentQuestionIndex < questions.length) {
        // 次の質問を表示
        questions[currentQuestionIndex].classList.add("active");
      } else {
        // 全ての質問が終了した場合、結果ページへ移動
        redirectToResult(score);
      }
    });
  });

  function redirectToResult(score) {
    // 最大スコアのタイプを判定
    const maxType = Object.keys(score).reduce((a, b) => score[a] > score[b] ? a : b);

    // URLパラメータを生成して結果ページへ移動
    const params = new URLSearchParams();
    params.set("result", maxType);

    // 結果ページのHTMLファイルにリダイレクト
    window.location.href = `result.html?${params.toString()}`;
  }
});