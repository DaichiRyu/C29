<?php

require "../php/include/includeAll.php";
require "../php/requestFoods.php";
require "../php/requestStorage.php";
require "../php/requestGenre.php";

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>食品の編集</title>

    <link rel="stylesheet" href="css/edit.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/include/foods.js"></script>
    <script src="js/edit.js"></script>
    <script src="js/delete.js"></script>
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
            <?php $idlist=array(); ?>
            <?php $idvalue=array(); ?>
            <?php for ($i = 0; $i < count($result); $i++) { 
                $id = $result[$i]["id"];
                
                ?>
            <div class="food" data-id="<?php echo $result[$i]["id"] ?>" data-uid="<?php echo $result[$i]["userID"] ?>">
                <div class="food-left">
                    <label for="">名称</label>
                    <input class="food-name editable-input" type="text" value="<?php echo $result[$i]["name"] ?>"
                        data-old-value="<?php echo $result[$i]["name"] ?>">
                </div>
                <div class="food-right">
                    <div>
                        <label for="">個数</label><input class="food-number editable-input" type="number"
                            value="<?php echo $result[$i]["number"] ?>"
                            data-old-value="<?php echo $result[$i]["number"] ?>">
                    </div>
                    <div>
                        <label for="">消費期限</label><input class="food-ub editable-input" type="date"
                            value="<?php echo $result[$i]["ub"] ?>" data-old-value="<?php echo $result[$i]["ub"] ?>">
                    </div>
                    <div>
                        <label for="">賞味期限</label><input class="food-bb editable-input" type="date"
                            value="<?php echo $result[$i]["bb"] ?>" data-old-value="<?php echo $result[$i]["bb"] ?>">
                    </div>
                    <div>
                        <label for="">保存場所</label>
                        <select name="" class="food-storage select-storage editable-input"
                            data-selected="<?php echo $result[$i]["storage"] ?>"
                            data-old-value="<?php echo $result[$i]["storage"] ?>">

                            <?php for ($j = 0; $j < count($storage); $j++) { ?>

                            <option value="<?php echo $storage[$j]["id"] ?>" <?php

                                                                                                // 選ばれているものにselected属性を付与する。
                                                                                                if ($result[$i]["storage"] == $storage[$j]["id"]) {
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
                            data-selected="<?php echo $result[$i]["genre"] ?>"
                            data-old-value="<?php echo $result[$i]["genre"] ?>">

                            <?php for ($j = 0; $j < count($genre); $j++) { ?>

                            <option value="<?php echo $genre[$j]["id"] ?>" <?php

                                                                                            // 選ばれているものにselected属性を付与する。
                                                                                            if ($result[$i]["genre"] == $genre[$j]["id"]) {
                                                                                                echo "selected";
                                                                                            }

                                                                                            ?>>
                                <?php echo $genre[$j]["name"] ?></option>

                            <?php } ?>

                        </select>
                    </div>
                    <div>
                        <label for="">金額</label><input class="food-money editable-input" type="number"
                            value="<?php echo $result[$i]["money"] ?>"
                            data-old-value="<?php echo $result[$i]["money"] ?>">
                    </div>
                    <div>
                        <label for="">削除</label>
                        <?php $idname = "button-delete-id".$i ?> 
                        <?php array_push($idlist,$idname) ?>
                        <?php array_push($idvalue,$id) ?>
                        <button id="<?php echo $idname ?>" class="button-deletes" data-value="<?php echo $id ?>">選択</button>
                    </div>
                </div>
            </div>
            <?php } ?>
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
<script type="text/javascript">
        //削除するデータの選別
        $('.button-deletes').on('click', function(){
        var $idname =  $(this).attr("id");
        var $classname =  $(this).attr("class");
        
        if($classname=="button-deletes click"){
        $("#"+$idname).removeClass('click')
        }else{
        $("#"+$idname).addClass('click')
        }
        var $data=$(this).attr("data-value");
        console.log($data);
        });
        //データの削除
        var $id = new Array;
        $('#button-delete').on('click', function(){
        const $idlist = document.querySelectorAll(".click");
        for(let i in $idlist){
            if ($idlist.hasOwnProperty(i)) {
            $ids=document.getElementById($idlist[i].id);
            $id.push($ids.dataset.value);
            }
        }
        });
        

</script>

</html>