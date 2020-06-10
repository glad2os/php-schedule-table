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

            element.insertAdjacentHTML('beforeend', '<td>' + entry['id'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['name'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['surname'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['date_of_birth'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['weight'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['club'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['place_of_living'] + '</td>');
            element.insertAdjacentHTML('beforeend', '<td>' + entry['sex'] + '</td>');

            table.insertAdjacentElement('beforeend', element);
            pagebyId.innerText = received.page;
            pageCount.innerText = received.pageCount;
        });
    });

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
