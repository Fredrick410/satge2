// ===============================
// ---------- FONCTIONS ----------
// ===============================

function getTicketsSupport(filtre) {

    // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
    const requeteAjax = new XMLHttpRequest();
    // EN LOCAL
    // requeteAjax.open("GET", "../../../../coqpix/html/ltr/coqpix/php/ticket_support.php?filtre="+filtre);
    // EN LIGNE
    requeteAjax.open("GET", "../../../../html/ltr/coqpix/php/ticket_support.php?filtre="+filtre);

    // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
    requeteAjax.onload = function() {

        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(ticket) {

            let html_statut = '';
            if (ticket.statut == "OUVERT") {
                html_statut = "success";
            } else if (ticket.statut == "URGENT") {
                html_statut = "warning";
            } else {
                html_statut = "danger";
            }

            let html_theme = '';
            if (ticket.theme == "COMPTA") {
                html_theme = `<span class="bullet bullet-sm" style="background-color: yellow;"></span>`;
            } else if (ticket.theme == "JURIDIQUE") {
                html_theme = `<span class="bullet bullet-danger bullet-sm"></span>`;
            } else if (ticket.theme == "FISCALITÉ") {
                html_theme = `<span class="bullet bullet-warning bullet-sm"></span>`;
            } else if (ticket.theme == "SOCIAL") {
                html_theme = `<span class="bullet bullet-info bullet-sm"></span>`;
            } else {
                html_theme = `<span class="bullet bullet-light bullet-sm"></span>`;
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
                                <div class="mr-1">
                                    <span class="badge badge-light-primary badge-pill">${ticket.nb_notifs} non lu(s)</span>
                                </div>
                                <div class="mr-1">
                                    <span class="badge badge-light-${html_statut} badge-pill">${ticket.statut}</span>
                                </div>`
                                + html_theme +
                            `</div>
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
                                <div class="mr-1">
                                    <span class="badge badge-light-${html_statut} badge-pill">${ticket.statut}</span>
                                </div>`
                                + html_theme +
                            `</div>
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

$(".filtre-tickets").click(function(e) {
    e.preventDefault;
    let filtre = $(this).children('input')[0].value;
    getTicketsSupport(filtre);
});

$(".theme-tickets").click(function(e) {
    e.preventDefault;
    let theme = $(this).children('input')[0].value;
    getTicketsSupport(theme);
});