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


        //1 - On fait une requete qui va permettre d'afficher les 20 dernieres message de la base de donnée

        $destination = 'support'.$_GET['destination'];

        $resultats = $bdd->prepare("SELECT * FROM support_message WHERE destination = :destination ORDER BY id DESC LIMIT 30");
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
    session_start();

    //status error si il y a une erreur

    if(!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)){
        echo json_encode(["status" => "error", "message" => "One field or many not been sent"]);
        return;
    }

    //1- Analyer les parametres passés en POST (author, content)

    $destination = 'support'.$_POST['author'];
    $date_crea = date("d-m-Y");
    $date_h = date("H") + "2";
    if($date_h == "24"){
        $date_h = "00";
    }
    $date_m = date("i");
    $content = $_POST['content'];
    $you = "support";
    $id_client = $_SESSION['id_session'];

    //2- Crée une requete qui permettra l'insertion des informations dans la base de donnée

    if($content !== ""){
        $query = $bdd->prepare('INSERT INTO support_message (destination, date_message, date_h, date_m, message_support, you) VALUES(?,?,?,?,?,?)');
        $query->execute(array(
            htmlspecialchars($destination),
            htmlspecialchars($date_crea),
            htmlspecialchars($date_h),
            htmlspecialchars($date_m),
            htmlspecialchars($content),
            htmlspecialchars($you)
        ));

        $pdoSta = $bdd->prepare('SELECT support_notif, helpdesk_notif FROM entreprise WHERE id = :num');
        $pdoSta->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
        $pdoSta->execute(); 
        $entreprise = $pdoSta->fetch();

        $notification = $entreprise['helpdesk_notif'] + 1;

        $pdo = $bdd->prepare('UPDATE entreprise SET helpdesk_notif=:helpdesk_notif WHERE id=:num LIMIT 1');
        $pdo->bindValue(':helpdesk_notif', $notification);
        $pdo->bindValue(':num', $_SESSION['id_session']);    
        $pdo->execute();
    }
    //3- Donner un statut de succes ou d'erreur au format JSON

    echo json_encode(["status" => "sucess"]);
}



?>
