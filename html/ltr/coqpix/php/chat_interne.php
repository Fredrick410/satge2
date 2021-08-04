<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

//A - on analyse la requete via l'URL

$method = "get";

if (isset($_GET['method']) and $_GET['method'] === "post") {
    postMessage();
} else {
    getMessages();
}

//B- function qui va permettre de recupérer les messages.

function getMessages() {

    //on definit la variable bdd dans la fonction 
    global $bdd;

    //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de données

    $id_membre_1 = htmlspecialchars($_GET['id_membre_1']);
    $id_membre_2 = htmlspecialchars($_GET['id_membre_2']);

    if ($id_membre_2 != 0) {

        $query = $bdd->prepare('SELECT Msg.id_membre_from, Msg.id_membre_to, Msg.date_message, Msg.heure_message, Msg.texte, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, M.img_membres FROM message Msg, membres M WHERE Msg.id_membre_from = M.id AND ((Msg.id_membre_from = :id_membre_1 AND Msg.id_membre_to = :id_membre_2) OR (Msg.id_membre_from = :id_membre_2 AND Msg.id_membre_to = :id_membre_1)) ORDER BY Msg.date_message DESC, Msg.heure_message DESC LIMIT 30');
        $query->bindValue(':id_membre_1', $id_membre_1);
        $query->bindValue(':id_membre_2', $id_membre_2);
        $query->execute();

        $desactiver_notifs = $bdd->prepare('UPDATE message SET lu = 1 WHERE id_membre_to = :id_membre');
        $desactiver_notifs->bindValue(':id_membre', $id_membre_1);
        $desactiver_notifs->execute();

    } else {

        $query = $bdd->prepare('SELECT Msg.id_membre_from, Msg.id_membre_to, Msg.date_message, Msg.heure_message, Msg.texte, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, M.img_membres FROM message Msg, membres M WHERE Msg.id_membre_from = M.id AND Msg.id_membre_to = 0 ORDER BY Msg.date_message DESC, Msg.heure_message DESC LIMIT 30');
        $query->execute();

    }

    //2 - On va traiter les resultats

    $messages = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($messages);

}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage() {

    //on definit la variable bdd dans la function 
    global $bdd;

    //1- Analyer les parametres passés en POST (author, content)

    $id_membre_1 = htmlspecialchars($_POST['id_membre_1']); // Recuperer l'id du membre selectionnee dans la liste
    $id_membre_2 = htmlspecialchars($_POST['id_membre_2']);
    $texte = htmlspecialchars($_POST['texte']);

    //2- Crée une requete qui permettra l'insertion des informations dans la base de données

    if ($texte !== "") {
        $query = $bdd->prepare('INSERT INTO message (id_membre_from, id_membre_to, date_message, heure_message, texte) VALUES (:id_membre_from, :id_membre_to, curdate(), curtime(), :texte)');
        $query->bindValue(':id_membre_from', $id_membre_1);
        $query->bindValue(':id_membre_to', $id_membre_2);
        $query->bindValue(':texte', $texte);
        $query->execute();
    }

}

?>