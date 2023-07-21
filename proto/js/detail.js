window.addEventListener("load", () => {
    let buttonFavorite = document.getElementById("favorite");
    buttonFavorite.onclick = () => {
        let foodId = document.getElementById("detail-container").dataset.id;
        let faved = buttonFavorite.dataset.faved;
        buttonFavorite.disabled = true;

        fetch(`php/favorite.php?id=${ foodId }&faved=${ faved }`)
        .then(response => {
            response.json().then(json => {
                console.log(json);

                if(json.faved) {
                    buttonFavorite.dataset.faved = 1;
                    //buttonFavorite.innerText = "お気に入り解除";
                    alert("お気に入りに登録しました。");
                } else {
                    buttonFavorite.dataset.faved = 0;
                    //buttonFavorite.innerText = "お気に入り登録";
                    alert("お気に入りを解除しました。");
                }
                buttonFavorite.disabled = false;
            });
        })
        .catch(error => {
            console.log(error);
            buttonFavorite.disabled = false;
        });
    }

});