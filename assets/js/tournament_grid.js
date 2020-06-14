const url = window.location.pathname.split("/");
const param = url[url.length - 1];

const thead = document.getElementById('thead');
const tbody = document.getElementById('tbody');

let map = new Map();

function calc() {
    let _map = new Map();
    map.forEach((v, k) => {
        const score = Number.parseInt(k.innerText);
        if (isNaN(score)) return;
        let array = _map.get(score);
        if (array === undefined) {
            array = [];
            _map.set(score, array);
        }
        array.push(v);
    });
    let place = 1;
    [..._map].sort((a, b) => a[0] > b[0] ? -1 : a[0] < b[0] ? 1 : 0).forEach(v => {
        v[1].forEach(_v => _v.innerText = place);
        place++;
    });
}

Element.prototype.calculate = function () {
    let result = 0;
    const elements = this.parentElement.children;
    for (let i = 1; i < elements.length - 2; i++) {
        const element = elements[i];
        if (element.getAttribute('contenteditable') === 'true') {
            const add = Number.parseInt(element.innerText);
            if (isFinite(add)) {
                result += add;
            } else {
                result = '';
                break;
            }
        }
    }
    elements[elements.length - 2].innerText = result;
    calc();
}

function generateTHeadElement(content = '') {
    const element = document.createElement('th');
    element.setAttribute('scope', 'col');
    element.innerText = content;
    thead.insertAdjacentElement('beforeend', element);
}

Element.prototype.generateTData1 = function (content = '') {
    const element = document.createElement('td');
    element.innerText = content;
    this.insertAdjacentElement('beforeend', element);
    return element;
}

Element.prototype.generateTData2 = function (editable) {
    const element = document.createElement('td');
    element.setAttribute('contenteditable', editable);
    element.onkeyup = element.calculate;
    if (!editable) element.style.backgroundColor = '#666';
    this.insertAdjacentElement('beforeend', element);
}

function generateTBodyElement(member, members) {
    const element = document.createElement('tr');
    element.generateTData1(member.surname);
    members.forEach(m => element.generateTData2(m !== member));
    map.set(element.generateTData1(), element.generateTData1());
    tbody.insertAdjacentElement('beforeend', element);
}

request('all_table/sorting', {
    "sorting": param
}, (json) => {
    const members = json.members;

    generateTHeadElement();

    members.forEach(member => {
        generateTHeadElement(member.surname);
        generateTBodyElement(member, members);
    });

    generateTHeadElement();
    generateTHeadElement();
});