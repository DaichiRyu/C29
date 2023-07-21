<?php

require "../../php/include/includeAll.php";

session_start();

header("Content-Type: text/javascript; charset=utf-8");
$response = array("error" => false, "errorMessage" => null);

$json = getParamJSON();
// ログインしている？
if(isset($_SESSION["userID"])) {

    $userID = $_SESSION["userID"];

    // jsonにdataが含まれている？
    if(isset($json["data"])) {

        foreach($json["data"]["foods"] as $food) {
            $name = $food["name"];
            $number = $food["number"];
            $ub = $food["ub"];
            $bb = $food["bb"];
            $storage = $food["storage"];
            $genre = $food["genre"];
            $money = $food["money"]; 

            if($ub == "") {
                $ub = null;
            }
            if($bb == "") {
                $bb = null;
            }
            if($money == "") {
                $money = null;
            }

            try {

                $conn->beginTransaction();
    
                $sql = "
                INSERT INTO food(name, number, ub, bb, storage, genre, money, userID) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?);
                ";
                execsql($conn, $sql, array($name, $number, $ub, $bb, $storage, $genre, $money, $userID));
    
                $conn->commit();
    
            } catch(Exception $e) {
    
                $conn->rollBack();
                $response["error"] = true;
                $response["errorMessage"] = "データの挿入に失敗しました。";
                echo json_encode($response);
                exit();
    
            }
        }

        echo json_encode($response);
        exit();

    } else {

        $response["error"] = true;
        $response["errorMessage"] = "パラメーターが不足しています。";
        echo json_encode($response);
        exit();

    }

} else {

    header("Location: ../../login.html");
    exit();

}
