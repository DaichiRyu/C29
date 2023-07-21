<?php
session_start();
header("Access-Control-Allow-Origin: *");

$default_charset="UTF-8";

$filename=$_SESSION["filename"];
$command = " echo $filename | /usr/local/bin/python3 register.py";#Pythonに移動
exec("export LANG=ja_JP.UTF-8;" .$command, $output, $state);
#echo "要素数".count($output)."<br>";#テスト用
$i=0;
$foodlist= array();
foreach ($output as $o) {

	if(!($o=="")){
        if(array_key_exists($o,$foodlist)){
        $intC=$foodlist[$o];
        $intC=$intC+=1;
        $foodlist[$o]=$intC;
        }else{
        $foodlist[$o]=1;
        }
	//$food = array("name" => $o);
    //$foodcount =  arrry("number" =>)
	//array_push($foods, $food);
    $i+=1;
	}else{
	}
}
$narray=array();
$varray=array();
for($i=0;$i<count($foodlist);$i+=1){
    $nkey = key(array_slice($foodlist,$i,1,true));
    $vkey = current(array_slice($foodlist,$i,1,true));
    $narray[$i]=$nkey;
    $varray[$i]=$vkey;
}
#require('reset.php');//保存されている画像を削除する
#echo "要素数".count($foods);#テスト用

#配列受け渡し用
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
  <script type="text/javascript">
    function start() {
      var now = new Date();
      var f = document.forms["form1"];
      f.method = "POST"; 
      f.submit(); 
      return true;
    }
  </script>
</head>
<body>
<input id="button1" type="button" value="処理が完了しましたボタンを押してください" onclick="start()">
<form name="form1" method="POST" action="https://stolitor.com/home/register/result.php">
    <?php for ($i=0; $i < count($narray); $i++) {?>
        
        <input type='hidden' name='名前[]' value="<?php echo $narray[$i];?>">
        <input type='hidden' name='数量[]' value="<?php echo $varray[$i];?>">
    <?php }?>
</form>

</body>
<?php
//以下Jsアラート用
if(count($foodlist)==0){    
?>
<script>
    result = window.confirm("食品が検出されませんでした。手入力を行いますか？");
    if(result){
        location = "https://stolitor.com/home/register/register.php"
    }else{
        location = "../photoregister.html"
    }
</script>
<?php
  }
?>
</html>

