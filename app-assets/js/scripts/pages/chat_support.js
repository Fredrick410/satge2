// ===============================
// ---------- FONCTIONS ----------
// ===============================

/**
 * Il nous faut une fonction pour récupérer le JSON des
 * messages et les afficher correctement
 */
function getDateEnLettres(date) {

    var date = new Date(date);

    var mois = new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    return date.getDate() + ' ' + mois[date.getMonth()] + ' ' + date.getFullYear();

}

function getMessagesSupport(auteur, id_membre) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_support.php?id_membre="+id_membre+"&auteur="+auteur);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        var last_date = new Date(0);
        var next_date = new Date(0);
        var date_auj = new Date();
        var date_hier = new Date();
        date_hier.setDate(date_hier.getDate()-1);

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(message) {

            var droite = message.auteur !== auteur ? 'chat-left' : '';
            var image = message.auteur !== "support" ? "../../../src/img/"+message.img_membres : "../../../app-assets/images/ico/chatpix3.png";

            next_date = new Date(message.date_message);
        
            if (next_date > last_date) {

                if (next_date.getDate() == date_auj.getDate() && next_date.getMonth() == date_auj.getMonth() && next_date.getFullYear() == date_auj.getFullYear()) {
                    date_msg = `
                        <div class="badge badge-pill badge-light-secondary my-1">Aujourd'hui</div>`
                } else if (next_date.getDate() == date_hier.getDate() && next_date.getMonth() == date_hier.getMonth() && next_date.getFullYear() == date_hier.getFullYear()) {
                    date_msg = `
                        <div class="badge badge-pill badge-light-secondary my-1">Hier</div>`
                } else {
                    date_msg = `
                        <div class="badge badge-pill badge-light-secondary my-1">${getDateEnLettres(message.date_message)}</div>`
                }

            } else {
                date_msg = '';
            }

            last_date = next_date;
            
            texte = `
                <div class="chat ${droite}">
                    <div class="chat-avatar">
                        <a class="avatar m-0">
                            <img src="${image}" alt="avatar" height="36" width="36" />
                        </a>
                    </div>
                    <div class="chat-body">
                        <div class="chat-message">
                            <p>${message.texte}</p>
                            <span class="chat-time">${message.heure}</span>
                        </div>
                    </div>
                </div>`

            return date_msg + texte;

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
function postMessageSupport(event, auteur, id_membre) {
    
    // 1. Elle doit stoper le submit du formulaire
    event.preventDefault();

    // 2. Elle doit récupérer les données du formulaire
    const texte = document.querySelector('#texte');

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('id_membre', id_membre);
    data.append('auteur', auteur);
    data.append('texte', texte.value);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?method=post');

    requeteAjax.onload = function() {
        texte.value = '';
        texte.focus();
        getMessagesSupport(auteur, id_membre);
    }

    requeteAjax.send(data);
    return false;

}

/**
 * Il nous faut une fonction qui efface tous
 * les messages du chat sans recharger la page
 */
 function deleteMessages(id_membre) {

    // 2. Elle doit récupérer les données du formulaire
    const texte = document.querySelector('#texte');

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('id_membre', id_membre);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_support.php?delete=yes');

    requeteAjax.onload = function() {
        texte.value = '';
        texte.focus();
        getMessagesSupport(auteur, id_membre);
    }

    requeteAjax.send(data);
    return false;

}

// ================================
// ---------- EVENEMENTS ----------
// ================================

const auteur = document.getElementById("auteur").value

// S'execute lorsqu'on clique sur un contact dans "SUPPORT"
$(".chat-support").click(function() {

    // Si on dans le back
    if (auteur == "support") {

        var id = $(this).children('input:nth(0)').val();
        let nom = $(this).children('input:nth(1)').val();
        let img = $(this).children('input:nth(2)').val();

        document.getElementById("id_chat_back").value = id;
        document.getElementById("nom_chat_back").innerHTML = nom;
        document.getElementById("img_chat_back").src = "../../../src/img/" + img;

        getMessagesSupport(auteur, id);

        // Fonction qui recharge les messages toutes les 5 secondes


    // Si on dans le front
    } else {

        document.getElementById("id_chat_front").value = '';
        document.getElementById("nom_chat_front").innerHTML = "Support";
        document.getElementById("img_chat_front").src = "../../../app-assets/images/ico/chatpix3.png";

        var id = document.getElementById("id_session").value;
        getMessagesSupport(auteur, id);

        // Fonction qui recharge les messages toutes les 5 secondes
        

        document.getElementById("type_chat_front").value = "support";
    }

});

// S'execute lorsqu'on appuie sur "Envoyer" un message
$(".btn-envoyer-msg").click(function(event) {
        
    // Si on dans le back
    if (auteur == "support") {
        let id = document.getElementById("id_chat_back").value;
        postMessageSupport(event, "support", id);
    // Si on dans le front
    } else {
        var type_chat = document.getElementById("type_chat_front").value

        // On vérifie que le chat sélectionné est bien le support
        if (type_chat == "support") {
            let id = document.getElementById("id_session").value;
            postMessageSupport(event, "user", id);
        }
    }

});

// S'execute lorsqu'on veut supprimer les messages chat (uniquement côté back)
$("#delete_chat").click(function() {
    var id = document.getElementById("id_chat_back").value;
    deleteMessages(id);
});