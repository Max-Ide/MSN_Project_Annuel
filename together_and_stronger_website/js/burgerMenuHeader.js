function toggleMenu() {
    var menu = document.getElementById('menu');
    if (menu.style.maxHeight) {
        menu.style.maxHeight = null;
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
        menu.style.maxHeight = menu.scrollHeight + "px";
    }
}
