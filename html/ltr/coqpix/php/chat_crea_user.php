<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_crea.php';

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

        $destination = 'coqpix'.$_GET['destination'];

        $resultats = $bdd->prepare("SELECT * FROM chat_crea WHERE destination = :destination ORDER BY id DESC LIMIT 30");
        $resultats->bindValue(':destination',$destination);
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

    //status error si il y a une erreur

    if(!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)){
        echo json_encode(["status" => "error", "message" => "One field or many not been sent"]);
        return;
    }

    //1- Analyer les parametres passés en POST (author, content)

    $destination = 'coqpix'.$_POST['author'];
    $date_crea = date("d-m-Y");
    $date_h = date("H") + "1";
    if($date_h == "24"){
        $date_h = "00";
    }
    $date_m = date("i");
    $content = $_POST['content'];
    $you = $_POST['author'];
    $id_client = $_SESSION['id_crea'];

    //2- Crée une requete qui permettra l'insertion des informations dans la base de donnée

    $query = $bdd->prepare('INSERT INTO chat_crea (destination, date_crea, date_h, date_m, message_crea, you) VALUES(?,?,?,?,?,?)');
    $query->execute(array(
        htmlspecialchars($destination),
        htmlspecialchars($date_crea),
        htmlspecialchars($date_h),
        htmlspecialchars($date_m),
        htmlspecialchars($content),
        htmlspecialchars($you)
    ));

    $pdoSta = $bdd->prepare('SELECT notification_crea FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_POST['id_client']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    $notification = $crea['notification_admin'] + "1";

    $update = $bdd->prepare('UPDATE crea_societe SET notification_admin = ? WHERE id = ?');
                    $update->execute(array(
                        htmlspecialchars($notification),
                        htmlspecialchars($id_client)
                    ));

    //3- Donner un statut de succes ou d'erreur au format JSON

    echo json_encode(["status" => "sucess"]);
}



?>
