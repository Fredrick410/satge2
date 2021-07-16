/**
 * Codons un chat en HTML/CSS/Javascript avec nos amis PHP et MySQL
 */

/**
 * Il nous faut une fonction pour récupérer le JSON des
 * messages et les afficher correctement
 */

function getMessages(){
  var author_id = document.getElementById("author").value;
  // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open("GET", "../../../../html/ltr/coqpix/php/chat_crea.php?destination="+author_id );

  // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
  requeteAjax.onload = function(){
    
    const resultat = JSON.parse(requeteAjax.responseText);
    const html = resultat.reverse().map(function(message){

      var droite = message.you != "coqpix" ? 'chat-left' : '';
        
      return `<div class="chat ${droite}">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>${message.message_crea}</p>
                                    <span class="chat-time">${message.date_h}:${message.date_m}</span>
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

function postMessage(event){
  // 1. Elle doit stoper le submit du formulaire
  event.preventDefault();

  // 2. Elle doit récupérer les données du formulaire
  const id_client = document.querySelector('#id_client');
  const author = document.querySelector('#author');
  const content = document.querySelector('#content');

  // 3. Elle doit conditionner les données
  const data = new FormData();
  data.append('id_client', id_client.value);
  data.append('author', author.value);
  data.append('content', content.value);

  // 4. Elle doit configurer une requête ajax en POST et envoyer les données
  const requeteAjax = new XMLHttpRequest();
  requeteAjax.open('POST', '../../../../html/ltr/coqpix/php/chat_crea.php?task=write');
  
  requeteAjax.onload = function(){
    content.value = '';
    content.focus();
    getMessages();
  }

  

  requeteAjax.send(data);
  return false;

}

document.getElementById('btn_submit').addEventListener('click', event => {
  postMessage(event);
});

/**
 * Il nous faut une intervale qui demande le rafraichissement
 * des messages toutes les 3 secondes et qui donne 
 * l'illusion du temps réel.
 */
const interval = window.setInterval(getMessages, 1000);

getMessages();