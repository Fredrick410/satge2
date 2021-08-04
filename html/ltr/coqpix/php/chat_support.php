<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

//A - on analyse la requete via l'URL

if (isset($_GET['statut']) && ($_GET['statut'] === "urgent" || $_GET['statut'] === "fermé" || $_GET['statut'] === "ouvert")) {
    changerStatutTicket($_GET['statut']);
} else if (isset($_GET['method']) && $_GET['method'] === "post") {
    postMessage();
} else {
    getMessages();
}

//B- function qui va permettre de recupérer les messages.

function getMessages() {

    //on definit la variable bdd dans la fonction 
    global $bdd;

    //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de données

    $id_ticket = htmlspecialchars($_GET['id_ticket']);
    $auteur = htmlspecialchars($_GET['auteur']);

    $query = $bdd->prepare('SELECT S.date_message, S.heure, S.texte, S.auteur, M.img_membres FROM support_message S, membres M WHERE S.id_membre = M.id AND S.id_ticket = :id_ticket ORDER BY date_message DESC, heure DESC LIMIT 30');
    $query->bindValue(':id_ticket', $id_ticket);
    $query->execute();

    //2 - On va traiter les resultats

    $messages = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($messages);

    //4 - On désactive les notifications
    $query = $bdd->prepare('UPDATE support_message SET lu = 1 WHERE id_ticket = :id_ticket AND auteur != :auteur');
    $query->bindValue(':id_ticket', $id_ticket);
    $query->bindValue(':auteur', $auteur);
    $query->execute();

}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage() {

    //on definit la variable bdd dans la function 
    global $bdd;

    //1- Analyer les parametres passés en POST (author, content)

    $id_membre = htmlspecialchars($_POST['id_membre']);
    $id_ticket = htmlspecialchars($_POST['id_ticket']);
    $texte = htmlspecialchars($_POST['texte']);
    $auteur = htmlspecialchars($_POST['auteur']);

    //2- Crée une requete qui permettra l'insertion des informations dans la base de données

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

    //on definit la variable bdd dans la function 
    global $bdd;

    //1- Analyer les parametres passés en POST
    $id_ticket = htmlspecialchars($_POST['id_ticket']);

    //2- Crée une requete qui permettra la suppression des messages dans la base de données
    $query = $bdd->prepare('UPDATE support_ticket SET statut = :statut WHERE id_ticket = :id_ticket');
    $query->bindValue(':statut', $statut);
    $query->bindValue(':id_ticket', $id_ticket);
    $query->execute();

}

?>