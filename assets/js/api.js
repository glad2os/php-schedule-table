function request(target, body, callback = {}, fallbackCallback = e => alert(e.message)) {
    const request = new XMLHttpRequest();
    request.open("POST", `/${target}`, true);
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.responseType = "json";
    request.onreadystatechange = () => {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) callback(request.response);
            else if (request.status === 403) window.location.replace("/login");
            else fallbackCallback(request.response);
        }
    };
    request.send(JSON.stringify(body));
}

function reg(form) {
    request('auth/login', {
        "login": form.login,
        "password" : form.password
    }, (response) => {
        console.log(response);
    });
}
