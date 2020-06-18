if (typeof (getCookie('token')) == "string") {
    const menu = document.getElementById('menu');
    const tohide = document.getElementById('tohide');
    tohide.remove();
    menu.style.visibility = "visible";
}

