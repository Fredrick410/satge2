<?php 
require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_enteprise = $_POST['name_entreprise'];
    $date_demande = date('d/m/Y');
    $date_donner = "";
    $statut_notif_back = "Non Lue";
    $message_attestation = "";
    $files_attestation = "";
    $id_session = $_POST['num'];

    if($_GET['type'] == "sociale"){

        $type_attestation = $_POST['type_attestation'];

        if($type_attestation !== ""){

            $insert = $bdd->prepare('INSERT INTO attestation_sociale (name_entreprise, date_demande, date_donner, type_attestation, statut_attestation, statut_notif_back, message_attestation, files_attestation, id_session) VALUES(?,?,?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($name_enteprise),
                htmlspecialchars($date_demande),
                htmlspecialchars($date_donner),
                htmlspecialchars($type_attestation),
                htmlspecialchars("En cours"),
                htmlspecialchars($statut_notif_back),
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


        $insert = $bdd->prepare('INSERT INTO attestation_fiscale (name_entreprise, date_demande, date_donner, statut_attestation, statut_notif_back, message_attestation, files_attestation, id_session) VALUES(?,?,?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($name_enteprise),
            htmlspecialchars($date_demande),
            htmlspecialchars($date_donner),
            htmlspecialchars("En cours"),
            htmlspecialchars($statut_notif_back),
            htmlspecialchars($message_attestation),
            htmlspecialchars($files_attestation),
            htmlspecialchars($id_session)
        ));

            header('Location: ../attestation-fiscale.php?h6W83pUU2b=L6jH744fmT');
            exit(); 

    }   

?>
