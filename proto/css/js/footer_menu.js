window.addEventListener("DOMContentLoaded", () => {

    let flag = false;
    let register = document.getElementById("register");
    let menu_container_register = document.getElementById("menu-container-register");
    menu_container_register.style.display = "none";
    
    register.addEventListener('click', function() {
        if(flag) {
            menu_container_register.style.display = "none";
            flag = false;
        } else {
            menu_container_register.style.display = "block";
            flag = true;
        }
    });

});
