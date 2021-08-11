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

            let message_a_droite = '';
            let auteur_a_droite = '';

            if (type_message === "privé") {
                message_a_droite = message.id_membre_from == id_source ? '' : 'chat-left';
            }
            if (type_message === "channel") {
                message_a_droite = message.id_membre == id_source ? '' : 'chat-left';
                auteur_a_droite = message.id_membre == id_source ? 'right' : 'left';
            }

            next_date = new Date(message.date_message);

            let html_date = '';
        
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

            html_auteur = `
                <div class="mt-1 text-${auteur_a_droite}">
                    <small style="padding-${auteur_a_droite}: 60px;">${message.nom+' '+message.prenom}</small>
                </div>`;
            
            html_message = `
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

function getMembres(id_membre, id_entreprise) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?method=getMembres&id_membre="+id_membre+"&id_entreprise="+id_entreprise);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(membre) {

            bold_text = membre.nb_notifs == 0 ? '' : 'font-weight-bold';
            html_notifs = membre.nb_notifs == 0 ? '' : `<span class="avatar-status-offline bg-primary"></span>`;

            html_membre = `
                <li class="chat-privé">
                    <input type="hidden" value="${membre.id}">
                    <input type="hidden" value="${membre.nom + ' ' + membre.prenom}">
                    <input type="hidden" value="${membre.img_membres}">
                    <div class="d-flex align-items-center">
                        <div class="avatar m-0 mr-50"><img src="../../../src/img/${membre.img_membres}" height="36" width="36" alt="loading">`
                        + html_notifs +
                        `</div>
                        <div class="chat-sidebar-name">
                            <h6 class="mb-0 ${bold_text}">${membre.nom + ' ' + membre.prenom}</h6><span class="text-muted ${bold_text}">${membre.role_membres}</span>
                        </div>
                    </div>
                </li>`;

            return html_membre;

        }).join('');

        const membres = document.querySelector('.liste-membres');

        membres.innerHTML = html;
        membres.scrollTop = membres.scrollHeight;

    }

    // 3. On envoie la requête
    requeteAjax.send();

}

function getMembresChannel(id_membre, id_channel) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?method=getMembresChannel&id_membre="+id_membre+"&id_channel="+id_channel);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(membre) {

            html_membre = `
                <div class="col-12 d-flex justify-content-between mt-1">
                    <div class="d-flex">
                        <div class="avatar m-0 mr-50">
                            <img src="../../../src/img/${membre.img_membres}" height="36" width="36" alt="loading">
                        </div>
                        <div class="chat-sidebar-name">
                            <div class="text-left">
                                <h6 class="mb-0">${membre.nom + ' ' + membre.prenom}</h6>
                                <span class="text-muted">${membre.role_membres}</span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-delete-membre-channel">
                        <input type="hidden" value="${membre.id}">
                        <button type="button" class="btn btn-outline-danger">
                            Supprimer
                        </button>
                    </div>
                </div>`;

            return html_membre;

        }).join('');
        
        const membres = document.querySelector('.add-channel');

        membres.innerHTML = html;
        membres.scrollTop = membres.scrollHeight;

    }

    // 3. On envoie la requête
    requeteAjax.send();

}

function getMembresNotInChannel(id_entreprise, id_channel) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?method=getMembresNotInChannel&id_entreprise="+id_entreprise+"&id_channel="+id_channel);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        const resultat = JSON.parse(requeteAjax.responseText);
        html = '';

        if (resultat != '') {

            html = resultat.reverse().map(function(membre) {
    
                html_membre = `
                    <div class="col-12 d-flex justify-content-between mt-1">
                        <div class="d-flex">
                            <div class="avatar m-0 mr-50">
                                <img src="../../../src/img/${membre.img_membres}" height="36" width="36" alt="loading">
                            </div>
                            <div class="chat-sidebar-name">
                                <div class="text-left">
                                    <h6 class="mb-0">${membre.nom + ' ' + membre.prenom}</h6>
                                    <span class="text-muted">${membre.role_membres}</span>
                                </div>
                            </div>
                        </div>
                        <div class="btn-add-membre-channel">
                            <input type="hidden" value="${membre.id}">
                            <button type="button" class="btn btn-outline-primary">
                                Ajouter
                            </button>
                        </div>
                    </div>`;
    
                return html_membre;
    
            }).join('');

        } else {

            html = `
                <div class="col-12 d-flex justify-content-center mt-1">
                    <div>
                        <i class="bx bx-error-circle font-large-2"></i>
                        <h5>Aucun membre</h5>
                        <h5>disponible</h5>
                    </div>
                </div>`;

        }
        
        const membres = document.querySelector('.add-channel');

        membres.innerHTML = html;
        membres.scrollTop = membres.scrollHeight;

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

function addMembreChannel(id_membre, id_channel) {

    const data = new FormData();
    data.append('id_membre', id_membre);
    data.append('id_channel', id_channel);

    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?method=addMembreChannel');

    requeteAjax.send(data);
    return false;

}

function deleteMembreChannel(id_membre, id_channel) {

    const data = new FormData();
    data.append('id_membre', id_membre);
    data.append('id_channel', id_channel);

    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?method=deleteMembreChannel');

    requeteAjax.send(data);
    return false;

}

// ================================
// ---------- EVENEMENTS ----------
// ================================

id_membre = document.getElementById("id_session").value;
id_entreprise = document.getElementById("id").value;
getMembres(id_membre, id_entreprise); 

// S'execute lorsqu'on clique sur un contact dans "CHAT INTERNE"
$(document).on('click', '.chat-privé', function() {

    let id_session = document.getElementById("id_session").value;

    let id = $(this).children('input:nth(0)').val();
    let nom = $(this).children('input:nth(1)').val();
    let img = $(this).children('input:nth(2)').val();

    document.getElementById("id_chat").value = id;
    document.getElementById("nom_chat").innerHTML = nom;
    document.getElementById("image_chat").innerHTML = `<img src="../../../src/img/${img}" alt="avatar" height="36" width="36" />`;

    getMessages(id_session, id, "privé");

    document.getElementById("type_chat").value = "privé";
    document.getElementById("icons_channel").style.display = "none";

});

// S'execute lorsqu'on clique sur le chat global dans "CHAT INTERNE"
$(".chat-channel").click(function() {
    
    console.log("OK");
    let id_session = document.getElementById("id_session").value;

    let id = $(this).children('input:nth(0)').val();
    let nom = $(this).children('input:nth(1)').val();

    document.getElementById("id_chat").value = id;
    document.getElementById("nom_chat").innerHTML = nom;
    document.getElementById("image_chat").innerHTML = '';

    getMessages(id_session, id, "channel");

    document.getElementById("type_chat").value = "channel";
    document.getElementById("icons_channel").style.display = "block";

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

// S'execute lorsqu'on veut créer un channel en cliquant sur la croix (à droite de "CHAT INTRA-ENTREPRISE")
$('#creer_channel').on('click', function () {
    let id_membre = document.getElementById("id_session").value;
    let id_entreprise = document.getElementById("id").value;
    Swal.fire({
        title: 'Créer un channel',
        html:
            `<form method="post" action="php/insert_channel.php?id_membre=${id_membre}&id_entreprise=${id_entreprise}" class="form form-vertical">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nom_channel">Nom du channel</label>
                                <input id="nom_channel" name="nom_channel" type="text" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="custom-control custom-switch custom-control-inline mb-1">
                                <input type="checkbox" class="custom-control-input" id="customSwitch" name="all_membres">
                                <label class="custom-control-label mr-1" for="customSwitch">
                                </label>
                                <span>Ajouter tous les membres de l'entreprise</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button id="btn_creer_channel" name="btn_creer_channel" type="submit" class="btn btn-primary mr-1 mb-1">Valider</button>
                        </div>
                    </div>
                </div>
            </form>`,
        showCloseButton: true,
        showConfirmButton: false,
        buttonsStyling: false,
    })  
});

// S'execute lorsqu'on veut modifier la liste des membres du channel
$('#get_membres_not_in_channel').on('click', function() {
    let id_entreprise = document.getElementById("id").value;
    let id_channel = document.getElementById("id_chat").value;
    Swal.fire({
        title: 'Ajouter des participants',
        html:
            `<div class="row add-channel mb-1">

            </div>`,
        showCloseButton: true,
        showConfirmButton: false,
        buttonsStyling: false,
    }) 
    getMembresNotInChannel(id_entreprise, id_channel);
});

// S'execute lorsqu'on veut modifier la liste des membres du channel
$('#get_membres_channel').on('click', function() {
    let id_membre = document.getElementById("id_session").value;
    let id_channel = document.getElementById("id_chat").value;
    Swal.fire({
        title: 'Liste des participants',
        html:
            `<div class="row add-channel mb-1">

            </div>`,
        showCloseButton: true,
        showConfirmButton: false,
        buttonsStyling: false,
    }) 
    getMembresChannel(id_membre, id_channel);
});

$(document).on('click', '.btn-add-membre-channel', function() {
    id_membre = $(this).children('input')[0].value;
    id_entreprise = document.getElementById("id").value;
    id_channel = document.getElementById("id_chat").value;
    addMembreChannel(id_membre, id_channel);
    $(this).html(
        `<div class="btn btn-outline-white" style="width: 96.24px;">
            Ajouté
        </div>`);
});

$(document).on('click', '.btn-delete-membre-channel', function() {
    id_membre = $(this).children('input')[0].value;
    id_entreprise = document.getElementById("id").value;
    id_channel = document.getElementById("id_chat").value;
    deleteMembreChannel(id_membre, id_channel);
    $(this).parent().remove();
});