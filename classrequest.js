function createClassCode() {
    const classCode = document.getElementById("class_code").value;

    fetch("/create_class_code", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ class_code: classCode }),
    })
        .then((response) => response.json())
        .then((data) => {
            const messageElement = document.getElementById("message");
            if (data.error) {
                messageElement.textContent = `エラー: ${data.error}`;
            } else {
                messageElement.textContent = data.message;
                updateClassCodeList(); // リストを更新
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            document.getElementById("message").textContent = "エラーが発生しました。";
        });

    return false; // フォームのリロードを防ぐ
}

function updateClassCodeList() {
    fetch("/get_class_codes")
        .then((response) => response.json())
        .then((data) => {
            const listElement = document.getElementById("classCodeList");
            listElement.innerHTML = "";
            data.class_codes.forEach((code) => {
                const listItem = document.createElement("li");
                listItem.textContent = code;
                listElement.appendChild(listItem);
            });
        });
}
