<?php

require "include/includeAll.php";

session_start();

header("Content-Type: text/javascript; charset=utf-8");
$response = array("error" => false, "errorMessage" => null, "faved" => null);

// ログインしている？
if (isset($_SESSION["userID"]) && isset($_GET["id"]) && isset($_GET["faved"])) {

    $userID = $_SESSION["userID"];
    $foodID = $_GET["id"];
    $faved = $_GET["faved"] ? 0 : 1;
    $response["faved"] = $_GET["faved"] ? true : false;

    $sql = "
    SELECT userID FROM food 
    WHERE 
        id = ?;
    ";
    $ownerID = execsql($conn, $sql, array($foodID))->fetch()["userID"];

    // ログインユーザーIDとDBのユーザーIDは一致しているか？
    if ($userID != $ownerID) {
        $response["error"] = true;
        $response["errorMessage"] = "ユーザーIDが一致しません。";
        echo json_encode($response);
        exit();
    }

    try {

        $conn->beginTransaction();

        $sql = "
        UPDATE food 
        SET 
            faved = ? 
        WHERE 
            id = ?;
        ";
        execsql($conn, $sql, array($faved, $foodID));

        $conn->commit();

        $response["faved"] = $faved ? true : false;
        echo json_encode($response);
        exit();
    } catch (Exception $e) {

        $conn->rollBack();
        $response["error"] = true;
        $response["errorMessage"] = "お気に入り登録に失敗しました。";
        echo json_encode($response);
        exit();
    }
} else {

    header("Location: login.html");
    exit();
}