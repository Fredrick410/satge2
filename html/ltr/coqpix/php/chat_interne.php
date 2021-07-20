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

    $query = $bdd->prepare('SELECT id_membre_from, id_membre_to, date_message, heure_message, texte, (SELECT img_membres FROM membres WHERE id = :id_membre_1) AS img_1, (SELECT img_membres FROM membres WHERE id = :id_membre_2) AS img_2 FROM message WHERE ((id_membre_from = :id_membre_1 AND id_membre_to = :id_membre_2) OR (id_membre_from = :id_membre_2 AND id_membre_to = :id_membre_1)) ORDER BY date_message DESC, heure_message DESC LIMIT 30');
    $query->bindValue(':id_membre_1', $id_membre_1);
    $query->bindValue(':id_membre_2', $id_membre_2);
    $query->execute();

    //2 - On va traiter les resultats

    $messages = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($messages);

    // //4 - On désactive les notifications
    // if ($auteur == "support") {
    //     $query = $bdd->prepare('UPDATE support_message SET lu_support = 1 WHERE id_membre = :id_membre');
    //     $query->bindValue(':id_membre', $id_membre);
    //     $query->execute();
    // } else {
    //     $query = $bdd->prepare('UPDATE support_message SET lu_user = 1 WHERE id_membre = :id_membre');
    //     $query->bindValue(':id_membre', $id_membre);
    //     $query->execute();
    // }

}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage() {

    //on definit la variable bdd dans la function 
    global $bdd;

    //1- Analyer les parametres passés en POST (author, content)

    $id_membre_1 = $_POST['id_membre_1']; // Recuperer l'id du membre selectionnee dans la liste
    $id_membre_2 = $_POST['id_membre_2'];
    $date_message = date('Y-m-d');
    $heure = date('H:i:s', strtotime('+2 hours'));
    $texte = $_POST['texte'];

    //2- Crée une requete qui permettra l'insertion des informations dans la base de données

    if ($texte !== "") {
        $query = $bdd->prepare('INSERT INTO message (id_membre_from, id_membre_to, date_message, heure, texte) VALUES (?,?,?,?,?)');
        $query->execute(array(
            htmlspecialchars($id_membre_1),
            htmlspecialchars($id_membre_2),
            htmlspecialchars($date_message),
            htmlspecialchars($heure),
            htmlspecialchars($texte),
        ));
    }

}

?>