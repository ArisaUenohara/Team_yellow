<script>
  // クラス名をlocalStorageから取得
const userClass = localStorage.getItem('userClass');

if (userClass) {
    // クラス名が存在する場合
    console.log(`クラス名: ${userClass}`); // コンソールに表示
} else {
    // クラス名が保存されていない場合
    console.log('クラス名が保存されていません。');
}
</script>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="judge.css">
  <script src="judge.js"></script>
</head>
<title>グループ分け診断</title>

<body>
  <header>
  </header>
  <div id="output"></div>
  <div class="choose_box">
    <div id="q_1" class="active">
      <h3>1</h3>
      <!-- 質問番号 -->
      <h4>グループ活動に参加する際、あなたが優先するのは何ですか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_2" data_value="a炎">チームをリードし、結果の達成を確保する</a>
        </li>
        <li>
          　<a class="btn" href="#q_2" data_value="bクール">効率よく分担して個人のタスクをこなす</a>
        </li>
        <li>
          　<a class="btn" href="#q_2" data_value="c雰囲気">他のメンバーを見て、自分の関わり方を決める</a>
        </li>
        <li>
          　<a class="btn" href="#q_2" data_value="d省エネ">自分の担当部分を終わらせるだけで、あまり干渉しない</a>
        </li>
      </ul>
    </div>

    <div id="q_2">
      <h3>2</h3>
      <!-- 質問番号 -->
      <h4>新しいグループプロジェクトを確認した時、あなたの気持ちはどうなりますか</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_3" data_value="c雰囲気">柔軟な </a>
        </li>
        <li>
          　<a class="btn" href="#q_3" data_value="bクール">冷静な </a>
        </li>
        <li>
          　<a class="btn" href="#q_3" data_value="d省エネ">気にしない</a>
        </li>
        <li>
          　<a class="btn" href="#q_3" data_value="a炎">ワクワクした</a>
        </li>
      </ul>
      <a class="before" href="#q_1">前のページに戻る</a>
    </div>

    <div id="q_3">
      <h3>3</h3>
      <!-- 質問番号 -->
      <h4>チームメンバーの進捗が遅れているとき、あなたはどうしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_4" data_value="d省エネ">チームの進捗に関しては関係ないと思う</a>
        </li>
        <li>
          　<a class="btn" href="#q_4" data_value="bクール">自分のタスクに集中し、期限通りに終わらせる</a>
        </li>
        <li>
          　<a class="btn" href="#q_4" data_value="a炎">督促して、必要なら助けて、スピードを上げる</a>
        </li>
        <li>
          　<a class="btn" href="#q_4" data_value="c雰囲気">状況を見て（ex.自分に余裕がある時）、手助けする </a>
        </li>
      </ul>
      <a class="before" href="#q_2">前のページに戻る</a>
    </div>

    <div id="q_4">
      <h3>4</h3>
      <!-- 質問番号 -->
      <h4>チームでの自分の理想的な役割は何だと思いますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_5" data_value="a炎">チームのリーダーまたは推進者</a>
        </li>
        <li>
          　<a class="btn" href="#q_5" data_value="c雰囲気">雰囲気を調整し、チームの感情に合わせる調整役</a>
        </li>
        <li>
          　<a class="btn" href="#q_5" data_value="d省エネ">必要最低限のタスクに絞って関わり、周囲のサポートを期待する</a>
        </li>
        <li>
          　<a class="btn" href="#q_5" data_value="bクール">自分の役割に責任を持ち、効率よく確実に担当部分をこなす実行者</a>
        </li>
      </ul>
      <a class="before" href="#q_3">前のページに戻る</a>
    </div>

    <div id="q_5">
      <h3>5</h3>
      <!-- 質問番号 -->
      <h4>プロジェクトの困難に直面した時、あなたはどうしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_6" data_value="d省エネ">できるだけシンプルに対処し、自分の部分を終える</a>
        </li>
        <li>
          　<a class="btn" href="#q_6" data_value="c雰囲気">皆と相談して、適切なリズムを探る</a>
        </li>
        <li>
          　<a class="btn" href="#q_6" data_value="bクール">自分で解決し、効率を維持する</a>
        </li>
        <li>
          　<a class="btn" href="#q_6" data_value="a炎">チームを励まし、困難を乗り越えるよう促す</a>
        </li>
      </ul>
      <a class="before" href="#q_4">前のページに戻る</a>
    </div>

    <div id="q_6">
      <h3>6</h3>
      <!-- 質問番号 -->
      <h4>好きなチーム内でのコミュニケーションスタイルは？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_7" data_value="c雰囲気">和やかな雰囲気で適度な共有</a>
        </li>
        <li>
          　<a class="btn" href="#q_7" data_value="d省エネ">簡単な報告と早く終わる会話</a>
        </li>
        <li>
          　<a class="btn" href="#q_7" data_value="a炎">活発な意見交換</a>
        </li>
        <li>
          　<a class="btn" href="#q_7" data_value="bクール">簡潔で明確なタスク分配</a>
        </li>
      </ul>
      <a class="before" href="#q_5">前のページに戻る</a>
    </div>

    <div id="q_7">
      <h3>7</h3>
      <!-- 質問番号 -->
      <h4>チームの最終目標は何だと思いますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_8" data_value="bクール">各自の役割分担を活かして、効率よく目標を達成すること</a>
        </li>
        <li>
          　<a class="btn" href="#q_8" data_value="a炎">チーム全体で最高の成果を出すこと</a>
        </li>
        <li>
          　<a class="btn" href="#q_8" data_value="d省エネ">とりあえず提出できる形にすること</a>
        </li>
        <li>
          　<a class="btn" href="#q_8" data_value="c雰囲気">チームの雰囲気を保ちながら、無理のない範囲で結果を出すこと</a>
        </li>
      </ul>
      <a class="before" href="#q_6">前のページに戻る</a>
    </div>

    <div id="q_8">
      <h3>8</h3>
      <!-- 質問番号 -->
      <h4>会議中、あなたはどのように行動しますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_9" data_value="a炎">積極的に自分の意見を述べる</a>
        </li>
        <li>
          　<a class="btn" href="#q_9" data_value="c雰囲気">チームの議論の雰囲気に従う</a>
        </li>
        <li>
          　<a class="btn" href="#q_9" data_value="bクール">積極的にタスクを分担し、専念する</a>
        </li>
        <li>
          　<a class="btn" href="#q_9" data_value="d省エネ">静かに聞き、割り当てられた通りに行動する</a>
        </li>
        <a class="before" href="#q_7">前のページに戻る</a>
    </div>

    <div id="q_9">
      <h3>9</h3>
      <!-- 質問番号 -->
      <h4>タスクの完了が予定より早まった場合、あなたはどうしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_10" data_value="bクール">自分のタスクの細部を確認する</a>
        </li>
        <li>
          　<a class="btn" href="#q_10" data_value="d省エネ">早めに切り上げて他の事をする</a>
        </li>
        <li>
          　<a class="btn" href="#q_10" data_value="c雰囲気">みんなとリラックスして交流する</a>
        </li>
        <li>
          　<a class="btn" href="#q_10" data_value="a炎">改善策があれば、提案する</a>
        </li>
      </ul>
      <a class="before" href="#q_8">前のページに戻る</a>
    </div>

    <div id="q_10">
      <h3>10</h3>
      <!-- 質問番号 -->
      <h4>割り当てられたタスクが少ない場合、あなたの反応は？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_11" data_value="d省エネ">割り当てられた分だけこなす</a>
        </li>
        <li>
          　<a class="btn" href="#q_11" data_value="c雰囲気">チームの雰囲気に応じて調整する</a>
        </li>
        <li>
          　<a class="btn" href="#q_11" data_value="a炎">もっとタスクを追加することを提案する</a>
        </li>
        <li>
          　<a class="btn" href="#q_11" data_value="bクール">現在のタスクに集中する</a>
        </li>
      </ul>
      <a class="before" href="#q_9">前のページに戻る</a>
    </div>

    <div id="q_11">
      <h3>11</h3>
      <!-- 質問番号 -->
      <h4>意見の相違が生じた場合、あなたはどうしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_12" data_value="a">みんなにとって有益な案を探し出すよう努める</a>
        </li>
        <li>
          　<a class="btn" href="#q_12" data_value="b">効率的な解決策を探す</a>
        </li>
        <li>
          　<a class="btn" href="#q_12" data_value="c">チームの大多数の意見に従う</a>
        </li>
        <li>
          　<a class="btn" href="#q_12" data_value="d">争いを避け（特に何も言わず）、最終的な意見に従う</a>
        </li>
      </ul>
      <a class="before" href="#q_10">前のページに戻る</a>
    </div>

    <div id="q_12">
      <h3>12</h3>
      <!-- 質問番号 -->
      <h4>仕事を始める時、あなたはどのようにしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_13" data_value="b">効率的に分担し、個人タスクを実行する</a>
        </li>
        <li>
          　<a class="btn" href="#q_13" data_value="c">チームのペースに合わせてゆっくり適応する</a>
        </li>
        <li>
          　<a class="btn" href="#q_13" data_value="d">落ち着いて開始し、徐々に終わらせる</a>
        </li>
        <li>
          　<a class="btn" href="#q_13" data_value="a">迅速に取り組み、他者を奮い立たせる</a>
        </li>
      </ul>
      <a class="before" href="#q_11">前のページに戻る</a>
    </div>

    <div id="q_13">
      <h3>13</h3>
      <!-- 質問番号 -->
      <h4>仕事がほぼ終わった時、あなたの優先事項は？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_14" data_value="c">メンバーに合わせる</a>
        </li>
        <li>
          　<a class="btn" href="#q_14" data_value="b">自分のタスクにミスがないか確認する</a>
        </li>
        <li>
          　<a class="btn" href="#q_14" data_value="d">早めに終える</a>
        </li>
        <li>
          　<a class="btn" href="#q_14" data_value="a">もう少し努力して、最高の成果を目指す</a>
        </li>
      </ul>
      <a class="before" href="#q_12">前のページに戻る</a>
    </div>

    <div id="q_14">
      <h3>14</h3>
      <!-- 質問番号 -->
      <h4>知らない人と一緒に仕事するとき、あなたはどうしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_15" data_value="b">自分に割り当てられらタスクに専念する</a>
        </li>
        <li>
          　<a class="btn" href="#q_15" data_value="a">積極的に協力し、目標を共有する</a>
        </li>
        <li>
          　<a class="btn" href="#q_15" data_value="d">控えめに行動し、タスクを終わらせる</a>
        </li>
        <li>
          　<a class="btn" href="#q_15" data_value="c">他者のぺ―スを観察して、自分を調整する</a>
        </li>
      </ul>
      <a class="before" href="#q_13">前のページに戻る</a>
    </div>

    <div id="q_15">
      <h3>15</h3>
      <!-- 質問番号 -->
      <h4>タスクが多くて忙しい時、あなたの反応は？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_16" data_value="c">他のメンバーの様子を見ながら、自分のペースを調整する</a>
        </li>
        <li>
          　<a class="btn" href="#q_16" data_value="a">チームを鼓舞して、ペースを上げる</a>
        </li>
        <li>
          　<a class="btn" href="#q_16" data_value="b">時間を効率的に使って自分の仕事を終わらせる</a>
        </li>
        <li>
          　<a class="btn" href="#q_16" data_value="d">できるだけ努力し、無理のない範囲で行う</a>
        </li>
      </ul>
      <a class="before" href="#q_14">前のページに戻る</a>
    </div>

    <div id="q_16">
      <h3>16</h3>
      <!-- 質問番号 -->
      <h4>チームで最も重要だと思うのは何ですか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_17" data_value="a">結果と達成感</a>
        </li>
        <li>
          　<a class="btn" href="#q_17" data_value="c">チームの和やかな雰囲気</a>
        </li>
        <li>
          　<a class="btn" href="#q_17" data_value="b">効率と分担</a>
        </li>
        <li>
          　<a class="btn" href="#q_17" data_value="d">割り当てられたタスクの完遂</a>
        </li>
      </ul>
      <a class="before" href="#q_15">前のページに戻る</a>
    </div>

    <div id="q_17">
      <h3>17</h3>
      <!-- 質問番号 -->
      <h4>チームに人手がもっと必要な時、あなたはどうしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_18" data_value="d">自分に割り当てられたタスクを完了する</a>
        </li>
        <li>
          　<a class="btn" href="#q_18" data_value="b">タスクを再分配し、効率を確保する</a>
        </li>
        <li>
          　<a class="btn" href="#q_18" data_value="a">自分の時間を使って、解決策を見つける</a>
        </li>
        <li>
          　<a class="btn" href="#q_18" data_value="c">他のメンバーと協力して、どのように貢献できるかを考える</a>
        </li>
      </ul>
      <a class="before" href="#q_16">前のページに戻る</a>
    </div>

    <div id="q_18">
      <h3>18</h3>
      <!-- 質問番号 -->
      <h4>仕事の進行方法について、あなたが好きなのは？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_19" data_value="c">柔軟に変化し、チームのニーズに応えること</a>
        </li>
        <li>
          　<a class="btn" href="#q_19" data_value="a">新しい方法を探求し、革新すること</a>
        </li>
        <li>
          　<a class="btn" href="#q_19" data_value="b">シンプルで明確なタスク構造</a>
        </li>
        <li>
          　<a class="btn" href="#q_19" data_value="d">規定のプロセスに従って進めること</a>
        </li>
      </ul>
      <a class="before" href="#q_17">前のページに戻る</a>
    </div>

    <div id="q_19">
      <h3>19</h3>
      <!-- 質問番号 -->
      <h4>タスクの目標が変わった場合、あなたの反応は？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" href="#q_20" data_value="b">再度タスクを分析し、分配し直す</a>
        </li>
        <li>
          　<a class="btn" href="#q_20" data_value="d">変化に従い、あまり干渉しない</a>
        </li>
        <li>
          　<a class="btn" href="#q_20" data_value="c">チームの意向を見て、自分の行動を決める</a>
        </li>
        <li>
          　<a class="btn" href="#q_20" data_value="a">積極的に調整し、みんなを適応させる</a>
        </li>
      </ul>
      <a class="before" href="#q_18">前のページに戻る</a>
    </div>

    <div id="q_20">
      <h3>20</h3>
      <!-- 質問番号 -->
      <h4>臨時に新しいタスクが追加された場合、あなたはどうしますか？</h4>
      <!-- 質問 -->
      <ul>
        <li>
          　<a class="btn" data_value="d">元の計画に影響がなければ実行する</a>
        </li>
        <li>
          　<a class="btn" data_value="a">積極的にタスクを引き受け、進度を上げる</a>
        </li>
        <li>
          　<a class="btn"  data_value="b">時間を再計画して、効率を確保する</a>
        </li>
        <li>
          　<a class="btn"  data_value="c">チームの状況を見て、取り組むか判断する</a>
        </li>
      </ul>
      <a class="before" href="#q_19">前のページに戻る</a>
    </div>
  </div>


  <footer>
  </footer>
</body>

</html>