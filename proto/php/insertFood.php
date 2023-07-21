<?php

require "include/includeAll.php";

header("Content-Type: text/javascript; charset=utf-8");
$response = array("error" => false, "errorMessage" => null);
session_start();

// ログインしているかつ、パラメータがセットされている？
if(isset($_SESSION["userID"]) && isset($_POST["name"]) && isset($_POST["money"])) {

    $userID = $_SESSION["userID"];
    $name = $_POST["name"];
    $money = $_POST["money"];

    try {
        $conn->beginTransaction();

        $sql = "
        INSERT INTO food(name, number, storage, genre, money, userID) 
        VALUES(?, ?, ?, ?, ?, ?);
        ";
        execsql($conn, $sql, array($name, 1, 1, 1, $money, $userID));

        $conn->commit();

        echo json_encode($response);
        exit();
    } catch(Exception $e) {
        $conn->rollBack();
        $response["error"] = true;
        $response["errorMessage"] = "データの挿入に失敗しました。";
        echo json_encode($response);
        exit();
    }

} else {

    header("Location: ../login.html");
    exit();

}
