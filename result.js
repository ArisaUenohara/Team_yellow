// URLパラメータから結果タイプを取得
const params = new URLSearchParams(window.location.search);
const resultType = params.get("result");

// ローカルストレージからuserClassを取得
const userClass = localStorage.getItem("userClass");

// PHPセッションからのデータを埋め込み
const userId = USER_ID;       // PHPで埋め込まれたセッションのUSER_ID
const userEmail = EMAIL;      // PHPで埋め込まれたセッションのEMAIL

// 結果に応じたメッセージを定義
const results = {
    "a": {
        title: "炎タイプ",
        description: "あなたは情熱的でリーダーシップに優れたタイプです！"
    },
    "b": {
        title: "クールタイプ",
        description: "あなたは冷静で効率を重視する実行者タイプです。"
    },
    "c": {
        title: "雰囲気タイプ",
        description: "あなたは周囲の状況に気を配る調整役です！"
    },
    "d": {
        title: "省エネタイプ",
        description: "必要最低限の努力で結果を出すスマートなタイプです！"
    }
};

// 結果を表示
if (resultType && results[resultType]) {
    document.getElementById("result_title").textContent = results[resultType].title;
    document.getElementById("result-description").textContent = results[resultType].description;

    // サーバにデータを送信
    if (userClass && userId && userEmail) { // 必須データが揃っている場合のみ送信
        fetch("result.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                userClass,
                userId,
                userName: localStorage.getItem("userName"), // userNameはローカルストレージから取得
                userEmail,
                resultType
            })
        })
        .then(response => response.text())
        .then(data => {
            console.log("サーバの応答:", data);
        })
        .catch(error => {
            console.error("サーバ送信エラー:", error);
        });
    } else {
        console.error("ユーザーデータが不足しています。");
    }
} else {
    document.getElementById("result-title").textContent = "結果が見つかりません";
    document.getElementById("result-description").textContent = "正しいURLからアクセスしてください。";
}
