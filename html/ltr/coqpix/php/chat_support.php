<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

if (isset($_GET['statut']) && ($_GET['statut'] === "urgent" || $_GET['statut'] === "fermé" || $_GET['statut'] === "ouvert")) {
    changerStatutTicket($_GET['statut']);
} else if (isset($_GET['theme']) && ($_GET['theme'] === "général" || $_GET['theme'] === "compta" || $_GET['theme'] === "juridique" || $_GET['theme'] === "fiscalité" || $_GET['theme'] === "social")) { 
    changerThemeTicket($_GET['theme']);
} else if (isset($_GET['method']) && $_GET['method'] === "getTickets") {
    getTickets();
} else if (isset($_GET['method']) && $_GET['method'] === "post") {
    postMessage();
}  else {
    getMessages();
}

function getTickets() {

    global $bdd;

    $id_membre = htmlspecialchars($_GET['id_membre']);

    $query = $bdd->prepare('SELECT ST.id_ticket, ST.objet, (SELECT count(*) FROM support_message SM WHERE SM.id_ticket = ST.id_ticket AND SM.id_membre = :id_membre AND auteur = "support" AND lu = 0) AS nb_notifs FROM support_ticket ST WHERE ST.id_membre = :id_membre AND upper(ST.statut) != "FERMÉ" ORDER BY (SELECT SM.id_message FROM support_message SM WHERE SM.id_ticket = ST.id_ticket AND SM.id_membre = :id_membre ORDER BY date_message DESC, heure DESC LIMIT 1)');
    $query->bindValue(':id_membre', $id_membre);
    $query->execute();

    $tickets = $query->fetchAll();

    echo json_encode($tickets);

}

function getMessages() {

    global $bdd;

    $id_ticket = htmlspecialchars($_GET['id_ticket']);
    $auteur = htmlspecialchars($_GET['auteur']);

    $query = $bdd->prepare('SELECT S.date_message, S.heure, S.texte, S.auteur, M.img_membres FROM support_message S, membres M WHERE S.id_membre = M.id AND S.id_ticket = :id_ticket ORDER BY date_message DESC, heure DESC LIMIT 30');
    $query->bindValue(':id_ticket', $id_ticket);
    $query->execute();

    $messages = $query->fetchAll();

    echo json_encode($messages);

    $query = $bdd->prepare('UPDATE support_message SET lu = 1 WHERE id_ticket = :id_ticket AND auteur != :auteur');
    $query->bindValue(':id_ticket', $id_ticket);
    $query->bindValue(':auteur', $auteur);
    $query->execute();

}

function postMessage() {

    global $bdd;

    $id_membre = htmlspecialchars($_POST['id_membre']);
    $id_ticket = htmlspecialchars($_POST['id_ticket']);
    $texte = htmlspecialchars($_POST['texte']);
    $auteur = htmlspecialchars($_POST['auteur']);

    if ($texte !== "") {
        $query = $bdd->prepare('INSERT INTO support_message (id_membre, id_ticket, date_message, heure, texte, auteur)
                                VALUES (:id_membre, :id_ticket, curdate(), curtime(), :texte, :auteur)');
        $query->bindValue('id_membre', $id_membre);
        $query->bindValue('id_ticket', $id_ticket);
        $query->bindValue('texte', $texte);
        $query->bindValue('auteur', $auteur);
        $query->execute();
    }

}

function changerStatutTicket($statut) {

    global $bdd;

    $id_ticket = htmlspecialchars($_POST['id_ticket']);

    $query = $bdd->prepare('UPDATE support_ticket SET statut = :statut WHERE id_ticket = :id_ticket');
    $query->bindValue(':statut', $statut);
    $query->bindValue(':id_ticket', $id_ticket);
    $query->execute();

}

function changerThemeTicket($theme) {

    global $bdd;

    $id_ticket = htmlspecialchars($_POST['id_ticket']);

    $query = $bdd->prepare('UPDATE support_ticket SET theme = :theme WHERE id_ticket = :id_ticket');
    $query->bindValue(':theme', $theme);
    $query->bindValue(':id_ticket', $id_ticket);
    $query->execute();

}

?>