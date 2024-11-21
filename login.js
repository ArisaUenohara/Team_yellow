function login() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    fetch("/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.role === "admin") {
            window.location.href = `/admin_dashboard.html`;
        } else if (data.role === "user") {
            window.location.href = `/survey.html?classID=${data.classID}`;
        } else {
            document.getElementById("message").textContent = "ログイン失敗";
        }
    })
    .catch(error => {
        document.getElementById("message").textContent = "エラーが発生しました";
        console.error("Error:", error);
    });

    return false;  // フォーム送信の防止
}
