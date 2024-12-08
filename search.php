<?php
require_once('config.php');

session_start();

// 管理者チェック
if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN'] != 1) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // データベース接続
        $pdo = new PDO(DSN, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 検索クラスを取得
        if (!empty($_POST['class'])) {
            $class = htmlspecialchars($_POST['class'], ENT_QUOTES, 'UTF-8');

            // 該当クラスのデータを取得
            $stmt = $pdo->prepare("SELECT * FROM class_group WHERE class = :class ORDER BY result, id");
            $stmt->bindParam(':class', $class, PDO::PARAM_STR);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($students)) {
                $groupNumber = 1; // グループ番号の初期値
                $groupedStudents = [];

                // resultごとにデータをグループ化
                $studentsByResult = [];
                foreach ($students as $student) {
                    $result = $student['result'];
                    if (!isset($studentsByResult[$result])) {
                        $studentsByResult[$result] = [];
                    }
                    $studentsByResult[$result][] = $student;
                }

                 // グループ分けを4人ずつ行う
								 $groupQueue = []; // 残りのグループ待機者

								 // 各resultグループを4人ずつに分け、group_numberを割り当て
								 foreach ($studentsByResult as $resultGroup) {
										 // グループ内の人数が4人未満の場合は次のグループと組み合わせ
										 while (count($resultGroup) >= 4) {
												 // 4人ずつのグループに分けて割り当て
												 $group = array_splice($resultGroup, 0, 4);
												 foreach ($group as $student) {
														 $groupedStudents[] = [
																 'id' => $student['id'],
																 'group_number' => $groupNumber
														 ];
												 }
												 $groupNumber++;
										 }
 
										 // 4人未満の残りは待機リストに追加
										 if (count($resultGroup) > 0) {
												 $groupQueue = array_merge($groupQueue, $resultGroup);
										 }
								 }
 
								 // 待機リストから他のグループに加えて4人を作成
								 while (count($groupQueue) >= 4) {
										 $group = array_splice($groupQueue, 0, 4);
										 foreach ($group as $student) {
												 $groupedStudents[] = [
														 'id' => $student['id'],
														 'group_number' => $groupNumber
												 ];
										 }
										 $groupNumber++;
								 }
 
								 // 残りの人数が3人以下であれば、そのままグループに追加
								 if (count($groupQueue) > 0) {
										 $group = array_splice($groupQueue, 0);
										 foreach ($group as $student) {
												 $groupedStudents[] = [
														 'id' => $student['id'],
														 'group_number' => $groupNumber
												 ];
										 }
										 $groupNumber++;
								 }

                // データベースを更新
                $updateStmt = $pdo->prepare("UPDATE class_group SET group_number = :group_number WHERE id = :id");
                foreach ($groupedStudents as $student) {
                    $updateStmt->execute([
                        ':group_number' => $student['group_number'],
                        ':id' => $student['id']
                    ]);
                }

                echo "グループ分けが成功しました。";
                header("Location: adminpage.php?key=" . urlencode($class)); // 元のページにリダイレクト
                exit;
            } else {
                echo "該当するデータが見つかりません。";
            }
        } else {
            echo "クラス名が指定されていません。";
        }
    } catch (PDOException $e) {
        echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    }
} else {
    echo "無効なリクエストです。";
}
?>
