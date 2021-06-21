<?php 
require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_enteprise = $_POST['name_entreprise'];
    $date_demande = date('d/m/Y');
    $date_donner = "";
    $statut_notif_back = "Non lue";
    $message_attestation = "";
    $files_attestation = "";
    $id_session = $_POST['num'];

    if($_GET['type'] == "sociale"){

        $type_attestation = $_POST['type_attestation'];

        if($type_attestation !== ""){
            $insert = $bdd->prepare('INSERT INTO task_sociale (name_task, dte_crea, dte_echeance, pour_task, statut_task) VALUES(?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars("Demande d'attestation sociale de ".$name_enteprise),
                htmlspecialchars($date_demande),
                htmlspecialchars(date('d/m/y', strtotime('+1 day'))),
                htmlspecialchars("Non défini"),
                htmlspecialchars("en cours")
            ));

            $pdoS = $bdd->query('SELECT LAST_INSERT_ID() as id_task FROM task_sociale');
            $id_task = ($pdoS->fetch()['id_task']);

            $insert = $bdd->prepare('INSERT INTO attestation_sociale (name_entreprise, date_demande, date_donner, type_attestation, statut_attestation, statut_notif_back, id_task, message_attestation, files_attestation, id_session) VALUES(?,?,?,?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($name_enteprise),
                htmlspecialchars($date_demande),
                htmlspecialchars($date_donner),
                htmlspecialchars($type_attestation),
                htmlspecialchars("En cours"),
                htmlspecialchars($statut_notif_back),
                htmlspecialchars($id_task),
                htmlspecialchars($message_attestation),
                htmlspecialchars($files_attestation),
                htmlspecialchars($id_session)
            ));
            
            

            
            header('Location: ../attestation-social.php?h6W83pUU2b=L6jH744fmT');
            exit();

        }else{
            header('Location: ../attestation-social.php?h6W83pUU2b=iEaY4x6H48');
            exit();
        }   


    }else{
        $insert = $bdd->prepare('INSERT INTO task_fisca (name_task, dte_crea, dte_echeance, pour_task, statut_task) VALUES(?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars("Demande d'attestation fiscale de ".$name_entreprise),
            htmlspecialchars($date_demande),
            htmlspecialchars(date('d/m/y', strtotime('+1 day'))),
            htmlspecialchars("Non défini"),
            htmlspecialchars("en cours")
        ));

        
        $pdoS = $bdd->query('SELECT LAST_INSERT_ID() as id_task FROM task_fica');
        $id_task = ($pdoS->fetch()['id_task']);

        $insert = $bdd->prepare('INSERT INTO attestation_fiscale (name_entreprise, date_demande, date_donner, statut_attestation, statut_notif_back, id_task, message_attestation, files_attestation, id_session) VALUES(?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($name_enteprise),
            htmlspecialchars($date_demande),
            htmlspecialchars($date_donner),
            htmlspecialchars("En cours"),
            htmlspecialchars($statut_notif_back),
            htmlspecialchars($id_task),
            htmlspecialchars($message_attestation),
            htmlspecialchars($files_attestation),
            htmlspecialchars($id_session)
        ));

        
        

        header('Location: ../attestation-fiscale.php?h6W83pUU2b=L6jH744fmT');
        exit(); 
            
    }   

?>
