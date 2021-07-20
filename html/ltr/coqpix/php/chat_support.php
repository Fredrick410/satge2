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

if (isset($_GET['delete']) and $_GET['delete'] === 'yes') {
    deleteMessages();
}

//B- function qui va permettre de recupérer les messages.

function getMessages() {

    //on definit la variable bdd dans la fonction 
    global $bdd;

    //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de données

    $id_membre = htmlspecialchars($_GET['id_membre']);
    $auteur = htmlspecialchars($_GET['auteur']);

    $query = $bdd->prepare('SELECT S.date_message, S.heure, S.texte, S.auteur, M.img_membres FROM support_message S, membres M WHERE S.id_membre = :id_membre AND S.id_membre = M.id ORDER BY date_message DESC, heure DESC LIMIT 30');
    $query->bindValue(':id_membre', $id_membre);
    $query->execute();

    //2 - On va traiter les resultats

    $messages = $query->fetchAll();

    //3 - On affiche les données en JSON

    echo json_encode($messages);

    //4 - On désactive les notifications
    if ($auteur == "support") {
        $query = $bdd->prepare('UPDATE support_message SET lu_support = 1 WHERE id_membre = :id_membre');
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();
    } else {
        $query = $bdd->prepare('UPDATE support_message SET lu_user = 1 WHERE id_membre = :id_membre');
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();
    }

}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage() {

    //on definit la variable bdd dans la function 
    global $bdd;

    //1- Analyer les parametres passés en POST (author, content)

    $id_membre = $_POST['id_membre']; // Recuperer l'id du membre selectionnee dans la liste
    $date_message = date('Y-m-d');
    $heure = date('H:i:s', strtotime('+2 hours'));
    $texte = $_POST['texte'];
    $auteur = $_POST['auteur'];

    //2- Crée une requete qui permettra l'insertion des informations dans la base de données

    if ($texte !== "") {
        $query = $bdd->prepare('INSERT INTO support_message (id_membre, date_message, heure, texte, auteur) VALUES (?,?,?,?,?)');
        $query->execute(array(
            htmlspecialchars($id_membre),
            htmlspecialchars($date_message),
            htmlspecialchars($heure),
            htmlspecialchars($texte),
            htmlspecialchars($auteur)
        ));
    }

}

function deleteMessages() {

    //on definit la variable bdd dans la function 
    global $bdd;

    //1- Analyer les parametres passés en POST
    $id_membre = htmlspecialchars($_POST['id_membre']); // Recuperer l'id du membre selectionnee dans la liste

    //2- Crée une requete qui permettra la suppression des messages dans la base de données
    $query = $bdd->prepare('DELETE FROM support_message WHERE id_membre = :id_membre');
    $query->bindValue(':id_membre', $id_membre);
    $query->execute();

}

?>