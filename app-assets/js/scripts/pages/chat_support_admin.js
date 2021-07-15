/**
 * Codons un chat en HTML/CSS/Javascript avec nos amis PHP et MySQL
 */

/**
 * Il nous faut une fonction pour récupérer le JSON des
 * messages et les afficher correctement
 */
function getMessages() {

    var id_membre = 1; // recuperer l'id du membre selectionnee dans la liste

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../html/ltr/coqpix/php/chat_helpdesk_admin.php?id_membre="+id_membre);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

    const resultat = JSON.parse(requeteAjax.responseText);
    const html = resultat.reverse().map(function(message) {

        var droite = message.auteur !== "support" ? 'chat-left' : '';
        var image = message.auteur !== "support" ? 'astro1.gif' : 'chatpix3.png';

        return `
            <div class="chat ${droite}">
                <div class="chat-avatar">
                    <a class="avatar m-0">
                        <img src="../../../app-assets/images/ico/${image}" alt="avatar" height="36" width="36" />
                    </a>
                </div>
                <div class="chat-body">
                    <div class="chat-message">
                        <p>${message.texte}</p>
                        <span class="chat-time">${message.heure}</span>
                    </div>
                </div>
            </div>`

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
function postMessage(event) {
    
    // 1. Elle doit stoper le submit du formulaire
    event.preventDefault();

    // 2. Elle doit récupérer les données du formulaire
    // const id_client = document.querySelector('#id_client');
    // const author = document.querySelector('#author');
    const texte = document.querySelector('#texte');

    // 3. Elle doit conditionner les données
    const data = new FormData();
    data.append('id_membre', 1);
    data.append('auteur', "support");
    data.append('texte', texte.value);

    // 4. Elle doit configurer une requête ajax en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../../../html/ltr/coqpix/php/chat_helpdesk_admin.php?method=post');

    requeteAjax.onload = function() {
        texte.value = '';
        texte.focus();
        getMessages();
    }

    requeteAjax.send(data);
    return false;

}

getMessages();

/**
 * Il nous faut une intervale qui demande le rafraichissement
 * des messages toutes les 5 secondes et qui donne 
 * l'illusion du temps réel.
 */
const interval = window.setInterval(getMessages, 5000);

document.getElementById('btn_submit').addEventListener('click', event => {
    postMessage(event);
});