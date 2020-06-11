const table = document.getElementById('table');

document.querySelector('select').addEventListener('change', function (ev) {
    table.innerHTML = "";

    request('all_table/sorting', {
        "sorting": ev.target.value,
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
        });
    });
});