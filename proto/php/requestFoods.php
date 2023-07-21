<?php

session_start();

// ログインしている？
if (isset($_SESSION["userID"])) {

    $userID = $_SESSION["userID"];

    $sql = "
    SELECT * FROM food
    WHERE
        userID = ?;
    ";

    $result = execsql($conn, $sql, array($userID))->fetchAll();
} else {

    header("Location: https://stolitor.com/home/login.html");
    exit();
}