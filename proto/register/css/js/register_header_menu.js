 window.addEventListener("DOMContentLoaded", () => {

    let menu_btn = document.getElementById("menu-btn");
    let menu = document.getElementById("menu");
    menu_btn.addEventListener('click', function() {
        menu.style.display = "block";
    });

    let cross_btn = document.getElementById("cross-btn")
    cross_btn.addEventListener('click', function() {
        menu.style.display = "none";
    });
    
});
