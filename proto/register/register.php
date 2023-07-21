<?php

require "../php/include/includeAll.php";

session_start();
$userID = $_SESSION["userID"];

$sql = "
SELECT * FROM food 
WHERE 
    userID = ? AND 
    faved = 1;
";
$foods = execsql($conn, $sql, array($userID))->fetchAll();

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>食品の登録 - 手入力</title>

    <link rel="stylesheet" href="css/register.css">

    <script src="../js/include/foods.js"></script>
    <script src="js/register.js"></script>
    <script src="css/js/register_header_menu.js"></script>
</head>

<body>
    <div id="executing" class="disable">
        実行中
    </div>

    <div id="menu">
        <div class="menu-header">
            <span id="cross-btn">
                <img src="../images/cross.png" alt="">
            </span>
            <p>お気に入り食品リスト</p>
            <span></span>
        </div>
        <div class="menu-main">
            <!-- お気に入りリスト表示 -->
            <div id="favorite-container" class="active">

                <?php

                for ($i = 0; $i < count($foods); $i++) {
                    $sql = "
                        SELECT name FROM storage 
                        WHERE 
                            id = ?;
                        ";
                    $storage = execsql($conn, $sql, array($foods[$i]["storage"]))->fetch();

                    $sql = "
                        SELECT name FROM genre 
                        WHERE 
                            id = ?;
                        ";
                    $genre = execsql($conn, $sql, array($foods[$i]["genre"]))->fetch();

                    ?>

                <ul>
                    <li class="fav-rows" data-id="<?php echo $foods[$i]["id"] ?>">
                        <div data-col-name="name" data-value="<?php echo $foods[$i]["name"]; ?>">
                            <?php echo $foods[$i]["name"]; ?>
                        </div>
                        <div data-col-name="number" data-value="<?php echo /*$foods[$i]["number"]*/1; ?>">
                            <?php echo /*$foods[$i]["number"]*/1; ?>個
                        </div>
                        <div data-col-name="ub" data-value="<?php echo $foods[$i]["ub"]; ?>">
                            消費期限：<?php echo $foods[$i]["ub"]; ?>
                        </div data-col-name="bb" data-value="<?php echo $foods[$i]["bb"]; ?>">
                        <div>
                            賞味期限：<?php echo $foods[$i]["bb"]; ?>
                        </div>
                        <div data-col-name="storage" data-value="<?php echo $foods[$i]["storage"]; ?>">
                            保存場所：<?php echo $storage["name"]; ?>
                        </div>
                        <div data-col-name="genre" data-value="<?php echo $foods[$i]["genre"]; ?>">
                            ジャンル：<?php echo $genre["name"]; ?>
                        </div>
                        <div data-col-name="money" data-value="<?php echo $foods[$i]["money"]; ?>">
                            <?php echo $foods[$i]["money"]; ?>円
                        </div>
                    </li>
                </ul>
                <?php } ?>


            </div>
        </div>
    </div>

    <header class="title">
        <a href="../home.php"><img src="../images/shape02.png" alt=""></a>
        <p>手入力画面</p>
        <span id="menu-btn">
            <img src="../images/menu.png" alt="">
        </span>
    </header>
    <main>
        <div id="main-container">
            <div id="food-container">

            </div>
            <div id="button-container">
                <div id="button-add">＋</div>
            </div>
        </div>
    </main>
    <footer id="menu-container">
        <span></span>
        <div id="button-register">登録</div>
        <div id="button-cancel">
            <a href="../home.php">キャンセル</a>
        </div>
    </footer>
</body>

</html>