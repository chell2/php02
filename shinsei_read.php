<?php

// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

// DB接続情報
$dbn = 'mysql:dbname=agusys;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
	$pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
	echo json_encode(["db error" => "{$e->getMessage()}"]);
	exit();
}

// データ参照
$sql = 'SELECT * FROM flood_damage_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();   // $statusにSQLの実行結果が入る(まだ取得したデータではない)

if ($status == false) {
	$error = $stmt->errorInfo();    // 失敗した時のエラー表示
	exit('sqlError:' . $error[2]);
} else {
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);    // fetchAllで全データ取得
	$output = "";
	foreach ($result as $record) {
		$output .= "<tr>";
		$output .= "<td>{$record["id"]}</td>";
		$output .= "<td>{$record["cause"]}</td>";
		$output .= "<td>{$record["jaBranch"]}</td>";
		$output .= "<td>{$record["reqName"]}</td>";
		$output .= "<td>{$record["kana"]}</td>";
		$output .= "<td>{$record["birth"]}</td>";
		$output .= "<td>{$record["zip"]}</td>";
		$output .= "<td>{$record["addr"]}</td>";
		$output .= "<td>{$record["tel"]}</td>";
		$output .= "<td>{$record["email"]}</td>";
		$output .= "<td>{$record["item"]}</td>";
		$output .= "<td>{$record["fieldAddr"]}</td>";
		$output .= "<td>{$record["fieldArea"]}</td>";
		$output .= "<td>{$record["levels"]}</td>";
		$output .= "<td>{$record["damages"]}</td>";
		$output .= "<td>{$record["amounts"]}</td>";
		$output .= "<td>{$record["memo"]}</td>";
		$output .= "</tr>";
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>申請一覧</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
		}

		p {
			color: #666;
			font-size: 1.2rem;
			text-align: center;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			font-size: .8rem;
		}

		table th,
		table td {
			padding: 10px 0;
			text-align: center;
		}

		table tr:nth-child(odd) {
			background-color: #eee
		}
	</style>
</head>

<body>
	<main>
		<p>////////////// 申請一覧 //////////////</p>
		<div>
			<table>
				<!-- ↓に<tr><td>...</td><tr>の形でデータが入る -->
				<?= $output ?>
			</table>
		</div>
	</main>
</body>

</html>