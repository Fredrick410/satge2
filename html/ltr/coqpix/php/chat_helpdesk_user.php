<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

//A - on analyse la requete via l'URL

$task = "list";

if(array_key_exists("task", $_GET)){
    $task = $_GET['task'];
}

if($task == "write"){
    postMessage();
}else{
    getMessage();
}

//B- function qui va permettre de recupérer les messages.


function getMessage(){
    //on definit la variable bdd dans la fonction 
    global $bdd;
    session_start();


        //1 - On fait une requete qui va permettre d'afficher les 30 dernieres message de la base de donnée

        $query = $bdd->prepare("SELECT * FROM support_message WHERE id_membre = :id_membre ORDER BY id DESC LIMIT 30");
        $query->bindValue(':id_membre',$_SESSION['id']);
        $query->execute();

        //2 - On va traiter les resultats

        $messages = $resultats->fetchAll();

        //3 - On affcihe les données en JSON

        echo json_encode($messages);
}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage(){
    //on definit la variable bdd dans la function 
    global $bdd;
    session_start();

    //status error si il y a une erreur

    if(!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)){
        echo json_encode(["status" => "error", "message" => "One field or many not been sent"]);
        return;
    }

    //1- Analyer les parametres passés en POST (author, content)

    $id_membre = $_SESSION['id'];
    $date_message = date('Y-m-d');
    $heure = time();
    $texte = $_POST['content'];
    $destination = "support";

    //2- Crée une requete qui permettra l'insertion des informations dans la base de donnée

    if($texte !== ""){
        $query = $bdd->prepare('INSERT INTO support_message (id_membre, fate_message, heure, texte, destination) VALUES(?,?,?,?,?,?)');
        $query->execute(array(
            htmlspecialchars($id_membre),
            htmlspecialchars($date_message),
            htmlspecialchars($heure),
            htmlspecialchars($texte),
            htmlspecialchars($destination)
        ));

    }
    //3- Donner un statut de succes ou d'erreur au format JSON

    echo json_encode(["status" => "success"]);
}



?>
