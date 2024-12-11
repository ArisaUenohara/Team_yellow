 // URLパラメータから結果タイプを取得
 const params = new URLSearchParams(window.location.search);
 const resultType = params.get("result");
 console.log(resultType)

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
  console.log(results[resultType].title)
   document.getElementById("result_title").textContent = results[resultType].title;
   document.getElementById("result-description").textContent = results[resultType].description;
 } else {
   document.getElementById("result-title").textContent = "結果が見つかりません";
   document.getElementById("result-description").textContent = "正しいURLからアクセスしてください。";
 }