<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
session_start();

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

        //1 - On fait une requete qui va permettre d'afficher les 20 dernieres message de la base de donnée
        

        $numr = $_GET['num'];

        $resultats = $bdd->prepare("SELECT * FROM teams_membres WHERE team_num=:team_num");
        $resultats->bindValue(':team_num',$numr);
        $resultats->execute();

        //2 - On va traiter les resultats

        $messages = $resultats->fetchAll();

        //3 - On affcihe les données en JSON

        echo json_encode($messages);
}

//C- function qui va permettre d'écrire et non de recupérer des informations pour le chat.

function postMessage(){
    //on definit la variable bdd dans la function 
    global $bdd;

    $name_membre = $_POST['name_membre'];
    $img_membre = "team_img.png";
    $date_add = date("d/m/Y");
    $team_num = $_POST['team_num'];

    $insert = $bdd->prepare('INSERT INTO teams_membres (name_membre, img_membre, date_add, team_num, id_session) VALUES(?,?,?,?,?)');
    $result = $insert->execute(array(

        htmlspecialchars($name_membre),
        htmlspecialchars($img_membre),
        htmlspecialchars($date_add),
        htmlspecialchars($team_num),
        htmlspecialchars($_SESSION['id_session'])
    ));

    //Ajout d'une notification front
    $notif = $bdd->prepare('INSERT INTO notif_front (type_demande, date_donner, id_session) VALUES(?,?,?)');
    $notif->execute(array(
        htmlspecialchars('teams_membres'),
        htmlspecialchars($date_add),
        htmlspecialchars($_SESSION['id_session']),
    ));
    

    //3- Donner un statut de succes ou d'erreur au format JSON

    echo json_encode(["status" => "sucess"]);
}



?>
