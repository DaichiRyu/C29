<?php

require __DIR__ . "/include/includeAll.php";

session_start();

// postパラメーターに必要な情報があるか？
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    // パスワードとパスワード（確認用）は一致している？
    if ($password == $password2) {

        try {
            $conn->beginTransaction();

            $sql = "
            INSERT INTO users(email, password) VALUES(?, ?);
            ";
            execsql($conn, $sql, array($email, $password));

            $conn->commit();

            $sql = "
            SELECT id FROM users
            WHERE
                email = ?;
            ";
            $userID = execsql($conn, $sql, array($email))->fetch()["id"];
            $_SESSION["userID"] = $userID;
            //here
            header("Location: ../home.php");
            exit();
        } catch (Exception $e) {
            $conn->rollBack();
            header("Location: ../createAccount.html?error=1");
            exit();
        }
    } else {

        header("Location: ../createAccount.html?error=1");
        exit();
    }
} else {

    header("Location: ../createAccount.html?error=1");
    exit();
}