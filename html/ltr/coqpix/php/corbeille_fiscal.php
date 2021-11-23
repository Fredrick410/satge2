<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $link= htmlspecialchars($_GET['link']);

    if ($link === "files") {
        $date = date('Y-m-d');
        // Mise en corbeille du dossier selon son id
        $pdoSta = $bdd->prepare('UPDATE fiscal SET trash_statut=:trash_statut WHERE id=:num LIMIT 1');
        $pdoSta->bindValue(':trash_statut',$date);
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        header('Location:../control-fiscal.php');
        exit();
    }

    if ($link === "reset") {
        // Restoration du dossier selon son id et son état intérieur
        $pdoSta = $bdd->prepare('UPDATE fiscal SET trash_statut=:trash_statut WHERE id=:num LIMIT 1');
        $pdoSta->bindValue(':trash_statut','');
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        header('Location:../control-fiscal-corbeille.php');
        exit();
    }

    if ($link === "suppr") {
        // Suppression définitive du dossier avec les fichiers liées
        // Selection du dossier selon son id
        $pdoStat = $bdd->prepare('SELECT * FROM fiscal WHERE id = :num');
        $pdoStat->bindValue(':num',$_GET['num']);
        $pdoStat->execute();
        $societe = $pdoStat->fetch();

        function docSuppr ($doc,$phase,$type){
            if($doc !== "" AND is_null($doc)==false ){
                $doc_dir = '../../../../src/fiscal/'.$phase.'/'.$type.'/'.$societe['doc_mandat'].'';
                if (file_exists($doc_dir)) {
                    unlink($doc_dir);
                }
            }            
        }
  
        /*
            if($societe['doc_mandat'] !== "" AND is_null($societe['doc_cerfa27'])==false ){
                $doc_mandat = '../../../../src/fiscal/Phase1/mandat/'.$societe['doc_mandat'].'';
                if (file_exists($doc_mandat)) {
                    unlink($doc_mandat);
                }
            }
        */

        // Suppression des fichers de la Phase 1

        docSuppr($societe['doc_mandat'],"Phase1","mandat");
        docSuppr($societe['doc_cerfa27'],"Phase1","cerfa_27");
        docSuppr($societe['doc_cour'],"Phase1","courrier");
        docSuppr($societe['doc_fec'],"Phase1","fichier_FEC");
        docSuppr($societe['doc_rdv'],"Phase1","attestation_RDV");

        //Phase 2
        docSuppr($societe['doc_mail'],"Phase2","mail");
        docSuppr($societe['doc_noteV'],"Phase2","note_int");

        //Phase 3
        docSuppr($societe['doc_cerfa24'],"Phase3","cerfa_24");
        docSuppr($societe['doc_cerfa26'],"Phase3","cerfa_26");
        docSuppr($societe['doc_contest'],"Phase3","courrier_contest");
    
        //Phase 4
        docSuppr($societe['doc_saisine'],"Phase4","saisine");
        docSuppr($societe['doc_noteI'],"Phase4","note_int");

        $pdoStat = $bdd->prepare('DELETE FROM fiscal WHERE id = :num');
        $pdoStat->bindValue(':num',$_GET['num']);
        $pdoStat->execute();   
        header('Location:../control-fiscal-corbeille.php');
        exit();
    }

    
?>