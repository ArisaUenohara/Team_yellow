<?php

require_once('config.php');

session_start();

//POSTのvalidate
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  echo '入力された値が不正です。';
  return false;
}
//DB内でPOSTされたメールアドレスを検索
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('select * from userData2 where email = ?');
  $stmt->execute([$_POST['email']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

// ユーザー情報が取得できたか確認
echo '<pre>';
print_r($row);
echo '</pre>';

//emailがDB内に存在しているか確認
if (!isset($row['email'])) {
  echo 'メールアドレス又はパスワードが間違っています。';
  return false;
}
// パスワード確認後sessionにメールアドレスを渡す
if (password_verify($_POST['password'], $row['password'])) {
  session_regenerate_id(true); // session_idを新しく生成し、置き換える
  $_SESSION['EMAIL'] = $row['email'];
  $_SESSION['ID'] = $row['id']; //サーバーからidを保存できないかな・・？
  $_SESSION['NAME']=$row['name'];//サーバーからidを保存
  $_SESSION['IS_ADMIN'] = $row['is_admin']; // is_admin情報をセッションに保存

  echo 'ログインしました';

  // 管理者か一般ユーザーかを判定してリダイレクト
  if ($row['is_admin'] == 1) {
    header('Location: adminpage.php'); // 管理者ページにリダイレクト
  } else {
    header('Location: mypage.php'); // 一般ユーザーの診断ページにリダイレクト
  }
  exit;
} else {
  echo 'メールアドレス又はパスワードが間違っています。';
  return false;
}
?>
