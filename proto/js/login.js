window.addEventListener("load", () => {

    // URLパラメーターにerrorがある場合
    if(getParam("error") == 1) {
        alert("メールアドレスまたはパスワードを入れてください");
    }
    if(getParam("error") == 2) {
        alert("メールアドレスまたはパスワードが違います");
    }

    // unimpクラスがついているものをクリックした際には「未実装です。」とアラートを出す。
    let unimp = document.getElementsByClassName("unimp");
    for(let i = 0; i < unimp.length; i++) {
        unimp[i].onclick = e => {
            alert("未実装です。");
            return false;
        }
    }

});