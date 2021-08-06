// ===============================
// ---------- FONCTIONS ----------
// ===============================

/**
 * Il nous faut une fonction pour récupérer le JSON des
 * messages et les afficher correctement
 */
function getDateEnLettres(date) {

    let varDate = new Date(date);
    let mois = new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    return varDate.getDate() + ' ' + mois[varDate.getMonth()] + ' ' + varDate.getFullYear();

}

function getMessages(id_source, id_destination, type_message) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?type_message="+type_message+"&id_source="+id_source+"&id_destination="+id_destination);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        let last_date = new Date(0);
        let next_date = new Date(0);
        let date_auj = new Date();
        let date_hier = new Date();
        date_hier.setDate(date_hier.getDate()-1);

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(message) {

            let message_a_droite = message.id_membre_from == id_source ? '' : 'chat-left';
            let auteur_a_droite = message.id_membre_from == id_source ? 'right' : 'left';

            next_date = new Date(message.date_message);

            let html_date = '';
        
            if (next_date > last_date) {

                if (next_date.getDate() == date_auj.getDate() && next_date.getMonth() == date_auj.getMonth() && next_date.getFullYear() == date_auj.getFullYear()) {
                    html_date = `
                        <div class="badge badge-pill badge-light-secondary my-1">Aujourd'hui</div>`
                } else if (next_date.getDate() == date_hier.getDate() && next_date.getMonth() == date_hier.getMonth() && next_date.getFullYear() == date_hier.getFullYear()) {
                    html_date = `
                        <div class="badge badge-pill badge-light-secondary my-1">Hier</div>`
                } else {
                    html_date = `
                        <div class="badge badge-pill badge-light-secondary my-1">${getDateEnLettres(message.date_message)}</div>`
                }

            }

            last_date = next_date;

            let html_auteur = `
                <div class="mt-1 text-${auteur_a_droite}">
                    <small style="padding-${auteur_a_droite}: 60px;">${message.nom+' '+message.prenom}</small>
                </div>`;
            
            let html_message = `
                <div class="chat ${message_a_droite}">
                    <div class="chat-avatar">
                        <a class="avatar m-0">
                            <img src="../../../src/img/${message.img_membres}" alt="avatar" height="36" width="36" />
                        </a>
                    </div>
                    <div class="chat-body mt-0 mb-1">
                        <div class="chat-message">
                            <p>${message.texte}</p>
                            <span class="chat-time">${message.heure_message.slice(0,5)}</span>
                        </div>
                    </div>
                </div>`;

            if (type_message == "privé") {
                return html_date + html_message;
            }

            if (type_message == "channel") {
                return html_date + html_auteur + html_message;
            }

        }).join('');

        const messages = document.querySelector('.chat-content');

        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;

    }

    // 3. On envoie la requête
    requeteAjax.send();

}

/**
 * Il nous faut une fonction pour envoyer le nouveau
 * message au serveur et rafraichir les messages
 */
function postMessage(event, id_source, id_destination, type_message) {

    // 1. Elle doit stoper le submit du formulaire
    event.preventDefault();

    // 2. Elle doit récupérer les données du formulaire
    const texte = document.querySelector('#texte');

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('type_message', type_message);
    data.append('id_source', id_source);
    data.append('id_destination', id_destination);
    data.append('texte', texte.value);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?method=post');

    requeteAjax.onload = function() {
        texte.value = '';
        texte.focus();
        getMessages(id_source, id_destination, type_message);
    }

    requeteAjax.send(data);
    return false;

}

// S'execute lorsqu'on clique sur un contact dans "CHAT INTERNE"
$(".chat-privé").click(function() {

    let id_session = document.getElementById("id_session").value;

    let id = $(this).children('input:nth(0)').val();
    let nom = $(this).children('input:nth(1)').val();
    let img = $(this).children('input:nth(2)').val();

    document.getElementById("id_chat").value = id;
    document.getElementById("nom_chat").innerHTML = nom;
    document.getElementById("image_chat").innerHTML = `<img src="../../../src/img/${img}" alt="avatar" height="36" width="36" />`;

    getMessages(id_session, id, "privé");

    document.getElementById("type_chat").value = "privé";

});

// S'execute lorsqu'on clique sur le chat global dans "CHAT INTERNE"
$(".chat-channel").click(function() {
    
    let id_session = document.getElementById("id_session").value;

    let id = $(this).children('input:nth(0)').val();
    let nom = $(this).children('input:nth(1)').val();

    document.getElementById("id_chat").value = id;
    document.getElementById("nom_chat").innerHTML = nom;
    document.getElementById("image_chat").innerHTML = '';

    getMessages(id_session, id, "channel");

    document.getElementById("type_chat").value = "channel";

});

// S'execute lorsqu'on appuie sur "Envoyer" un message
$(".btn-envoyer-msg").click(function(event) {

    let type_chat = document.getElementById("type_chat").value
    let id_session = document.getElementById("id_session").value;
    let id = document.getElementById("id_chat").value;

    // On vérifie que le chat sélectionné est bien le support
    if (type_chat == "privé") {
        postMessage(event, id_session, id, "privé");
    }

    if (type_chat == "channel") {
        postMessage(event, id_session, id, "channel");
    }

});