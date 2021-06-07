
<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $name_task = $_GET['name_task'];
        $date_task = $_GET['date_task'];

        $dateecheance_task = $_GET['dateecheance_task'];
        //Jour de la date ex : Sun
        $tabDate = explode('/', $dateecheance_task);
        $timestamp = mktime(0, 0, 0, $tabDate[1], $tabDate[2], $tabDate[0]);
        $dateecheance_D = date('D', $timestamp);
        //Jour en chiffre
        $dateecheance_d = substr($dateecheance_task, 0, 2);
        //month        
        $tabDate = explode('/', $dateecheance_task);
        $timestamp = mktime(0, 0, 0, $tabDate[1], $tabDate[2], $tabDate[0]);
        $dateecheance_M = date('M', $timestamp);
        //année        
        $dateecheance_Y = '20'.substr($dateecheance_task, 6);
        //heure min sec
        $dateecheance_His = "00:00:00";
        //date final
        $dateecheance_task = ''.$dateecheance_D.', '.$dateecheance_d.' '.$dateecheance_M.' '.$dateecheance_Y.' '.$dateecheance_His.'  +0000';

        $status_task = "encour";
        $favorite = "0";
        $assignation_task = $_GET['assignation_task'];
        $description_task = $_GET['description_task'];


        if(!empty($_GET['new_etiq'])){
            $etiquette_task = $_GET['new_etiq'];
            $color_etiq = $_GET['new_color'];

            $insert = $bdd->prepare('INSERT INTO etiquette (name_etiq, color, id_session) VALUES(?,?,?)');
            $insert->execute(array(
            htmlspecialchars($_GET['new_etiq']),
            htmlspecialchars($color_etiq),
            htmlspecialchars($_SESSION['id_session'])
        ));

        }else{
            $etiquette_task = $_GET['etiquette_task'];
        }
       

        $pdoSt = $bdd->prepare('SELECT color FROM etiquette WHERE name_etiq = :name_etiq');
        $pdoSt->bindValue(':name_etiq',$_GET['etiquette_task']);
        $pdoSt->execute();
        $etiq = $pdoSt->fetch();

        $color_etiq = $etiq['color'];         //
        
        $date_jm = date("d/m/");
        $date_Y = date('Y');
        $date_tas = $date_jm.$date_Y;
        $commentaire_task = $_GET['commentaire_task'];
        $lastcommentaire_task = "";
        $projet_task = "";
        $id_session = $_SESSION['id_session'];
        
        $insert = $bdd->prepare('INSERT INTO task (name_task, date_task, dateecheance_task, status_task, favorite, assignation_task, description_task, etiquette_task, color_etiq, date_crea, commentaire_task, lastcommentaire_task, projet_task, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
        ($name_task),
        ($date_tas),
        ($dateecheance_task),
        ($status_task),
        ($favorite),
        ($assignation_task),
        ($description_task),
        ($etiquette_task),
        ($color_etiq),
        ($date_task),
        ($commentaire_task),
        ($lastcommentaire_task),
        ($projet_task),
        ($id_session)
    ));

    header('Location: ../task.php');
    exit();

?>