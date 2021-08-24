<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

function getTickets($filtre) {

    global $bdd;

    if ($filtre == "non lu") {

        $query = $bdd->prepare('SELECT ST.id_ticket, ST.objet, count(case when auteur = "user" and lu = 0 then 1 else null end) AS nb_notifs, upper(ST.statut) AS statut, upper(ST.theme) AS theme, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, E.nameentreprise FROM support_ticket ST, support_message SM, membres M, entreprise E WHERE ST.id_membre = M.id AND M.id_session = E.id AND ST.id_ticket = SM.id_ticket AND SM.auteur = "user" AND SM.lu = 0 GROUP BY ST.id_ticket ORDER BY ST.statut, ST.date_creation DESC');
        $query->execute();

    } else if ($filtre == "urgent" || $filtre == "ouvert" || $filtre == "fermé") {

        $query = $bdd->prepare('SELECT ST.id_ticket, ST.objet, count(case when auteur = "user" and lu = 0 then 1 else null end) AS nb_notifs, upper(ST.statut) AS statut, upper(ST.theme) AS theme, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, E.nameentreprise FROM support_ticket ST, support_message SM, membres M, entreprise E WHERE ST.id_membre = M.id AND M.id_session = E.id AND ST.statut = :statut AND ST.id_ticket = SM.id_ticket GROUP BY ST.id_ticket ORDER BY ST.date_creation DESC');
        $query->bindValue(':statut', $filtre);
        $query->execute();

    } else if ($filtre == "général" || $filtre == "compta" || $filtre == "juridique" || $filtre == "fiscalité" || $filtre == "social") {

        $query = $bdd->prepare('SELECT ST.id_ticket, ST.objet, count(case when auteur = "user" and lu = 0 then 1 else null end) AS nb_notifs, upper(ST.statut) AS statut, upper(ST.theme) AS theme, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, E.nameentreprise FROM support_ticket ST, support_message SM, membres M, entreprise E WHERE ST.id_membre = M.id AND M.id_session = E.id AND ST.theme = :theme AND ST.id_ticket = SM.id_ticket GROUP BY ST.id_ticket ORDER BY ST.date_creation DESC');
        $query->bindValue(':theme', $filtre);
        $query->execute();

    } else {

        $query = $bdd->prepare('SELECT ST.id_ticket, ST.objet, count(case when auteur = "user" and lu = 0 then 1 else null end) AS nb_notifs, upper(ST.statut) AS statut, upper(ST.theme) AS theme, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, E.nameentreprise FROM support_ticket ST, support_message SM, membres M, entreprise E WHERE ST.id_membre = M.id AND M.id_session = E.id AND ST.id_ticket = SM.id_ticket GROUP BY ST.id_ticket ORDER BY ST.statut, ST.date_creation DESC');
        $query->execute();

    }

    $tickets = $query->fetchAll();

    echo json_encode($tickets);

}

$filtre = "all";

if (isset($_GET['filtre']) && !empty($_GET['filtre'])) {
    $filtre = $_GET['filtre'];
}

getTickets($filtre);