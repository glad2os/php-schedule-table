if (typeof (getCookie('token')) == "string") {
    const username = document.getElementById('user');
    const authform = document.getElementById('auth');
    username.innerText = "Вы вошли как: " + getCookie('login');
    authform.style.display = 'none';
}

