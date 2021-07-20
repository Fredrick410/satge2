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

function getMessages(id_membre_1, id_membre_2) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?id_membre_1="+id_membre_1+"&id_membre_2="+id_membre_2);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        var last_date = new Date(0);
        var next_date = new Date(0);
        var date_auj = new Date();
        var date_hier = new Date();
        date_hier.setDate(date_hier.getDate()-1);

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(message) {

            var droite = message.id_membre_from !== id_membre_1 ? 'chat-left' : '';
            var image = message.id_membre_from !== id_membre_1 ? message.img_2 : message.img_1;

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
                            <img src="../../../src/img/${image}" alt="avatar" height="36" width="36" />
                        </a>
                    </div>
                    <div class="chat-body">
                        <div class="chat-message">
                            <p>${message.texte}</p>
                            <span class="chat-time">${message.heure_message}</span>
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
function postMessage(event, id_membre_1, id_membre_2) {
    
    // 1. Elle doit stoper le submit du formulaire
    event.preventDefault();

    // 2. Elle doit récupérer les données du formulaire
    const texte = document.querySelector('#texte');

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('id_membre_1', id_membre_1);
    data.append('id_membre_2', id_membre_2);
    data.append('texte', texte.value);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../coqpix/html/ltr/coqpix/php/chat_interne.php?method=post');

    requeteAjax.onload = function() {
        texte.value = '';
        texte.focus();
        getMessages(auteur, id_membre_1, id_membre_2);
    }

    requeteAjax.send(data);
    return false;

}

// S'execute lorsqu'on clique sur un contact dans "SUPPORT"
$(".chat-interne").click(function() {

    var id_session = document.getElementById("id_session").value;

    let id = $(this).children('input:nth(0)').val();
    let nom = $(this).children('input:nth(1)').val();
    let img = $(this).children('input:nth(2)').val();

    document.getElementById("id_chat_back").value = id;
    document.getElementById("nom_chat_back").innerHTML = nom;
    document.getElementById("img_chat_back").src = "../../../src/img/" + img;

    getMessages(id_session, id);

    // Fonction qui recharge les messages toutes les 5 secondes
    setInterval(function() {
        let id = document.getElementById("id_chat_back").value;
        getMessages(id_session, id);
    }, 5000);

    document.getElementById("type_chat_front").value = "interne";

});