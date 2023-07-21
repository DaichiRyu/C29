window.addEventListener("load", () => {

    // unimpクラスがついているものをクリックした際には「未実装です。」とアラートを出す。
    let unimp = document.getElementsByClassName("unimp");
    for(let i = 0; i < unimp.length; i++) {
        unimp[i].onclick = e => {
            alert("未実装です。");
            return false;
        }
    }

    let foods = document.querySelectorAll("#foods-container .food");
    foods.forEach(food => {
        let ub = food.dataset.ub;
        let today = new Date();
        let ubDate = new Date();
        ubDate.setTime(Date.parse(ub));

        if(ubDate.getFullYear() - today.getFullYear() < 0) { // 年 消費期限切れ
            food.classList.add("ub-red");
        } else if(ubDate.getMonth() - today.getMonth() < 0) { // 月 消費期限切れ
            food.classList.add("ub-red");
        } else if(ubDate.getDate() - today.getDate() < 0) { // 日 消費期限切れ
            food.classList.add("ub-red");
        } else if(ubDate.getDate() - today.getDate() <= 1) { // 消費期限1日前以下
            food.classList.add("ub-red");
        } else if(ubDate.getDate() - today.getDate() <= 3) { // 消費期限3日前以下
            food.classList.add("ub-yellow");
        }
    });

});