// ===============================
// ---------- FONCTIONS ----------
// ===============================

function getTicketsSupport(filtre) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/ticket_support.php?filtre="+filtre);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(ticket) {

            let statut = '';
            if (ticket.statut == "OUVERT") {
                statut = "success";
            } else if (ticket.statut == "URGENT") {
                statut = "warning";
            } else {
                statut = "danger"
            }

            if (ticket.nb_notifs > 0) {

                return `
                    <a href="helpdesk-chat-support.php?id_ticket=${ticket.id_ticket}" class="row-ticket"><li class="todo-item py-1 px-1 text-dark font-weight-bold border border-light">
                        <div class="d-flex justify-content-sm-between justify-content-end align-items-center">
                            <div>
                                <p class="mx-50 m-0 truncate">${ticket.objet}</p>
                                <small class="mx-50 m-0 truncate">${ticket.nom + ' ' + ticket.prenom + ' | ' + ticket.nameentreprise}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="d-flex mr-1">
                                    <span class="badge badge-light-primary badge-pill">${ticket.nb_notifs} non lu(s)</span>
                                </div>
                                <div class="d-flex">
                                    <span class="badge badge-light-${statut} badge-pill">${ticket.statut}</span>
                                </div>
                            </div>
                        </div>
                    </li></a>`

                } else {

                return `
                    <a href="helpdesk-chat-support.php?id_ticket=${ticket.id_ticket}" class="row-ticket"><li class="todo-item py-1 px-1 text-light font-weight-bold border border-light" style="background-color: #F2F4F4;">
                        <div class="d-flex justify-content-sm-between justify-content-end align-items-center">
                            <div>
                                <p class="mx-50 m-0 truncate">${ticket.objet}</p>
                                <small class="mx-50 m-0 truncate">${ticket.nom + ' ' + ticket.prenom + ' | ' + ticket.nameentreprise}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="d-flex">
                                    <span class="badge badge-light-${statut} badge-pill">${ticket.statut}</span>
                                </div>
                            </div>
                        </div>
                    </li></a>`

                }

        }).join('');

        const messages = document.querySelector('.ticket-content');

        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;

    }

    // 3. On envoie la requête
    requeteAjax.send();

}

getTicketsSupport("all");

$(".all-tickets").click(function(e) {
    e.preventDefault;
    getTicketsSupport("all");
});

$(".filtre-non-lu").click(function(e) {
    e.preventDefault;
    getTicketsSupport("non lu");
});

$(".filtre-ouvert").click(function(e) {
    e.preventDefault;
    getTicketsSupport("ouvert");
});

$(".filtre-fermé").click(function(e) {
    e.preventDefault;
    getTicketsSupport("fermé");
});