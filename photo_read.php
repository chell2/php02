<?php
require_once "./photo_dbc.php";
$files = getAllFile();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>写真一覧</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
			width: 97%;
		}

		p {
			color: #666;
			font-size: 1.2rem;
			text-align: center;
		}

		img {
			width: 300px;
			height: auto;
		}
	</style>
</head>

<body>
	<main>
		<p>////////////// 写真一覧 //////////////</p>

		<div>
			<?php foreach ($files as $file) : ?>
				<img src="<?php echo "{$file['file_path']}"; ?>" alt="">
				<?php echo h("{$file['caption']}"); ?>
				<?php echo h(" / {$file['file_name']}"); ?>
			<?php endforeach; ?>
		</div>
	</main>

</body>

</html>