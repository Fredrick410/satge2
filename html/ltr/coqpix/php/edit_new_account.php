<?php

require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
session_start();

        $update = $bdd->prepare('UPDATE entreprise SET nameentreprise = ?, numerossiret = ?, pays_entreprise = ?, adresseentreprise = ?, descr_entreprise = ?, telentreprise = ?, link_website = ?, emailentreprise = ?, datecreation = ?, datedecloture = ?, iban_entreprise = ?, nom_diri = ?, prenom_diri = ?, adresse_diri = ?, telentreprise = ?, email_diri = ? , new_user = ? , color = ? WHERE id = ?');
        $update->execute(array(
            htmlspecialchars($_GET['nameentreprise']),
            htmlspecialchars($_GET['numerossiret']),
            htmlspecialchars($_GET['pays_entreprise']),
            htmlspecialchars($_GET['adresseentreprise']),
            htmlspecialchars($_GET['descr_entreprise']),
            htmlspecialchars($_GET['telentreprise']),
            htmlspecialchars($_GET['link_website']),
            htmlspecialchars($_GET['emailentreprise']),
            htmlspecialchars($_GET['datecreation']),
            htmlspecialchars($_GET['datedecloture']),
            htmlspecialchars($_GET['iban_entreprise']),
            htmlspecialchars($_GET['nom_diri']),
            htmlspecialchars($_GET['prenom_diri']),
            htmlspecialchars($_GET['adresse_diri']),
            htmlspecialchars($_GET['tel_diri']),
            htmlspecialchars($_GET['email_diri']),
            htmlspecialchars("Activé"),
            htmlspecialchars("badge badge-light-info badge-pill"),
            htmlspecialchars($_GET['numentreprise'])
        ));


        $updat = $bdd->prepare('UPDATE calculs SET  id_session = ?  WHERE id = ?');
        $updat->execute(array(
            htmlspecialchars($_GET['numentreprise']),
            htmlspecialchars($_GET['numentreprise'])
        ));

        $upda = $bdd->prepare('UPDATE membres SET id_session = ? WHERE email = ?');
        $upda->execute(array(
            htmlspecialchars($_GET['numentreprise']),
            htmlspecialchars($_GET['emailentreprise'])
        ));

        $updae = $bdd->prepare('UPDATE flash SET id_session = ? WHERE doc_flash = ?');
        $updae->execute(array(
            htmlspecialchars($_GET['numentreprise']),
            htmlspecialchars($_GET['emailentreprise'])
        ));

        $updae = $bdd->prepare('UPDATE flash SET doc_flash = ? WHERE id_session = ?');
        $updae->execute(array(
            htmlspecialchars(""),
            htmlspecialchars($_GET['numentreprise'])
        ));


        sleep(1);
        header('Location: ../page-user-profile.php');
        die();
    

?>