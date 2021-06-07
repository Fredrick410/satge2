<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        if($_GET['statut'] == "valide"){

            $pdoStat = $bdd->prepare('SELECT * FROM crea_societe WHERE id = :num');
            $pdoStat->bindValue(':num',$_GET['num']);
            $pdoStat->execute();
            $crea = $pdoStat->fetch();

            $insert = $bdd->prepare('INSERT INTO delete_societe (name_crea, email_crea, password_crea, img_crea, date_crea, date_crea_j, date_crea_j_lettre, date_crea_d, date_crea_a, date_crea_h, date_crea_m, nom_diri, prenom_diri, tel_diri, email_diri, status_crea, favorite_crea, new_user, message_crea, note_crea, notification_crea, notification_admin, doc_statuts, doc_nomination, doc_depot, doc_pouvoir, doc_pieceid, doc_cerfaM0, doc_annonce, doc_cerfaMBE, doc_attestation, doc_justificatifss, doc_justificatifd, doc_xp, doc_peirl, doc_affectation, frais, honoraire, depo_greffe, depo_cfe, article_three) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($crea['name_crea']),
                htmlspecialchars($crea['email_crea']),
                htmlspecialchars($crea['password_crea']),
                htmlspecialchars($crea['img_crea']),
                htmlspecialchars($crea['date_crea']),
                htmlspecialchars($crea['date_crea_j']),
                htmlspecialchars($crea['date_crea_j_lettre']),
                htmlspecialchars($crea['date_crea_d']),
                htmlspecialchars($crea['date_crea_a']),
                htmlspecialchars($crea['date_crea_h']),
                htmlspecialchars($crea['date_crea_m']),
                htmlspecialchars($crea['nom_diri']),
                htmlspecialchars($crea['prenom_diri']),
                htmlspecialchars($crea['tel_diri']),
                htmlspecialchars($crea['email_diri']),
                htmlspecialchars($crea['status_crea']),
                htmlspecialchars($crea['favorite_crea']),
                htmlspecialchars($crea['new_user']),
                htmlspecialchars($crea['message_crea']),
                htmlspecialchars($crea['note_crea']),
                htmlspecialchars($crea['notification_crea']),
                htmlspecialchars($crea['notification_admin']),
                htmlspecialchars($crea['doc_statuts']),
                htmlspecialchars($crea['doc_nomination']),
                htmlspecialchars($crea['doc_depot']),
                htmlspecialchars($crea['doc_pouvoir']),
                htmlspecialchars($crea['doc_pieceid']),
                htmlspecialchars($crea['doc_cerfaM0']),
                htmlspecialchars($crea['doc_annonce']),
                htmlspecialchars($crea['doc_cerfaMBE']),
                htmlspecialchars($crea['doc_attestation']),
                htmlspecialchars($crea['doc_justificatifss']),
                htmlspecialchars($crea['doc_justificatifd']),
                htmlspecialchars($crea['doc_xp']),
                htmlspecialchars($crea['doc_peirl']),
                htmlspecialchars($crea['doc_affectation']),
                htmlspecialchars($crea['frais']),
                htmlspecialchars($crea['honoraire']),
                htmlspecialchars($crea['depo_greffe']),
                htmlspecialchars($crea['depo_cfe']),
                htmlspecialchars($crea['article_three'])
            )); 

                $pdoDel = $bdd->prepare('DELETE FROM crea_societe WHERE id= :num');
                $pdoDel->bindValue(':num', $_GET['num']);
                $pdoDel->execute();

                $redirection = "../crea-list-delete.php";
            
        }elseif($_GET['statut'] == "delete"){

            $pdoStat = $bdd->prepare('SELECT * FROM delete_societe WHERE id = :num');
            $pdoStat->bindValue(':num',$_GET['num']);
            $pdoStat->execute();
            $crea = $pdoStat->fetch();

            $insert = $bdd->prepare('INSERT INTO crea_societe (name_crea, email_crea, password_crea, img_crea, date_crea, date_crea_j, date_crea_j_lettre, date_crea_d, date_crea_a, date_crea_h, date_crea_m, nom_diri, prenom_diri, tel_diri, email_diri, status_crea, favorite_crea, new_user, message_crea, note_crea, notification_crea, notification_admin, doc_statuts, doc_nomination, doc_depot, doc_pouvoir, doc_pieceid, doc_cerfaM0, doc_annonce, doc_cerfaMBE, doc_attestation, doc_justificatifss, doc_justificatifd, doc_xp, doc_peirl, doc_affectation, frais, honoraire, depo_greffe, depo_cfe, article_three) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($crea['name_crea']),
                htmlspecialchars($crea['email_crea']),
                htmlspecialchars($crea['password_crea']),
                htmlspecialchars($crea['img_crea']),
                htmlspecialchars($crea['date_crea']),
                htmlspecialchars($crea['date_crea_j']),
                htmlspecialchars($crea['date_crea_j_lettre']),
                htmlspecialchars($crea['date_crea_d']),
                htmlspecialchars($crea['date_crea_a']),
                htmlspecialchars($crea['date_crea_h']),
                htmlspecialchars($crea['date_crea_m']),
                htmlspecialchars($crea['nom_diri']),
                htmlspecialchars($crea['prenom_diri']),
                htmlspecialchars($crea['tel_diri']),
                htmlspecialchars($crea['email_diri']),
                htmlspecialchars($crea['status_crea']),
                htmlspecialchars($crea['favorite_crea']),
                htmlspecialchars($crea['new_user']),
                htmlspecialchars($crea['message_crea']),
                htmlspecialchars($crea['note_crea']),
                htmlspecialchars($crea['notification_crea']),
                htmlspecialchars($crea['notification_admin']),
                htmlspecialchars($crea['doc_statuts']),
                htmlspecialchars($crea['doc_nomination']),
                htmlspecialchars($crea['doc_depot']),
                htmlspecialchars($crea['doc_pouvoir']),
                htmlspecialchars($crea['doc_pieceid']),
                htmlspecialchars($crea['doc_cerfaM0']),
                htmlspecialchars($crea['doc_annonce']),
                htmlspecialchars($crea['doc_cerfaMBE']),
                htmlspecialchars($crea['doc_attestation']),
                htmlspecialchars($crea['doc_justificatifss']),
                htmlspecialchars($crea['doc_justificatifd']),
                htmlspecialchars($crea['doc_xp']),
                htmlspecialchars($crea['doc_peirl']),
                htmlspecialchars($crea['doc_affectation']),
                htmlspecialchars($crea['frais']),
                htmlspecialchars($crea['honoraire']),
                htmlspecialchars($crea['depo_greffe']),
                htmlspecialchars($crea['depo_cfe']),
                htmlspecialchars($crea['article_three'])
            )); 

                $pdoDel = $bdd->prepare('DELETE FROM delete_societe WHERE id= :num');
                $pdoDel->bindValue(':num', $_GET['num']);
                $pdoDel->execute();

                $redirection = "../creation-list.php";

        }elseif($_GET['statut'] == "trash"){
            $pdoDel = $bdd->prepare('DELETE FROM delete_societe WHERE id= :num');
            $pdoDel->bindValue(':num', $_GET['num']);
            $pdoDel->execute();

            $redirection = "../creation_societe.php";
        }

        header('Location:'.$redirection.'');
        exit();
    
?>