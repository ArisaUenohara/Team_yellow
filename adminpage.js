// script.js

// ダミーデータ: 実際にはユーザーの診断結果をデータベースから取得
const users = [
  { name: "ユーザーA", type: "A" },
  { name: "ユーザーB", type: "B" },
  { name: "ユーザーC", type: "A" },
  { name: "ユーザーD", type: "B" },
  { name: "ユーザーE", type: "C" },
  { name: "ユーザーF", type: "C" },
  { name: "ユーザーG", type: "D" },
  { name: "ユーザーH", type: "D" },
  { name: "ユーザーI", type: "A" },
  { name: "ユーザーJ", type: "B" },
];

// ユーザー結果を表示
function displayUserResults() {
  const tbody = document.querySelector("#userResults tbody");
  tbody.innerHTML = ""; // 表をクリア

  users.forEach(user => {
    const row = document.createElement("tr");
    const nameCell = document.createElement("td");
    const typeCell = document.createElement("td");

    nameCell.textContent = user.name;
    typeCell.textContent = user.type;

    row.appendChild(nameCell);
    row.appendChild(typeCell);
    tbody.appendChild(row);
  });
}

// グループ分け
function createGroups() {
  const groups = { A: [], B: [], C: [], D: [] };

  // ユーザーをタイプごとに分類
  users.forEach(user => {
    groups[user.type].push(user);
  });

  // 4人組にするため、タイプごとのユーザーをシャッフル
  const groupResults = [];
  Object.keys(groups).forEach(type => {
    const typeUsers = groups[type];
    while (typeUsers.length > 0) {
      const group = typeUsers.splice(0, 4); // 4人組
      groupResults.push(group);
    }
  });

  // グループ結果を表示
  displayGroupResults(groupResults);
}

// グループ結果を表示
function displayGroupResults(groupResults) {
  const tbody = document.querySelector("#groupResults tbody");
  tbody.innerHTML = ""; // 表をクリア

  groupResults.forEach((group, index) => {
    const row = document.createElement("tr");
    const groupCell = document.createElement("td");
    const membersCell = document.createElement("td");

    groupCell.textContent = `グループ ${index + 1}`;
    membersCell.textContent = group.map(user => user.name).join(", ");

    row.appendChild(groupCell);
    row.appendChild(membersCell);
    tbody.appendChild(row);
  });
}

// グループ結果を公開
function publishResults() {
  alert("グループ分け結果が公開されました！");
}

// 初期表示
displayUserResults();

// イベントリスナー
document.getElementById("createGroupsBtn").addEventListener("click", createGroups);
document.getElementById("publishResultsBtn").addEventListener("click", publishResults);
