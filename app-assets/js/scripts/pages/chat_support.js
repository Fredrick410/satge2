// ===============================
// ---------- FONCTIONS ----------
// ===============================

const auteur = document.getElementById("auteur").value

$(document).ready(function() {

    if (auteur == "user") {
        if (document.getElementById("req").value != null) {
            $(".liste-chat-support").children('li:last-child').trigger("click");
        }
    }

    if (auteur == "support") {
        if (document.getElementById("id_ticket").value != null) {
            let id_ticket = document.getElementById("id_ticket").value;
            getMessagesSupport(auteur, id_ticket);
        }
    }

});

/**
 * Il nous faut une fonction pour récupérer le JSON des
 * messages et les afficher correctement
 */
function getDateEnLettres(date) {

    let varDate = new Date(date);
    let mois = new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    return varDate.getDate() + ' ' + mois[varDate.getMonth()] + ' ' + varDate.getFullYear();

}

function getMessagesSupport(auteur, id_ticket) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_support.php?auteur="+auteur+"&id_ticket="+id_ticket);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        let last_date = new Date(0);
        let next_date = new Date(0);
        let date_auj = new Date();
        let date_hier = new Date();
        date_hier.setDate(date_hier.getDate()-1);

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(message) {

            let message_a_droite = message.auteur == auteur ? '' : 'chat-left';
            let image = message.auteur == "support" ? "../../../app-assets/images/ico/chatpix3.png" : "../../../src/img/" + message.img_membres;

            next_date = new Date(message.date_message);

            html_date = '';
        
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
            
            let html_message = `
                <div class="chat ${message_a_droite}">
                    <div class="chat-avatar">
                        <a class="avatar m-0">
                            <img src="${image}" alt="avatar" height="36" width="36" />
                        </a>
                    </div>
                    <div class="chat-body">
                        <div class="chat-message">
                            <p>${message.texte}</p>
                            <span class="chat-time">${message.heure.slice(0,5)}</span>
                        </div>
                    </div>
                </div>`

            return html_date + html_message;

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
function postMessageSupport(event, auteur, id_membre, id_ticket) {
    
    // 1. Elle doit stoper le submit du formulaire
    event.preventDefault();

    // 2. Elle doit récupérer les données du formulaire
    const texte = document.querySelector('#texte');

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('auteur', auteur);
    data.append('id_membre', id_membre);
    data.append('id_ticket', id_ticket);
    data.append('texte', texte.value);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?method=post');

    requeteAjax.onload = function() {
        texte.value = '';
        texte.focus();
        getMessagesSupport(auteur, id_ticket);
    }

    requeteAjax.send(data);
    return false;

}

/**
 * Il nous faut une fonction qui permet de changer
 * le statut d'un ticket sans recharger la page
 */
function changerStatutTicket(id_ticket, statut) {

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('id_ticket', id_ticket);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?statut='+statut);

    requeteAjax.send(data);
    return false;

}

/**
 * Il nous faut une fonction qui permet de changer
 * le theme d'un ticket sans recharger la page
 */
 function changerThemeTicket(id_ticket, theme) {

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('id_ticket', id_ticket);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?theme='+theme);

    requeteAjax.send(data);
    return false;

}

// ================================
// ---------- EVENEMENTS ----------
// ================================

// S'execute lorsqu'on clique sur un contact dans "SUPPORT"
$(".chat-support").click(function() {

    // Si on dans le front
    if (auteur == "user") {

        let id_ticket = $(this).children('input:nth(0)').val();
        let objet = $(this).children('input:nth(1)').val();

        document.getElementById("id_chat").value = id_ticket;
        document.getElementById("nom_chat").innerHTML = objet;
        document.getElementById("image_chat").src = "../../../app-assets/images/ico/chatpix3.png";

        getMessagesSupport(auteur, id_ticket);

        document.getElementById("type_chat").value = "support";
    }

});

// S'execute lorsqu'on appuie sur "Envoyer" un message
$(".btn-envoyer-msg").click(function(event) {
        
    // Si on dans le front
    if (auteur == "user") {

        var type_chat = document.getElementById("type_chat").value

        // On vérifie que le chat sélectionné est bien le support
        if (type_chat == "support") {
            let id_membre = document.getElementById("id_session").value;
            let id_ticket = document.getElementById("id_chat").value;
            postMessageSupport(event, "user", id_membre, id_ticket);
        }

    } else {
        let id_membre = document.getElementById("id_membre").value;
        let id_ticket = document.getElementById("id_ticket").value;
        postMessageSupport(event, "support", id_membre, id_ticket);
    }

});

// S'execute lorsqu'on clique sur le cadenas (fermer ou ouvrir un ticket)
$("#fermer_ticket").click(function(e) {
    e.preventDefault
    let id_ticket = document.getElementById("id_ticket").value;
    let statut = document.getElementById("statut").textContent;
    if (statut == "fermé") {
        document.getElementById("statut_ticket").innerHTML = `<span id="statut" class="badge badge-light-success badge-pill ml-1">ouvert</span>`;
        changerStatutTicket(id_ticket, "ouvert");
    } else {
        document.getElementById("statut_ticket").innerHTML = `<span id="statut" class="badge badge-light-danger badge-pill ml-1">fermé</span>`;
        changerStatutTicket(id_ticket, "fermé");
    }
});

// S'execute lorsqu'on clique sur l'icone jaune (mettre un ticket en urgent)
$("#ticket_urgent").click(function(e) {
    e.preventDefault
    let id_ticket = document.getElementById("id_ticket").value;
    let statut = document.getElementById("statut").textContent;
    if (statut == "urgent") {
        document.getElementById("statut_ticket").innerHTML = `<span id="statut" class="badge badge-light-success badge-pill ml-1">ouvert</span>`;
        changerStatutTicket(id_ticket, "ouvert");
    } else {
        document.getElementById("statut_ticket").innerHTML = `<span id="statut" class="badge badge-light-warning badge-pill ml-1">urgent</span>`;
        changerStatutTicket(id_ticket, "urgent");
    }
});

$(".theme-ticket").click(function(e) {
    e.preventDefault
    let id_ticket = document.getElementById("id_ticket").value;
    let theme = $(this).children('span')[1].textContent;
    changerThemeTicket(id_ticket, theme);
});

// S'execute lorsqu'on clique sur "Envoyer une requête" dans Support
$('#btn_demande_req').on('click', function () {
    let id_membre = document.getElementById("id_session").value;
    Swal.fire({
        title: 'Contacter le support',
        html:
            `<form method="post" action="php/insert_ticket.php?id_membre=${id_membre}" class="form form-vertical">`+
                '<div class="form-body">'+
                    '<div class="row">'+
                        '<div class="col-12">'+
                            '<div class="form-group">'+
                                '<label for="objet">Objet de la requête</label>'+
                                '<input type="text" id="objet" class="form-control" name="objet" placeholder="" required>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-12">'+
                            '<div class="form-group">'+
                                '<label for="description">Description</label>'+
                                '<textarea rows="15" id="description" class="form-control" style="resize: none;" name="description" placeholder="Posez votre question ici.." required></textarea>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-12 d-flex justify-content-end">'+
                            '<button id="btn_envoyer_req" name="btn_envoyer_req" type="submit" class="btn btn-primary mr-1 mb-1">Envoyer</button>'+
                            '<button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</form>',
        showCloseButton: true,
        showConfirmButton: false,
        buttonsStyling: false,
    })
});