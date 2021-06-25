<?php

function dbc()
{
	// DB接続情報
	$host = "localhost";
	$dbname = "agusys";
	$user = "root";
	$psw = "";

	$dns = "mysql:host=$host;dbname=$dbname;charset=utf8";

	// DB起動しない例外をキャッチする
	try {
		$pdo = new PDO(
			$dns,
			$user,
			$psw,
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]
		);
		echo "成功!";
		return $pdo;
	} catch (PDOException $e) {
		exit($e->getMessage());
	}
}
// dbc();


/*-----
* ファイルデータを保存する関数を定義
* @pram string $filename ファイル名
* @param string $save_path 保存先のパス
* @param string $caption 投稿の説明
* @return bool $result
*-----*/

function fileSave($filename, $save_path, $caption)
{
	$result = False;

	$sql = "INSERT INTO flood_damage_image_table(file_name, file_path,
	caption) VALUE (?, ?, ?)";     // ???の中身は次のbind関数で設定
	try {
		$stmt = dbc()->prepare($sql);  // 準備
		$stmt->bindValue(1, $filename);
		$stmt->bindValue(2, $save_path);
		$stmt->bindValue(3, $caption);
		$result = $stmt->execute();    // executeで実行、
		return $result;                // returnで成功trueか失敗falseを返す
	} catch (\Exception $e) {
		echo $e->getMessage();         // エラーメッセージは本来はログに出力
		return $result;
	}
}
