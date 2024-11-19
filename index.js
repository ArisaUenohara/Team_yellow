

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