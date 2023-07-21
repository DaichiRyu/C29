window.addEventListener("load", () => {

    let codeArr = []; // サーバーサイドに送信するjancodeの配列

    let inputJancode = document.getElementById("input-code");
    let buttonAppendRow = document.getElementById("button-append-row");
    let tableBody = document.querySelector("#code-list tbody");
    buttonAppendRow.onclick = () => {
        let jancode = inputJancode.value;
        // inputのvalueが数字のみ？
        if(isNumbers(jancode)) {
            // append row
            let tr = document.createElement("tr");
            let td = document.createElement("td");
            td.innerText = jancode;
            td.classList.add("code-row");
            td.dataset.code = jancode;
            tr.append(td);
            tableBody.append(tr);

            inputJancode.value = "";
        }
    }

    let inputCodeList = document.getElementById("input-code-list");
    let buttonSubmit = document.getElementById("button-sumbit");
    buttonSubmit.onclick = () => {
        // tbodyに子ノードが存在する？
        if(tableBody.hasChildNodes()) {
            let rows = tableBody.querySelectorAll(".code-row");
            rows.forEach(row => {
                codeArr.push(Number(row.dataset.code));
            });

            let codeList = ""; // comma splited string value
            // 配列が空でない？
            if(codeArr.length > 0) {
                codeArr.forEach(code => codeList += (code + ","));
            }
            codeList = codeList.substring(0, codeList.length - 1);
            inputCodeList.value = codeList;

            document.formJancode.submit();
        } else {
            alert("コードを1つ以上追加してください。");
        }
    }

});