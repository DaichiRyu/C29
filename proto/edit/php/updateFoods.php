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

        try {

            $conn->beginTransaction();

            foreach($json["data"]["foods"] as $food) {
                $name = $food["name"];
                $number = $food["number"];
                $ub = $food["ub"];
                $bb = $food["bb"];
                $storage = $food["storage"];
                $genre = $food["genre"];
                $money = $food["money"];
                $id = $food["id"];
                $uid = $food["userID"];

                // このデータはログインユーザーのものか？
                if($userID != $uid) {
                    throw new Exception("IDが一致しません。");
                }

                if($ub == "") {
                    $ub = null;
                }
                if($bb == "") {
                    $bb = null;
                }
                if($money == "") {
                    $money = null;
                }

                $sql = "
                UPDATE food 
                SET 
                    name = ?, number = ?, ub = ?, bb = ?, storage = ?, genre = ?, money = ?, userID = ? 
                WHERE 
                    id = ?;
                ";
                execsql($conn, $sql, array($name, $number, $ub, $bb, $storage, $genre, $money, $userID, $id));        
            }

            $conn->commit();

        } catch(Exception $e) {
        
            $conn->rollBack();
            $response["error"] = true;
            $response["errorMessage"] = "データの挿入に失敗しました。";
            echo json_encode($response);
            exit();

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
