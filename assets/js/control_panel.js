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

            element.insertAdjacentHTML('beforeend', '<td scope="row">' + entry['id'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['name'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['surname'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['date_of_birth'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['weight'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['club'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['place_of_living'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['sex'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td><a href="">Изменить</a></td>');

            table.insertAdjacentElement('beforeend', element);
            pagebyId.innerText = received.page;
            pageCount.innerText = received.pageCount;
        });
    });

}

function prev() {
    getMembers(parseInt(pagebyId.innerText) - 1);
}

function next() {
    getMembers(parseInt(pagebyId.innerText) + 1);
}

const c = getCookie('page');
getMembers(c === undefined ? 1 : c);

// function getBooks(p) {
//     request('nick/get_all', {
//         ['page']: p
//     }, (response) => {
//         const received = response;
//         setCookie('page', received.page);
//         page.innerText = received.page;
//         pageCount.innerText = received.pageCount;
//         catalog.innerText = '';
//         received.nicks.forEach(function (entry) {
//             let item = document.createElement('tr');
//             let th = document.createElement('th');
//             th.setAttribute("scope", "row");
//             th.innerText = entry.id;
//             item.appendChild(th);
//             let td= document.createElement('td');
//             td.innerText = entry.nick;
//             item.appendChild(td);
//             catalog.appendChild(item);
//         });
//     }, (response) => {
//         console.log(response);
//         alert(JSON.parse(response['issueMessage']));
//     });
// }