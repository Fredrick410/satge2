// ===============================
// ---------- FONCTIONS ----------
// ===============================

function getDateEnLettres(date) {

    let varDate = new Date(date);
    let mois = new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    return varDate.getDate() + ' ' + mois[varDate.getMonth()] + ' ' + varDate.getFullYear();

}

function getTickets(id_membre) {

    const requeteAjax = new XMLHttpRequest();
    // EN LOCAL
    // requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_support.php?method=getTickets&id_membre="+id_membre);
    // EN LIGNE
    requeteAjax.open("GET", "../../../../html/ltr/coqpix/php/chat_support.php?method=getTickets&id_membre="+id_membre);

    requeteAjax.onload = function() {

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(ticket) {

            bold_text = ticket.nb_notifs == 0 ? '' : 'font-weight-bold';
            html_notif = ticket.nb_notifs == 0 ? '' : `<span class="avatar-status-offline bg-primary"></span>`;

            html_ticket = `
                <li class="chat-support">
                    <input type="hidden" value="${ticket.id_ticket}">
                    <input type="hidden" value="${ticket.objet}">
                    <div class="d-flex align-items-center">
                        <div class="avatar m-0 mr-50"><img src="../../../app-assets/images/ico/chatpix3.png" height="36" width="36" alt="loading">`
                        + html_notif +
                        `</div>
                        <div class="chat-sidebar-name">
                            <h6 class="mb-0 ${bold_text}">${ticket.objet}</h6>
                        </div>
                    </div>
                </li>`;

            return html_ticket;

        }).join('');

        const tickets = document.querySelector('.liste-tickets');

        tickets.innerHTML = html;
        tickets.scrollTop = tickets.scrollHeight;

    }

    requeteAjax.send();

}

function getMessagesSupport(auteur, id_ticket) {

    const requeteAjax = new XMLHttpRequest();
    // EN LOCAL
    // requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_support.php?auteur="+auteur+"&id_ticket="+id_ticket);
    // EN LIGNE
    requeteAjax.open("GET", "../../../../html/ltr/coqpix/php/chat_support.php?auteur="+auteur+"&id_ticket="+id_ticket);

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
                        <div class="badge badge-pill badge-light-secondary my-1">Aujourd'hui</div>`;
                } else if (next_date.getDate() == date_hier.getDate() && next_date.getMonth() == date_hier.getMonth() && next_date.getFullYear() == date_hier.getFullYear()) {
                    html_date = `
                        <div class="badge badge-pill badge-light-secondary my-1">Hier</div>`;
                } else {
                    html_date = `
                        <div class="badge badge-pill badge-light-secondary my-1">${getDateEnLettres(message.date_message)}</div>`;
                }

            }

            last_date = next_date;
            
            html_message = `
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
                </div>`;

            return html_date + html_message;

        }).join('');

        const messages = document.querySelector('.chat-content');

        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;

    }

    requeteAjax.send();

}

function postMessageSupport(event, auteur, id_membre, id_ticket) {
    
    event.preventDefault();

    const texte = document.querySelector('#texte');

    const data = new FormData();
    data.append('auteur', auteur);
    data.append('id_membre', id_membre);
    data.append('id_ticket', id_ticket);
    data.append('texte', texte.value);

    const requeteAjax = new XMLHttpRequest();
    // EN LOCAL
    // requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?method=post');
    // EN LIGNE
    requeteAjax.open('POST', '../../../../html/ltr/coqpix/php/chat_support.php?method=post');

    requeteAjax.onload = function() {
        texte.value = '';
        texte.focus();
        getMessagesSupport(auteur, id_ticket);
    }

    requeteAjax.send(data);
    return false;

}

function changerStatutTicket(id_ticket, statut) {

    const data = new FormData();
    data.append('id_ticket', id_ticket);

    const requeteAjax = new XMLHttpRequest();
    // EN LOCAL
    // requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?statut='+statut);
    // EN LIGNE
    requeteAjax.open('POST', '../../../../html/ltr/coqpix/php/chat_support.php?statut='+statut);


    requeteAjax.send(data);
    return false;

}

function changerThemeTicket(id_ticket, theme) {

    const data = new FormData();
    data.append('id_ticket', id_ticket);

    const requeteAjax = new XMLHttpRequest();
    // EN LOCAL
    // requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?theme='+theme);
    // EN LIGNE
    requeteAjax.open('POST', '../../../../html/ltr/coqpix/php/chat_support.php?theme='+theme);

    requeteAjax.send(data);
    return false;

}

// ================================
// ---------- EVENEMENTS ----------
// ================================

auteur = document.getElementById("auteur").value
id_membre = document.getElementById("id_membre").value;

$(document).ready(function() {

    // if (auteur == "user") {
    //     // Si un nouveau ticket vient d'être créé, ouvrir la discussion
    //     if (document.getElementById("req").value != null) {
    //         $(".liste-tickets").children('li:first-child').trigger("click");
    //     }
    // }

    if (auteur == "support") {
        if (document.getElementById("id_ticket").value != null) {
            let id_ticket = document.getElementById("id_ticket").value;
            getMessagesSupport(auteur, id_ticket);
        }
    }

});

getTickets(id_membre);
if (typeof majTickets != 'undefined') {
    clearInterval(majTickets);
}
majTickets = setInterval(function() { getTickets(id_membre); }, 10000);

// S'execute lorsqu'on clique sur un contact dans "SUPPORT"
$(document).on('click', '.chat-support', function() {

    // Si on dans le front
    if (auteur == "user") {

        document.getElementById("type_chat").value = "support";
        document.getElementById("icons_channel").style.display = "none";

        let id_ticket = $(this).children('input:nth(0)').val();
        let objet = $(this).children('input:nth(1)').val();

        document.getElementById("id_chat").value = id_ticket;
        document.getElementById("nom_chat").innerHTML = objet;
        document.getElementById("image_chat").innerHTML = '';

        getMessagesSupport(auteur, id_ticket);
        // Met à jour les messages toutes les 5 secondes
        if (typeof majMessages != 'undefined') {
            clearInterval(majMessages);
        }
        majMessages = setInterval(function() { getMessagesSupport(auteur, id_ticket); }, 5000);

        setTimeout(function() { getTickets(id_membre); }, 100);

    }

});

// S'execute lorsqu'on appuie sur "Envoyer" un message
$(".btn-envoyer-msg").click(function(event) {
        
    // Si on dans le front
    if (auteur == "user") {

        var type_chat = document.getElementById("type_chat").value

        // On vérifie que le chat sélectionné est bien le support
        if (type_chat == "support") {
            let id_membre = document.getElementById("id_membre").value;
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
    let id_membre = document.getElementById("id_membre").value;
    Swal.fire({
        title: 'Contacter le support',
        html:
            `<form method="post" action="php/insert_ticket.php?id_membre=${id_membre}" class="form form-vertical">`+
                '<div class="form-body">'+
                    '<div class="row">'+
                        '<div class="col-12">'+
                            '<div class="form-group">'+
                                '<label for="objet">Objet de la requête</label>'+
                                '<input id="objet" name="objet" type="text" class="form-control" placeholder="" required>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-12">'+
                            '<div class="form-group">'+
                                '<label for="description">Description</label>'+
                                '<textarea id="description" name="description" rows="15" class="form-control" style="resize: none;" placeholder="Posez votre question ici.." required></textarea>'+
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