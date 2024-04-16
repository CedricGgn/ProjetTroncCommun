// Écouteur d'événements pour empêcher le comportement par défaut des touches fléchées et de la barre d'espace
window.addEventListener("keydown", function(e) {
    if(["ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);

document.addEventListener('keydown', (ev) => {
    const key = ev.key;
    const element = document.querySelector(
        '[data-keyboard-key="' + key + '"]'
    );
    element.classList.add('active');

    var table = document.getElementById("keyPressTable").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(0);
    var dateCell = newRow.insertCell(0);
    var directionCell = newRow.insertCell(1);
    var date = new Date();
    dateCell.innerHTML = date.toLocaleTimeString();
    directionCell.innerHTML = key.split('Arrow')[1];
});

document.addEventListener('keyup', (ev) => {
    const key = ev.key;
    const element = document.querySelector(
        '[data-keyboard-key="' + key + '"]'
    );
    element.classList.remove('active');
});