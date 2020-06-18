const url = window.location.pathname.split("/");
const param = url[url.length - 1];

const dTHead = document.getElementById('thead');
const dTBody = document.getElementById('tbody');
const dTBodyTimer = document.getElementById('tbodyTimer');

const map = new Map();

function calc() {
    const _map = new Map();
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

Element.prototype.generateTHeadElement = function (content = '') {
    const element = document.createElement('th');
    element.setAttribute('scope', 'col');
    element.innerText = content;
    this.insertAdjacentElement('beforeend', element);
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
    dTBody.insertAdjacentElement('beforeend', element);
}

function start(timer) {
    if (timer.data !== undefined) return;
    if (!timer.paused) timer.innerText = 120;
    timer.paused = false;
    timer.data = setInterval(() => {
        if (--timer.innerText === 0) {
            clearInterval(timer.data);
            timer.data = undefined;
        }
    }, 1000);
}

function pause(timer) {
    timer.paused = true;
    if (timer.data === undefined) return;
    clearInterval(timer.data);
    timer.data = undefined;
}

function stop(timer) {
    timer.paused = false;
    if (timer.data === undefined) return;
    clearInterval(timer.data);
    timer.data = undefined;
}

Element.prototype.generateControl = function (name, timer, task) {
    const element = document.createElement('a');
    element.innerHTML = name;
    element.setAttribute("task", task);
    console.log(self);
    element.onclick = () => self[task](timer);
    this.insertAdjacentElement('beforeend', element);
    return element;
};

function generateTBodyTimerElement(member1, member2, fightId) {
    const element = document.createElement('tr');
    element.generateTData1(member1.surname);
    element.generateTData1(member2.surname);
    const tdTimer = element.generateTData1('120');
    const tdControls = element.generateTData1();
    tdControls.style.display = 'flex';
    tdControls.generateControl('Старт', tdTimer, "start").style.flex = 1;
    tdControls.generateControl('<img src="/assets/img/pause.png" width="40" height="33.6">', tdTimer, "pause").style.flex = 1;
    tdControls.generateControl('<img src="/assets/img/play.png" width="40" height="33.6">', tdTimer, "stop").style.flex = 1;
    dTBodyTimer.insertAdjacentElement('beforeend', element);
}

request('all_table/sorting', {
    "sorting": param
}, (json) => {
    const members = json.members;

    dTHead.generateTHeadElement();

    let fightId = 0;
    members.forEach((member, index) => {
        dTHead.generateTHeadElement(member.surname);
        generateTBodyElement(member, members);
        for (let i = index + 1; i < members.length; i++) {
            generateTBodyTimerElement(member, members[i], fightId++);
        }
    });

    dTHead.generateTHeadElement();
    dTHead.generateTHeadElement();
});