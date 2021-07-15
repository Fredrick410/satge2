<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

//A - on analyse la requete via l'URL

$method = "get";

if (isset($_GET['method']) and $_GET['method'] == "post") {
    postMessage();
} else {
    getMessage();
}

//B- function qui va permettre de recupérer les messages.

function getMessage(){

    //on definit la variable bdd dans la fonction 
    global $bdd;
    session_start();


        //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de donnée

        $id_membre = 1; // recuperer l'id du membre selectionnee dans la liste

        $resultats = $bdd->prepare("SELECT * FROM support_message WHERE id_membre = :id_membre ORDER BY heure LIMIT 30");
        $resultats->bindValue(':auteur', $id_membre);
        $resultats->execute();

        //2 - On va traiter les resultats

        $messages = $resultats->fetchAll();

        //3 - On affcihe les données en JSON

        echo json_encode($messages);
}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage() {

    //on definit la variable bdd dans la function 
    global $bdd;
    session_start();

    // //status error si il y a une erreur

    // if(!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)){
    //     echo json_encode(["status" => "error", "message" => "One field or many not been sent"]);
    //     return;
    // }

    //1- Analyer les parametres passés en POST (author, content)

    $id_membre = 1; // recuperer l'id du membre selectionnee dans la liste
    $date_message = date("d-m-Y");
    $heure = date('H:m:s');
    $texte = $_POST['texte'];
    $auteur = "support";

    //2- Crée une requete qui permettra l'insertion des informations dans la base de donnée

    if ($texte !== "") {
        $query = $bdd->prepare('INSERT INTO support_message (id_membre, date_message, heure, texte, auteur) VALUES(?,?,?,?,?)');
        $query->execute(array(
            htmlspecialchars($id_membre),
            htmlspecialchars($date_message),
            htmlspecialchars($heure),
            htmlspecialchars($texte),
            htmlspecialchars($auteur)
        ));
    }

    //3- Donner un statut de succes ou d'erreur au format JSON

    echo json_encode(["status" => "sucess"]);

}

?>