window.addEventListener("load", () => {

    // 送信するデータ
    let requestParam = {
        data: {
            foods: [

            ]
        }
    };
    //編集確定時
    let buttonCommit = document.getElementById("button-commit");
    let executing = document.getElementById("executing");
    buttonCommit.onclick = () => {
        if(confirm("編集した内容で保存してもよろしいですか？")) {

            executing.classList.remove("disable");

            let allInputContainer = document.querySelectorAll(".food");
            for(let i = 0; i < allInputContainer.length; i++) {
                let childInput = allInputContainer[i].querySelectorAll(".editable-input");

                for(let j = 0; j < childInput.length; j++) {
                    let newVal = childInput[j].value;
                    let oldVal = childInput[j].dataset.oldValue;

                    // 値が更新された？
                    if(newVal != oldVal) {
                        let parent = childInput[j].closest(".food");
                        let id = parent.dataset.id;
                        let userID = parent.dataset.uid;
                        let data = new Food();
                        data.id = Number(id);
                        data.name = parent.querySelector(".food-name").value;
                        data.number = Number(parent.querySelector(".food-number").value);
                        data.ub = parent.querySelector(".food-ub").value;
                        data.bb = parent.querySelector(".food-bb").value;
                        data.storage = Number(parent.querySelector(".food-storage").value);
                        data.genre = Number(parent.querySelector(".food-genre").value);
                        data.money = Number(parent.querySelector(".food-money").value);
                        data.userID = Number(userID);
                        requestParam.data.foods.push(data);

                        break;
                    }
                }
            }

            // 入力情報をpost送信	
            fetch("php/updateFoods.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                },
                body: JSON.stringify(requestParam)
            }).then(response => {
                executing.classList.add("disable");
                alert("編集した内容が保存されました。");
            }).finally(() => {
                //location.reload();
                window.location.href = '../home.php';
            });
            
        }
    }
});

 