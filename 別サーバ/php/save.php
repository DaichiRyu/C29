<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
</head>
<body>
<?php
session_start();

if (!empty($_FILES["imgname"]["tmp_name"]) && is_uploaded_file($_FILES["imgname"]["tmp_name"])) {
	if (move_uploaded_file($_FILES["imgname"]["tmp_name"], "imgfiles/" . $_FILES["imgname"]["name"])) {
		chmod("imgfiles/" . $_FILES["imgname"]["name"], 0744);#linux用
	  
		#echo $_SESSION['filename'] . "をアップロードしました。";#アップロード確認用
	$_SESSION['filename'] = $_FILES["imgname"]["name"];
	header('Location: result.php');

?>
 <br>
<button type="submit" onclick="location.href='result.php'">削除</button>
<?php
	} else {
	  echo "ファイルをアップロードできません。";
	}
  } else {
	echo "ファイルが選択されていません。";
?>
<?php
  }

  
?>
 <br>
<button type="submit" onclick="location.href='../photoregister.html'">戻る</button>

</body>
</html>