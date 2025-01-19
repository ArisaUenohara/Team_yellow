document.addEventListener("DOMContentLoaded", () => {
  const questions = document.querySelectorAll(".choose_box > div");
  const links = document.querySelectorAll(".btn");
  const backLinks = document.querySelectorAll(".before");

  let currentQuestionIndex = 0; // 現在の質問番号

  // 質問をリセットして非表示にする
  function resetQuestions() {
    questions.forEach(question => {
      question.classList.remove("active");
    });
  }

  // 次のページへの移動処理
  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      // 回答のスコアを更新
      const dataValue = link.getAttribute("data_value");

      // 現在の質問を非表示
      resetQuestions();

      // 次の質問を表示
      currentQuestionIndex++;
      if (currentQuestionIndex < questions.length) {
        questions[currentQuestionIndex].classList.add("active");
      } else {
        // 全ての質問が終了した場合、結果ページへ移動
        redirectToResult();
      }
    });
  });

  // 前のページへの移動処理
  backLinks.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      // 現在の質問を非表示
      resetQuestions();

      // 前の質問を表示
      if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        questions[currentQuestionIndex].classList.add("active");
      }
    });
  });

  // 結果ページへのスコア管理と遷移
  const score = {
    a: 0,
    b: 0,
    c: 0,
    d: 0,
  };

  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      // 回答のスコアを更新
      const dataValue = link.getAttribute("data_value");
      if (dataValue && score.hasOwnProperty(dataValue)) {
        score[dataValue]++;
      }
    });
  });

  function redirectToResult() {
    // 最大スコアのタイプを判定
    const maxType = Object.keys(score).reduce((a, b) => score[a] > score[b] ? a : b);

    // URLパラメータを生成して結果ページへ移動
    const params = new URLSearchParams();
    params.set("result", maxType);

    // 結果ページのHTMLファイルにリダイレクト
    window.location.href = `result.php?${params.toString()}`;
  }
});