<?php
///*
require "../php/include/includeAll.php";
    $id = json_decode($_POST['Ary']);
    for($i=0; $i<count($id); $i++){
        echo $id[$i];
        $sql = "
        DELETE FROM food 
        WHERE 
            id = ?;
        ";
        $isFaved = execsql($conn, $sql, array($id[$i]));
        echo json_encode($res); // テスト用
    }
//*/
    
?>
