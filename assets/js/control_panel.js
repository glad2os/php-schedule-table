const table = document.getElementById('table');
const pagebyId = document.getElementById('page');
const pageCount = document.getElementById('page_count');

function getMembers(page) {
    request('control_panel/getmembers', {
        ['page']: page
    }, (response) => {
        const received = response;
        received.members.forEach(function (entry) {
            let element = document.createElement('tr');

            element.insertAdjacentHTML('beforeend', '<td contenteditable=false>' + entry['id'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td contenteditable=false id=content' + entry['id'] + '> ' + entry['name'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td contenteditable=false id=content' + entry['id'] + '> ' + entry['surname'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td contenteditable=false id=content' + entry['id'] + '> ' + entry['date_of_birth'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td contenteditable=false id=content' + entry['id'] + '> ' + entry['weight'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td contenteditable=false id=content' + entry['id'] + '> ' + entry['club'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td contenteditable=false id=content' + entry['id'] + '> ' + entry['place_of_living'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td contenteditable=false id=content' + entry['id'] + '> ' + entry['sex'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td id=btn' + entry['id'] + ' onclick="updateBtn(this)"><a href="javascript:void(0)">Изменить</a></td>');

            table.insertAdjacentElement('beforeend', element);
            pagebyId.innerText = received.page;
            pageCount.innerText = received.pageCount;
        });
    });

}

function sendBtn(btn) {
    let id = btn.id.slice(3);
    const content = document.querySelectorAll("#content" + id);
    let map = new Map();

    let a = ['id', 'name', 'surname', 'date_of_birth', 'weight', 'club', 'place_of_living', 'sex']
    map.set("id", id);

    content.forEach(((value, key) => {
        map.set(a[key + 1], value.innerText);
    }));

    const usedata = Object.fromEntries(map);

    request('control_panel/changemember', {usedata}, (response) => {
        location.reload();
    });
}

function updateBtn(btn) {
    document.getElementById(btn.id).innerHTML = "<a href=\"javascript:void(0)\" onclick='sendBtn(" + btn.id + ")'>Принять</a> ";
    let id = btn.id.slice(3);
    const content = document.querySelectorAll("#content" + id);
    content.forEach((value => {
        value.contentEditable = true;
    }));
}

function prev() {
    table.innerHTML = "";
    getMembers(parseInt(pagebyId.innerText) - 1);
}

function next() {
    table.innerHTML = "";
    getMembers(parseInt(pagebyId.innerText) + 1);
}

const c = getCookie('page');
getMembers(c === undefined ? 1 : c);