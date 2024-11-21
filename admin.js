function fetchResponses() {
    const classID = document.getElementById("classSelect").value;
    const responseList = document.getElementById("response-list");

    fetch(`/responses?classID=${classID}`)
        .then(response => response.json())
        .then(data => {
            responseList.innerHTML = "";
            if (data.length === 0) {
                responseList.innerHTML = "<p>このクラスには回答がありません。</p>";
            } else {
                data.forEach(response => {
                    const item = document.createElement("p");
                    item.textContent = `ユーザー: ${response.user}, 回答: ${response.answer}`;
                    responseList.appendChild(item);
                });
            }
        })
        .catch(error => {
            responseList.innerHTML = "<p>データの取得に失敗しました。</p>";
            console.error("Error fetching data:", error);
        });
}
