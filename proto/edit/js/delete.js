///*
window.addEventListener("load", () => {
    //データ削除
        let buttonCommitdel=document.getElementById("button-delete");
        buttonCommitdel.onclick=()=>{
            var $jsid = JSON.stringify($id)
            if(confirm("削除しますか？")) {
            $.ajax({
                async: true,
                type: "POST",
                url: "delete.php",
                data: { Ary : $jsid }
            }).done(function( msg ) {
                //なんか処理
            });
            window.location.href = '../home.php';
            }
            
        }
        
    });
    //*/
    
