<?php

    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();
    extract($_POST);

    $name_team = $_POST['name_team'];
    $tags_name = $_POST['tags_name'];
    $email_team = $_POST['email_team'];
    $tel_team = $_POST['tel_team'];
    $date_crea = date("d/m/Y");
    $projet = "";

    $insert = $bdd->prepare('INSERT INTO teams (name_team, tags_name, email_team, tel_team, date_crea, projet, id_session) VALUES(?,?,?,?,?,?,?)');
    $result = $insert->execute(array(

        htmlspecialchars($name_team),
        htmlspecialchars($tags_name),
        htmlspecialchars($email_team),
        htmlspecialchars($tel_team),
        htmlspecialchars($date_crea),
        htmlspecialchars($projet),
        htmlspecialchars($_SESSION['id_session'])
    ));

    $pdoS = $bdd->prepare('SELECT * FROM teams WHERE name_team =:name_team AND email_team = :email_team AND date_crea = :date_crea AND tags_name = :tags_name AND tel_team = :tel_team AND id_session = :id_session');
    $pdoS->bindValue(':name_team',$_POST['name_team']);
    $pdoS->bindValue(':email_team',$_POST['email_team']);
    $pdoS->bindValue(':date_crea',$date_crea);
    $pdoS->bindValue(':tags_name',$tags_name);
    $pdoS->bindValue(':tel_team',$tel_team);
    $pdoS->bindValue(':id_session',$_SESSION['id_session']);
    $pdoS->execute();
    $team = $pdoS->fetch();

    if($result == "1"){
        echo $team['id'];
    }else{
        echo "Un erreur est survenue lors de l'insertion de votre team";
    }
    
?>