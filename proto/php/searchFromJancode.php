<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>登録リスト</title>

        <link rel="stylesheet" href="css/register.css">

    </head>
    
    <body>
       <!--<div id="executing" class="disable">
            実行中
        </div>
-->
        <header class="title">登録リスト表示</header>
        <div id="main-container">
            <div id="food-container">
    
        <footer id="menu-container">
            
            <div id="button-next">
                <a href="barcoderegister.html">次の食品を検索する</a>
                <form name="form1" method="get" action="confirm.php">
            </div>
            <div id="button-cancel">
            <form action="index.php" method="POST">
            <input type="submit" value="登録">
            <a href="../home.php">キャンセル</a>
            </div>
        </footer>
    </body>
</html>
<?php
//使用したURL
//https://www.php.net/manual/ja/function.json-decode.php 
//header("Content-Type: text/javascript; charset=utf-8");
    session_start();
if($_GET['jancode']) {

    $url = "https://shopping.yahooapis.jp/ShoppingWebService/V3/itemSearch?";
    $appid = "dj00aiZpPVFOeXFTd2U5cE1WdSZzPWNvbnN1bWVyc2VjcmV0Jng9NDg-";
    $jancode = $_GET['jancode'];
    $reqUrl = $url."appid=".$appid."&jan_code=".$jancode ;




        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $reqUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        curl_close($ch);
        $response["result"]= json_decode($result,true);
        //var_dump(json_decode($result,true));
        //print["hits"][0]["name"];
        $data = json_decode($result,true);
    //if (!isset($_SESSION["visited"])){
        if($data["hits"]){
        
        //echo($data["hits"][0]["name"]."\n".$data["hits"][0]["price"]);
        $name=array($data["hits"][0]["name"]);//名前の部分
        $price=array($data["hits"][0]["price"]);//金額の部分
        if(isset($_SESSION['VISIT_COUNT'])) {
            $_SESSION['VISIT_COUNT']++;
          } else {
            // 1回目の訪問
            $_SESSION['VISIT_COUNT'] = 1;
          }
        //if(!isset($_SESSION['name'])){
            //$_SESSION['name'] = array();
        //}
        //セッション変数「cart」に配列の中身を追加
        if(!isset($_SESSION['name'])){
        $_SESSION['name'] = array(['name'],$name);
        $_SESSION['price'] = array(['price'],$price);
        }
        else{
        //$_SESSION['name'] =array_push(array[])
        $_SESSION['name'][] = $name;
        $_SESSION['price'][] = $price;
        }
        
        //$_SESSION['name'] = array();

        //$name = $_SESSION['name'];


        //echo $_SESSION['name'];//セッションを呼び出し
        //print_r($_SESSION);
       if($_SESSION['VISIT_COUNT'] = 1){
            echo ($_SESSION['name'][1][0]."\n".$_SESSION['price'][1][0]);
        }
        if($_SESSION['VISIT_COUNT'] = 2){
        //echo ($_SESSION['name'][1][0]."\n".$_SESSION['price'][1][0]);
        /* echo "<br/>"; */
            echo ($_SESSION['name'][2][0]."\n".$_SESSION['price'][2][0]);
        }
        if($_SESSION['VISIT_COUNT'] = 3){
           // echo ($_SESSION['name'][1][0]."\n".$_SESSION['price'][1][0]);
            /* echo "<br/>"; */
           // echo ($_SESSION['name'][2][0]."\n".$_SESSION['price'][2][0]);
            /* echo "<br/>"; */
            echo ($_SESSION['name'][3][0]."\n".$_SESSION['price'][3][0]);
        }
        if($_SESSION['VISIT_COUNT'] = 4){
       // echo ($_SESSION['name'][1][0]."\n".$_SESSION['price'][1][0]);
        /* echo "<br/>"; */
       // echo ($_SESSION['name'][2][0]."\n".$_SESSION['price'][2][0]);
        /* echo "<br/>"; */
       // echo ($_SESSION['name'][3][0]."\n".$_SESSION['price'][3][0]);
            echo ($_SESSION['name'][4][0]."\n".$_SESSION['price'][4][0]);
        }
        if($_SESSION['VISIT_COUNT'] = 5){
            echo ($_SESSION['name'][5][0]."\n".$_SESSION['price'][5][0]);
        }
        
            
        //session_destroy();
       //print_r($name);
       //print_r($price);

        //echo "円です。";

        }
    else{
        echo"検索した際にヒットしませんでした";
        }
    //else{
        
    //}

        //print["hits"][0]["name"];
        //exit();

    //} catch(Exception $e) {
        //echo "例外が発生しました";

        /*$response["error"] = true;
        $response["errorMessage"] = $e->getMessage();
        echo json_encode($response);
        exit();*/

    }

else {

    /*$response["error"] = true;
    $response["errorMessage"] = "jancodeがセットされていません。";
    ver_dump($response,true);
    exit;*/
    echo "janコードが正確にセットされていません。";

}
