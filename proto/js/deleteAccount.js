window.addEventListener("load", () => {

    // URLパラメーターにerrorがある場合
    if(getParam("error") == 1) {
        alert("アカウント削除に失敗しました。");
    }

    let inputEmail = document.getElementById("input-email");
    let inputPassword = document.getElementById("input-pw");
    let inputCheck = document.getElementById("input-check");
    let buttonSubmit = document.getElementById("button-submit");

    buttonSubmit.onclick = () => {
        if(!isBlank(inputEmail.value) && !isBlank(inputPassword.value) && inputCheck.checked) {
            document.formDeleteAccount.submit();
        } else {
            
        }
    }

});