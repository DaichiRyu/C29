<?php
$filename = 'imgfiles/'.$_SESSION['filename'];
unlink($filename)
//ファイルを削除する
/*
if (unlink($filename)){
  echo $_SESSION['filename'].'の削除に成功しました。';
}else{
  echo $_SESSION['filename'].'の削除に失敗しました。';
}
*/
?>