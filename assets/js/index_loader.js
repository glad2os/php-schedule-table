if (getCookie('token').length !== undefined) {
    const username = document.getElementById('user');
    const authform = document.getElementById('auth');
    username.insertAdjacentHTML('afterend', '<div>Вы вошли как ' + getCookie('login') + '</div>');
    authform.style.display = 'none';
}

