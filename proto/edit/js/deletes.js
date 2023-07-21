window.addEventListener("load", () => {
//データ削除
    let buttonCommitdel=document.getElementById("button-delete");
    buttonCommitdel.onclick=()=>{
        if(confirm("削除しますか？")) {
            fetch('deletes.php', { // 送り先
                method: 'POST', // メソッド
                headers: { 'Content-Type': 'application/json' }, // jsonを指定
                body: JSON.stringify($id) // 添付
            })   
            //テスト用
            .then(response => response.json())
            .then(res => {
                console.log(res);
        });
        window.location.href = '../home.php';
        }
    }
    
});