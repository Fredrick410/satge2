<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $link= htmlspecialchars($_GET['link']);

    if ($link === "files") {
        $date = date('Y-m-d');

        $pdoSta = $bdd->prepare('UPDATE fiscal SET trash_statut=:trash_statut WHERE id=:num LIMIT 1');
        $pdoSta->bindValue(':trash_statut',$date);
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        header('Location:../control-fiscal.php');
        exit();
    }

    if ($link === "reset") {
        $pdoSta = $bdd->prepare('UPDATE fiscal SET trash_statut=:trash_statut WHERE id=:num LIMIT 1');
        $pdoSta->bindValue(':trash_statut','');
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        header('Location:../control-fiscal-corbeille.php');
        exit();
    }

    if ($link === "suppr") {
   
        $pdoStat = $bdd->prepare('SELECT * FROM fiscal WHERE id = :num');
        $pdoStat->bindValue(':num',$_GET['num']);
        $pdoStat->execute();
        $societe = $pdoStat->fetch();

        // Phase 1
        if($societe['doc_mandat'] !== "" AND is_null($societe['doc_cerfa27'])==false ){
            $doc_mandat = '../../../../src/fiscal/Phase1/mandat/'.$societe['doc_mandat'].'';
            if (file_exists($doc_mandat)) {
                unlink($doc_mandat);
            }
        }

        if($societe['doc_cerfa27'] !== "" AND is_null($societe['doc_cerfa27'])==false ){
            $doc_cerfa27 = '../../../../src/fiscal/Phase1/cerfa_27/'.$societe['doc_cerfa27'].'';
            if (file_exists($doc_cerfa27)) {
                unlink($doc_cerfa27);
            }
        }

        if($societe['doc_cour'] !== "" AND is_null($societe['doc_cour'])==false ){
            $doc_cour = '../../../../src/fiscal/Phase1/courrier/'.$societe['doc_cour'].'';
            if (file_exists($doc_cour)) {
                unlink($doc_cour);
            }
        }

        if($societe['doc_fec'] !== "" AND is_null($societe['doc_fec'])==false ){
            $doc_fec = '../../../../src/fiscal/Phase1/fichier_FEC/'.$societe['doc_fec'].'';
            if (file_exists($doc_fec)) {
                unlink($doc_fec);
            }
        }

        if($societe['doc_rdv'] !== "" AND is_null($societe['doc_rdv'])==false ){
            $doc_rdv = '../../../../src/fiscal/Phase1/attestation_RDV/'.$societe['doc_rdv'].'';
            if (file_exists($doc_rdv)) {
                unlink($doc_rdv);
            }
        }

        //Phase 2
        if($societe['doc_mail'] !== "" AND is_null($societe['doc_mail'])==false ){
            $doc_mail = '../../../../src/fiscal/Phase2/mail/'.$societe['doc_mail'].'';
            if (file_exists($doc_mail)) {
                unlink($doc_mail);
            }
        }

        if($societe['doc_noteV'] !== "" AND is_null($societe['doc_noteV'])==false ){
            $doc_noteV = '../../../../src/fiscal/Phase2/note_int/'.$societe['doc_noteV'].'';
            if (file_exists($doc_noteV)) {
                unlink($doc_noteV);
            }
        }

        //Phase 3
        if($societe['doc_cerfa24'] !== "" AND is_null($societe['doc_cerfa24'])==false ){
            $doc_cerfa24 = '../../../../src/fiscal/Phase3/cerfa_24/'.$societe['doc_cerfa24'].'';
            if (file_exists($doc_cerfa24)) {
                unlink($doc_cerfa24);
            }
        }

        if($societe['doc_cerfa26'] !== "" AND is_null($societe['doc_cerfa26'])==false ){
            $doc_cerfa26 = '../../../../src/fiscal/Phase3/cerfa_26/'.$societe['doc_cerfa26'].'';
            if (file_exists($doc_cerfa26)) {
                unlink($doc_cerfa26);
            }
        }

        if($societe['doc_contest'] !== "" AND is_null($societe['doc_contest'])==false ){
            $doc_contest = '../../../../src/fiscal/Phase3/courrier_contest/'.$societe['doc_contest'].'';
            if (file_exists($doc_contest)) {
                unlink($doc_contest);
            }
        }
    
        //Phase 4
        if($societe['doc_saisine'] !== "" AND is_null($societe['doc_saisine'])==false ){
            $doc_saisine = '../../../../src/fiscal/Phase4/saisine/'.$societe['doc_saisine'].'';
            if (file_exists($doc_saisine)) {
                unlink($doc_saisine);
            }
        }

        if($societe['doc_noteI'] !== "" AND is_null($societe['doc_noteI'])==false ){
            $doc_noteI = '../../../../src/fiscal/Phase4/note_int/'.$societe['doc_noteI'].'';
            if (file_exists($doc_noteI)) {
                unlink($doc_noteI);
            }
        }

        $pdoStat = $bdd->prepare('DELETE FROM fiscal WHERE id = :num');
        $pdoStat->bindValue(':num',$_GET['num']);
        $pdoStat->execute();   
        header('Location:../control-fiscal-corbeille.php');
        exit();
    }

    
?>