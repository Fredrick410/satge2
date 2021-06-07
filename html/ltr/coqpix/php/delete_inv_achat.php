<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        if($_GET['numdoc'] != ""){
            
            $fichier = '../../../../src/files/fac-achat/'.$_GET['numdoc'].'';

            unlink( $fichier );

            $pdoDel = $bdd->prepare('DELETE FROM facture_achat WHERE id=:num AND id_session=:id_session');
            $pdoDel->bindValue(':num', $_GET['id']);
            $pdoDel->bindValue(':id_session', $_SESSION['id_session']);
            $pdoDel->execute();

            $pdoDel = $bdd->prepare('DELETE FROM stockage WHERE name_files=:num AND id_session=:id_session');
            $pdoDel->bindValue(':num', $_GET['numdoc']);
            $pdoDel->bindValue(':id_session', $_SESSION['id_session']);
            $pdoDel->execute();
        }

        sleep(1);
        header('Location: ../app-invoice-achat-list.php');
        exit();
?>