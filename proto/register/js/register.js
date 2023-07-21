window.addEventListener("load", () => {

    let buttonAdd = document.getElementById("button-add");
    let foodContainer = document.getElementById("food-container");
    // 追加ボタン押下
    buttonAdd.onclick = () => {
        foodContainer.append(Food.generateDomElem());
    }

    let favRows = document.querySelectorAll(".fav-rows");
    favRows.forEach(row => {
        row.onclick = e => {
            if(window.confirm("この食品を追加しますか？")) {
                // row element
                let elem = e.target.parentElement;
                let tds = elem.children;
                let fc = new Food(tds[0].dataset.value, Number(tds[1].dataset.value), Number(tds[4].dataset.value), Number(tds[5].dataset.value), tds[2].dataset.value, tds[3].dataset.value, Number(tds[6].dataset.value));
                let elemFc = fc.generateDomElem();
                foodContainer.append(elemFc);
            }
        }
    });

    let buttonRegister = document.getElementById("button-register");
    let executing = document.getElementById("executing");
    // 登録ボタン押下
    buttonRegister.onclick = () => {
        // 登録確認
        if(confirm("入力した内容で登録してもよろしいですか？")) {
            executing.classList.remove("disable");

            // 送信するオブジェクト
            let obj = {
                foods: [

                ]
            };

            let foods = document.querySelectorAll("#food-container .food");
            // フォーム情報をオブジェクトの配列に格納
            for(let i = 0; i < foods.length; i++) {
                    let food = foods[i];
                    let name = food.querySelector("input[name='name']").value;
                    let number = food.querySelector("input[name='number']").value;
                    let ub = food.querySelector("input[name='ub']").value;
                    let bb = food.querySelector("input[name='bb']").value;
                    let storageElem = food.querySelector("select[name='storage']");
                    let genreElem = food.querySelector("select[name='genre']");
                    let storage = storageElem.options[storageElem.selectedIndex].value;
                    let genre = genreElem.options[genreElem.selectedIndex].value;
                    let money = food.querySelector("input[name='money']").value;

                    obj.foods.push({
                        name: name,
                        number: number,
                        ub: ub,
                        bb: bb,
                        storage: storage,
                        genre: genre,
                        money: money
                    });
            }
            
            // 入力情報をpost送信
            fetch("php/registerFood.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                },
                body: JSON.stringify({data: obj})
            }).then(response => {
                executing.classList.add("disable");
                alert("入力した内容が登録されました。");
                location.href = "../home.php";
            });

        }
    }

});