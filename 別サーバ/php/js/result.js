<?PHP
header("Access-Control-Allow-Origin: *");
sleep(1); // わざと1秒待つ。不必要なら削除する
//配列を受信する。
$ary_names   = $_POST['名前'];
$ary_numbers = $_POST['数量'];
 
//ログファイルを開く。（スクリプトと同じディレクトリに出力）
$output_file_path = __DIR__ . '/log.txt';
$res_file = fopen($output_file_path , 'a+');
 
foreach($ary_names as $name)
{
    //配列の内容を1個ずつ書き出す。
    fwrite($res_file, $name . PHP_EOL);
}
 
foreach($ary_numbers as $number)
{
    //配列の内容を1個ずつ書き出す。
    fwrite($res_file, $number . PHP_EOL);
}
 
//ファイルを閉じる
fclose($res_file);  

var_dump($ary_names);
var_dump($ary_numbers);
?>