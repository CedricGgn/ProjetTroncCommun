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

<<<<<<< HEAD
document.addEventListener("DOMContentLoaded", function() {
    var modeButtons = document.getElementById("controler");
    if (modeButtons) { // Vérifiez si l'élément existe avant de modifier son style
        var sessionUsername = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"; // Récupérez la valeur de session.username depuis PHP

        if (sessionUsername !== "admin") {
            modeButtons.style.display = "none";
        }
        else{
            modeButtons.style.display = "flex";
        }
    }
});
=======
// main.js
const userInfo = document.getElementById('user-info'); // Obtenir l'élément avec l'attribut de données
const username = userInfo.dataset.username; // Récupérer la valeur de 'data-username'

console.log("Username from session:", username); // Afficher le nom d'utilisateur

if (username == 'invité'){
    for (let element of document.getElementsByClassName("controler")){
        element.remove();
     }
    for (let element of document.getElementsByClassName("mode")){
        element.remove();
     }
}


// ----------------------- Generate PDF file from table --------------

function generatePDF() {
    const props = {
        outputType: OutputType.Save,
        fileName: 'Invoice 2021',
        // Autres propriétés...
    };

    const pdfObject = jsPDFInvoiceTemplate(props);
    console.log(pdfObject);
}

document.getElementById('download-pdf').addEventListener('click', generatePDF);
>>>>>>> 60f8fa9fa5c2775d343b4fd42b956a91ba210491
