function pressStart() {
    let category = document.querySelector('select').value;
    window.open("/competition/start/" + category, "_self")
}
