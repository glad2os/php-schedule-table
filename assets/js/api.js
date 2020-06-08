function request(target, body, callback = {}, fallbackCallback = e => alert(e.issueMessage)) {
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

function log(form) {
    request('auth/auth', {
        "login": form.login.value,
        "password": form.password.value
    }, (response) => {
        console.log(response);
    });
}

function reg(form) {
    request('auth/register', {
        "login": form.login.value,
        "password": form.password.value
    }, (response) => {
        console.log(response);
    });
}