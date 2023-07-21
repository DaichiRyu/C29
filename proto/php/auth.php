<?php

require __DIR__ . "/include/includeAll.php";

// postのパラメーターにメアドとパスワードが含まれている？
$email = $_POST["email"];
$password = $_POST["password"];

if (""!=$email && ""!=$password) {

    $sql = "
    SELECT id FROM users
    WHERE
        email = ? AND password = ?;
    ";
    // メアドとパスワードの組み合わせは正しい？
    if(isset(execsql($conn, $sql, array($email, $password))->fetch()["id"])){
        $userID = execsql($conn, $sql, array($email, $password))->fetch()["id"];
        session_start();
        $_SESSION["userID"] = $userID;
        header("Location: ../home.php");
        exit();
    }else{
        header("Location: ../login.html?error=2");
        exit();
    }
} else {

    header("Location: ../login.html?error=1");
    exit();
}