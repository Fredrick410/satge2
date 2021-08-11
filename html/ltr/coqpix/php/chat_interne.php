<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

//A - on analyse la requete via l'URL

if (isset($_GET['method']) && $_GET['method'] === "post") {
    // Poster un message
    postMessage();
} else if (isset($_GET['method']) && $_GET['method'] === "getMembres") {
    // Récupérer la liste des membres
    getMembres();
} else if (isset($_GET['method']) && $_GET['method'] === "getMembresChannel") {
    // Récupérer la liste des participants du channel
    getMembresChannel();
} else if (isset($_GET['method']) && $_GET['method'] === "getMembresNotInChannel") {
    // Récupérer la liste des membres de l'entreprise ne participant pas au channel
    getMembresNotInChannel();
} else if (isset($_GET['method']) && $_GET['method'] === "addMembreChannel") {
    // Ajouter un membre à un channel
    addMembreChannel();
} else if (isset($_GET['method']) && $_GET['method'] === "deleteMembreChannel") {
    // Ajouter un membre à un channel
    deleteMembreChannel();
} else {
    // Récupérer les messages
    getMessages();
}

//B- function qui va permettre de recupérer les messages.

function getMessages() {

    //on definit la variable bdd dans la fonction 
    global $bdd;

    //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de données

    $type_message = htmlspecialchars($_GET['type_message']);
    $id_source = htmlspecialchars($_GET['id_source']);
    $id_destination = htmlspecialchars($_GET['id_destination']);

    if ($type_message == "privé") {

        $query = $bdd->prepare('SELECT Msg.id_membre_from, Msg.id_membre_to, Msg.date_message, Msg.heure_message, Msg.texte, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, M.img_membres FROM message Msg, membres M WHERE Msg.id_membre_from = M.id AND ((Msg.id_membre_from = :id_source AND Msg.id_membre_to = :id_destination) OR (Msg.id_membre_from = :id_destination AND Msg.id_membre_to = :id_source)) ORDER BY Msg.date_message DESC, Msg.heure_message DESC LIMIT 30');
        $query->bindValue(':id_source', $id_source);
        $query->bindValue(':id_destination', $id_destination);
        $query->execute();

        $desactiver_notifs = $bdd->prepare('UPDATE message SET lu = 1 WHERE id_membre_from = :id_membre_from AND id_membre_to = :id_membre_to');
        $desactiver_notifs->bindValue(':id_membre_from', $id_destination);
        $desactiver_notifs->bindValue(':id_membre_to', $id_source);
        $desactiver_notifs->execute();

    } 
    
    if ($type_message == "channel") {

        $query = $bdd->prepare('SELECT Msg.id_membre, Msg.date_message, Msg.heure_message, Msg.texte, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, M.img_membres FROM message_channel Msg, membres M WHERE Msg.id_membre = M.id AND Msg.id_channel = :id_channel ORDER BY Msg.date_message DESC, Msg.heure_message DESC LIMIT 30');
        $query->bindValue(':id_channel', $id_destination);
        $query->execute();

    }

    //2 - On va traiter les resultats

    $messages = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($messages);

}

function getMembres() {

    //on definit la variable bdd dans la fonction 
    global $bdd;

    //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de données

    $id_membre = htmlspecialchars($_GET['id_membre']);
    $id_entreprise = htmlspecialchars($_GET['id_entreprise']);

    $query = $bdd->prepare('SELECT id, upper(nom) AS nom, concat(ucase(left(prenom, 1)), lcase(substring(prenom, 2))) AS prenom, img_membres, role_membres, (SELECT count(*) FROM message WHERE id_membre_from = id AND id_membre_to = :id_membre AND lu = 0) AS nb_notifs FROM membres WHERE id_session = :id_entreprise ORDER BY (SELECT id_message FROM message WHERE id_membre_from = id AND id_membre_to = :id_membre ORDER BY date_message DESC, heure_message DESC LIMIT 1)');
    $query->bindValue(':id_membre', $id_membre);
    $query->bindValue(':id_entreprise', $id_entreprise);
    $query->execute();

    //2 - On va traiter les resultats

    $membres = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($membres);

}

function getMembresChannel() {

    //on definit la variable bdd dans la fonction 
    global $bdd;

    //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de données

    //$id_membre = htmlspecialchars($_GET['id_membre']);
    $id_channel = htmlspecialchars($_GET['id_channel']);

    $query = $bdd->prepare('SELECT M.id, upper(M.nom) AS nom, concat(ucase(left(M.prenom, 1)), lcase(substring(M.prenom, 2))) AS prenom, M.img_membres, M.role_membres FROM membres M, channel_membres C WHERE M.id = C.id_membre AND C.id_channel = :id_channel');
    //$query->bindValue(':id_membre', $id_membre);
    $query->bindValue(':id_channel', $id_channel);
    $query->execute();

    //2 - On va traiter les resultats

    $membres = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($membres);

}

function getMembresNotInChannel() {

    //on definit la variable bdd dans la fonction 
    global $bdd;

    //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de données

    $id_entreprise = htmlspecialchars($_GET['id_entreprise']);
    $id_channel = htmlspecialchars($_GET['id_channel']);

    $query = $bdd->prepare('SELECT id, upper(nom) AS nom, concat(ucase(left(prenom, 1)), lcase(substring(prenom, 2))) AS prenom, img_membres, role_membres FROM membres WHERE id_session = :id_entreprise AND NOT EXISTS (SELECT id_membre FROM channel_membres WHERE id_membre = id AND id_channel = :id_channel)');
    $query->bindValue(':id_entreprise', $id_entreprise);
    $query->bindValue(':id_channel', $id_channel);
    $query->execute();

    //2 - On va traiter les resultats

    $membres = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($membres);

}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage() {

    //on definit la variable bdd dans la function 
    global $bdd;

    //1- Analyer les parametres passés en POST (author, content)

    $type_message = htmlspecialchars($_POST['type_message']);
    $id_source = htmlspecialchars($_POST['id_source']);
    $id_destination = htmlspecialchars($_POST['id_destination']);
    $texte = htmlspecialchars($_POST['texte']);

    //2- Crée une requete qui permettra l'insertion des informations dans la base de données

    if ($texte !== "") {

        if ($type_message == "privé") {
            $query = $bdd->prepare('INSERT INTO message (id_membre_from, id_membre_to, date_message, heure_message, texte) VALUES (:id_membre_from, :id_membre_to, curdate(), curtime(), :texte)');
            $query->bindValue(':id_membre_from', $id_source);
            $query->bindValue(':id_membre_to', $id_destination);
            $query->bindValue(':texte', $texte);
            $query->execute();
        }
        if ($type_message == "channel") {
            $query = $bdd->prepare('INSERT INTO message_channel (id_membre, id_channel, date_message, heure_message, texte) VALUES (:id_membre, :id_channel, curdate(), curtime(), :texte)');
            $query->bindValue(':id_membre', $id_source);
            $query->bindValue(':id_channel', $id_destination);
            $query->bindValue(':texte', $texte);
            $query->execute();
        }
    }

}

function addMembreChannel() {

    global $bdd;

    $id_membre = htmlspecialchars($_POST['id_membre']);
    $id_channel = htmlspecialchars($_POST['id_channel']);

    $query = $bdd->prepare('INSERT INTO channel_membres (id_membre, id_channel) VALUES (:id_membre, :id_channel)');
    $query->bindValue(':id_membre', $id_membre);
    $query->bindValue(':id_channel', $id_channel);
    $query->execute();

}

function deleteMembreChannel() {

    global $bdd;

    $id_membre = htmlspecialchars($_POST['id_membre']);
    $id_channel = htmlspecialchars($_POST['id_channel']);

    $query = $bdd->prepare('DELETE FROM channel_membres WHERE id_membre = :id_membre AND id_channel = :id_channel');
    $query->bindValue(':id_membre', $id_membre);
    $query->bindValue(':id_channel', $id_channel);
    $query->execute();

    // Requete permettant de selectionner le nombre de participants du channel
    $count_channel_membres = $bdd->prepare('SELECT count(*) AS nb FROM channel_membres WHERE id_channel = :id_channel');
    $count_channel_membres->bindValue(':id_channel', $id_channel);
    $count_channel_membres->execute();

    // Si le channel n'a plus de participant, on supprime le channel et les messages du channel
    if ($count_channel_membres->fetch()['nb'] == 0) {
        // Suppression du channel
        $query = $bdd->prepare('DELETE FROM channel WHERE id_channel = :id_channel');
        $query->bindValue(':id_channel', $id_channel);
        $query->execute();

        // Suppression des messages du channel
        $query = $bdd->prepare('DELETE FROM message_channel WHERE id_channel = :id_channel');
        $query->bindValue(':id_channel', $id_channel);
        $query->execute();
    }

}

?>