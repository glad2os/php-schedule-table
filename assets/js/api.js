function request(target, body, callback = {}, fallbackCallback = e => alert(e.issueMessage)) {
    const request = new XMLHttpRequest();
    request.open("POST", `/${target}`, true);
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.responseType = "json";
    request.onreadystatechange = () => {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) callback(request.response);
            else if (request.status === 403) alert("Нет прав доступа!");
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
        location.reload()
    });
}

function reg(form) {
    request('auth/register', {
        "login": form.login.value,
        "password": form.password.value
    }, (response) => {
        alert("Успешно");
    });
}

function addUser(form) {
    request('control_panel/addmember', {
        "name": form.name.value,
        "surname": form.surname.value,
        "date_of_birth": form.date_of_birth.value,
        "weight": form.weight.value,
        "club": form.club.value,
        "place_of_living": form.place_of_living.value,
        "sex": form.sex.value,
    }, (response) => {
        location.reload();
    });
}