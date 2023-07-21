<?php

require __DIR__ . "/include/includeAll.php";

if (isset($_POST["email"]) && isset($_POST["password"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $sql = "
        SELECT id FROM users 
        WHERE 
            email = ? AND password = ?;
        ";
        $userID = execsql($conn, $sql, array($email, $password))->fetch();
        if (!$userID) {
            header("Location: ../deleteAccount.html?error=1");
            exit();
        }

        $userID = $userID["id"];
        $conn->beginTransaction();

        $sql = "
        DELETE FROM food 
        WHERE 
            userID = ?;
        ";
        execsql($conn, $sql, array($userID));

        $sql = "
        DELETE FROM users 
        WHERE 
            id = ?;
        ";
        execsql($conn, $sql, array($userID));

        $conn->commit();
        header("Location: ../login.html");
        exit();
    } catch (Exception $e) {
        $conn->rollBack();
        header("Location: ../deleteAccount.html?error=1");
        exit();
    }
} else { }