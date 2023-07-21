<?php
require "../php/include/includeAll.php";
    echo apache_request_headers();
    $raw = file_get_contents('php://input'); // POSTされた生のデータを受け取る
    $data = json_decode($raw); // json形式をphp変数に変換
    $id = $data;
        if(""!=$id){
        $sql = "
        DELETE FROM food 
        WHERE 
            id = ?;
        ";
        $isFaved = execsql($conn, $sql, array($id));
        echo json_encode($res); // テスト用
        }
?>