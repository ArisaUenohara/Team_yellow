// 必要に応じてJavaScriptでクライアントサイドの動きを強化します
document.getElementById('class-form').addEventListener('submit', function (e) {
    const classInput = document.getElementById('class-input').value;
    if (!classInput) {
        alert('クラス名を入力してください');
        e.preventDefault();
    }
});
