<?php

require "php/include/includeAll.php";
require "php/requestFoods.php";

?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム</title>
    <link rel="stylesheet" href="css/home.css">

    <script src="js/home.js"></script>
    <script src="css/js/footer_menu.js"></script>
</head>

<body>

    <header>
        <a href="login.html" target="_self">
            <img src="images/logout.png" alt="">
        </a>
        <p>あなたの食品一覧</p>
        <a href="guide/guide.html">
            <img src="images/guide.png" alt="" id="guide-btn">
        </a>
    </header>
    <main>
        <div id="foods-container">
            <?php for ($i = 0; $i < count($result); $i++) { ?>
            <div class="food" data-ub="<?php echo $result[$i]["ub"] ?>">
                <p><?php echo $result[$i]["name"] ?></p>
                <p><?php echo $result[$i]["number"] ?>個</p>
                <a href="detail.php?id=<?php echo $result[$i]["id"] ?>"></a>
            </div>
            <?php } ?>
        </div>
    </main>
    <!--<p id="questionnaire">
        <a href="https://docs.google.com/forms/d/1rSpWHLWxTHEdoWFamAu5R0FVdihSsJuhILFqjbFsjE8/edit">
            アンケートにアクセスする</a>
    </p>-->
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
            <a href="edit/edit.php"></a>
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
                    <a href="http://153.126.179.10/photoregister.html" target="_blank"></a>
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
