window.addEventListener("load", () => {

    let buttonSubmit = document.getElementById("button-submit");
    let inputEmail = document.getElementById("input-email");
    let inputPassword = document.getElementById("input-pw");
    let inputPassword2 = document.getElementById("input-pw2");
    // 登録ボタン押下
    buttonSubmit.onclick = () => {
        // メアドが適切かつ、パスワードが適切かつ、パスワードの値とパスワード（確認用）の値が等しい？
        if(isEmailAddress(inputEmail.value) && isPassword(inputPassword.value) && inputPassword.value == inputPassword2.value) {
            document.formCreateAccount.submit();
        } else {
            alert("入力内容が不適切です。");
        }
    }

});
