<?php
require "../../php/include/includeAll.php";
require "../../php/requestStorage.php";
require "../../php/requestGenre.php";
session_start();
header("Access-Control-Allow-Origin: *");
sleep(1); // わざと1秒待つ。不必要なら削除する
// ログインしている？
if (isset($_SESSION["userID"])) {

    $userID = $_SESSION["userID"];
$ndata = $_POST['名前']; // 送ったデータを受け取る（GETで送った場合は、INPUT_GET）
$vdata = $_POST['数量']; 
$foodlist= array();
$foods = array();
for($i=0;$i<count($ndata);$i+=1){
    $food=array("name"=> $ndata[$i],"value"=>$vdata[$i]);
	array_push($foods, $food);
}
/*foreach($ndata as $name)
{
    //配列の内容を1個ずつ書き出す。
    echo $name;
}
 
foreach($vdata as $number)
{
    //配列の内容を1個ずつ書き出す。
    echo $number;
}*/#テスト用
} else {

    header("Location: ../../login.html");
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録リスト</title>

    <link rel="stylesheet" href="../css/searchFromJancode.css">
    <script src="../../js/include/foods.js"></script>
    <script src="../js/searchFromJancode.js"></script>
</head>

<body>
<div id="executing" class="disable">
        実行中
    </div>

    <header class="title">
        <a href="../photoregister.html"><img src="../../images/shape02.png" alt=""></a>
        <p>登録リスト画面</p>
        <span>　</span>
    </header>
    <main>
        <div id="foods-container">

            <?php for ($i = 0; $i < count($foods); $i++) { ?>
            <div class="food">
                <div class="food-left">
                    <label for="">食品名</label><input class="food-name editable-input" type="text"
                        value="<?php echo $foods[$i]["name"]; ?>">
                </div>
                <div class="food-right">
                    <div>
                        <label for="">個数</label><input class="food-number editable-input" type="number"
                         value="<?php echo $foods[$i]["value"]; ?>">
                    </div>
                    <div>
                        <label for="">消費期限</label><input class="food-ub editable-input" type="date"
                            value="<?php print_r(date("Y-m-d")) ?>">
                    </div>
                    <div>
                        <label for="">賞味期限</label><input class="food-bb editable-input" type="date"
                            value="">
                    </div>
                    <div>
                        <label for="">保存場所</label>
                        <select name="" class="food-storage select-storage editable-input">

                            <?php for ($j = 0; $j < count($storage); $j++) { ?>

                            <option value="<?php echo $storage[$j]["id"] ?>"><?php echo $storage[$j]["name"] ?></option>

                            <?php } ?>

                        </select>
                    </div>
                    <div>
                        <label for="">ジャンル</label>
                        <select name="" class="food-genre select-genre editable-input">

                            <?php for ($j = 0; $j < count($genre); $j++) { ?>

                            <option value="<?php echo $genre[$j]["id"] ?>"><?php echo $genre[$j]["name"] ?></option>

                            <?php } ?>

                        </select>
                    </div>
                    <div>
                        <label for="">金額</label><input class="food-money editable-input" type="number" value="0">
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </main>
    <footer id="menu-container">
        <span></span>
        <div id="button-submit">登録</div>
        <div id="button-cancel">
            <a href="../../home.php">キャンセル</a>
        </div>
    </footer>
</body>

</html>