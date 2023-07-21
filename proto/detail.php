<?php

require "php/include/includeAll.php";

session_start();

// ログインしている？
if (isset($_SESSION["userID"])) {

    $userID = $_SESSION["userID"];

    // GETパラメーターにidが含まれている？
    if (isset($_GET["id"])) {

        $id = $_GET["id"];

        // 食品情報を取得。
        $sql = "
        SELECT * FROM food 
        WHERE 
            id = ?;
        ";
        $result = execsql($conn, $sql, array($id))->fetch();

        // 食品情報をもとに保存場所を取得。
        $sql = "
        SELECT name FROM storage 
        WHERE 
            id = ?;
        ";
        $storage = execsql($conn, $sql, array($result["storage"]))->fetch();

        // 食品情報をもとにジャンルを取得。
        $sql = "
        SELECT * FROM genre 
        WHERE 
            id = ?;
        ";
        $genre = execsql($conn, $sql, array($result["genre"]))->fetch();

        // お気に入りボタンが押されているかどうかを取得。
        $sql = "
        SELECT faved FROM food 
        WHERE 
            id = ?;
        ";
        $isFaved = execsql($conn, $sql, array($id))->fetch()["faved"];

        // 食品のidとユーザーidが一致していない？
        if ($result["userID"] != $userID) {

            header("Location: home.php");
            exit();
        }
    } else {

        header("Location: home.php");
        exit();
    }
} else {

    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>食品の詳細</title>
    <link rel="stylesheet" href="css/detail.css">
    <script src="js/detail.js"></script>
    <script src="css/js/footer_menu.js"></script>
</head>

<body>

    <header>
        <a href="home.php"><img src="images/shape02.png" alt=""></a>
        <span></span>
        <div id="favorite" data-faved="<?php

                                        if ($isFaved) {
                                            echo "1";
                                        } else {
                                            echo "0";
                                        }

                                        ?>">



        </div>
    </header>
    <main>
        <div id="detail-container" data-id="<?php echo $result["id"] ?>">
            <table>
                <tr>
                    <th>名称</th>
                    <td><?php echo $result["name"] ?></td>
                </tr>
                <tr>
                    <th>個数</th>
                    <td><?php echo $result["number"] ?></td>
                </tr>
                <tr>
                    <th>消費期限</th>
                    <td><?php echo $result["ub"] ?></td>
                </tr>
                <tr>
                    <th>賞味期限</th>
                    <td><?php echo $result["bb"] ?></td>
                </tr>
                <tr>
                    <th>保存場所</th>
                    <td><?php echo $storage["name"] ?></td>
                </tr>
                <tr>
                    <th>ジャンル</th>
                    <td><?php echo $genre["name"] ?></td>
                </tr>
                <tr>
                    <th>金額</th>
                    <td><?php echo $result["money"] ?>円</td>
                </tr>
            </table>

        </div>
    </main>
    <footer id="menu-container">
        <div class="home">
            <img src="images/home.png" alt="">
            <p>ホーム</p>
            <a href="home.php"></a>
        </div>
        <div id="register">
            <img src="images/reg.png" alt="">
            <p>登録</p>
        </div>
        <div id="edit-food">
            <img src="images/edit.png" alt="">
            <p>編集</p>
            <a href="edit/edits.php?id=<?php echo $id ?>"></a>
        </div>

        <span id="menu-container-register">
            <div>
                <div>
                    <img src="images/barcode.png" alt="">
                    <p>バーコード</p>
                    <a href="register/barcoderegister.html"></a>
                </div>
                <div>
                    <img src="images/photo.png" alt="">
                    <p>食品撮影</p>
                    <a href="http://153.126.179.10/photoregister.html" class="unimp"></a>
                </div>
                <div>
                    <img src="images/input.png" alt="">
                    <p>手入力</p>
                    <a href="register/register.php"></a>
                </div>
            </div>
        </span>
    </footer>
</body>

</html>
