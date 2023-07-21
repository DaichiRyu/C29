window.addEventListener("load", () => {
    let buttonAdd = document.getElementById("button-add");
    let foodsContainer = document.getElementById("foods-container");
    // 追加ボタン押下
    buttonAdd.onclick = () => {
        foodsContainer.append(Food.generateDomElem());
    }

    // 送信するデータ
    let requestParam = {
        data: {
            foods: [

            ]
        }
    };

    let buttonSubmit = document.getElementById("button-submit");
    let executing = document.getElementById("executing");
    buttonSubmit.onclick = () => {
        if(confirm("食品の情報を登録しますか？")) {

            executing.classList.remove("disable");
            requestParam = {
                data: {
                    foods: [
        
                    ]
                }
            };

            let allInputContainer = document.querySelectorAll(".food");
            for(let i = 0; i < allInputContainer.length; i++) {
                let parent = allInputContainer[i];
                let data = new Food();
                data.name = parent.querySelector(".food-name").value;
                data.number = Number(parent.querySelector(".food-number").value);
                data.ub = parent.querySelector(".food-ub").value;
                data.bb = parent.querySelector(".food-bb").value;
                data.storage = Number(parent.querySelector(".food-storage").value);
                data.genre = Number(parent.querySelector(".food-genre").value);
                data.money = Number(parent.querySelector(".food-money").value);
                requestParam.data.foods.push(data);
            }

            // 入力情報をpost送信
            fetch("../php/insertFoods.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                },
                body: JSON.stringify(requestParam)
            }).then(response => {
                executing.classList.add("disable");
                alert("食品の登録が完了しました。");
            }).finally(() => {
                location.href = "../home.php";
            });

        }
    }

});