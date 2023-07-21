<?php
require "../php/include/includeAll.php";
require "../php/requestFoods.php";
require "../php/requestStorage.php";
require "../php/requestGenre.php";



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
        $storages = execsql($conn, $sql, array($result["storage"]))->fetch();

        // 食品情報をもとにジャンルを取得。
        $sql = "
        SELECT * FROM genre 
        WHERE 
            id = ?;
        ";
        $genres = execsql($conn, $sql, array($result["genre"]))->fetch();

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
    <title>食品の編集</title>

    <link rel="stylesheet" href="css/edit.css">

    <script src="../js/include/foods.js"></script>
    <script src="js/edit.js"></script>
    <script src="js/deletes.js"></script>
</head>

<body>

    <div id="executing" class="disable">
        実行中
    </div>

    <header class="title">
        <a href="../home.php"><img src="../images/shape02.png" alt=""></a>
        <p>編集画面</p>
        <span></span>
    </header>
    <main>
        <div id="foods-container">

            <div class="food" data-id="<?php echo $result["id"] ?>" data-uid="<?php echo $result["userID"] ?>">
                <div class="food-left">
                    <label for="">名称</label>
                    <input class="food-name editable-input" type="text" value="<?php echo $result["name"] ?>"
                        data-old-value="<?php echo $result["name"] ?>">
                </div>
                <div class="food-right">
                    <div>
                        <label for="">個数</label><input class="food-number editable-input" type="number"
                            value="<?php echo $result["number"] ?>"
                            data-old-value="<?php echo $result["number"] ?>">
                    </div>
                    <div>
                        <label for="">消費期限</label><input class="food-ub editable-input" type="date"
                            value="<?php echo $result["ub"] ?>" data-old-value="<?php echo $result["ub"] ?>">
                    </div>
                    <div>
                        <label for="">賞味期限</label><input class="food-bb editable-input" type="date"
                            value="<?php echo $result["bb"] ?>" data-old-value="<?php echo $result["bb"] ?>">
                    </div>
                    <div>
                        <label for="">保存場所</label>
                        <select name="" class="food-storage select-storage editable-input"
                            data-selected="<?php echo $result["storage"] ?>"
                            data-old-value="<?php echo $result["storage"] ?>">
                            <?php for ($j = 0; $j < count($storage); $j++) { ?>

                            <option value="<?php echo $storage[$j]["id"] ?>" <?php

                                                                                                // 選ばれているものにselected属性を付与する。
                                                                                                if ($result["storage"] == $storage[$j]["id"]) {
                                                                                                    echo "selected";
                                                                                                }

                                                                                                ?>>
                                <?php echo $storage[$j]["name"] ?></option>

                            <?php } ?>

                        </select>
                    </div>
                    <div>
                        <label for="">ジャンル</label>
                        <select name="" class="food-genre select-genre editable-input"
                            data-selected="<?php echo $result["genre"] ?>"
                            data-old-value="<?php echo $result["genre"] ?>">

                            <?php for ($j = 0; $j < count($genre); $j++) { ?>

                            <option value="<?php echo $genre[$j]["id"] ?>" <?php

                                                                                            // 選ばれているものにselected属性を付与する。
                                                                                            if ($result["genre"] == $genre[$j]["id"]) {
                                                                                                echo "selected";
                                                                                            }

                                                                                            ?>>
                                <?php echo $genre[$j]["name"] ?></option>

                            <?php } ?>

                        </select>
                    </div>
                    <div>
                        <label for="">金額</label><input class="food-money editable-input" type="number"
                            value="<?php echo $result["money"] ?>"
                            data-old-value="<?php echo $result["money"] ?>">
                    </div>
                </div>
            </div>

        </div>
    </main>
    <footer>
        <div>
            <a id="button-delete">削除</a>
        </div>
        <div>
            <a id="button-commit">編集確定</a>
        </div>
        <div>
            <a href="../home.php">キャンセル</a>
        </div>
    </footer>

</body>
<script>
    const $id=<?php echo $id ?>;
</script>


</html>