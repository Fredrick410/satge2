<?php

require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $update_entreprise = $bdd->prepare('UPDATE entreprise SET nameentreprise = :nameentreprise, 
                                                                numerossiret = :numerossiret,
                                                                pays_entreprise = :pays,
                                                                adresseentreprise = :adresse,
                                                                descr_entreprise = :descr,
                                                                telentreprise = :tel,
                                                                link_website = :website,
                                                                emailentreprise = :email,
                                                                datecreation = :datecreation,
                                                                datedecloture = :datecloture,
                                                                iban_entreprise = :iban
                                                                WHERE id = :id_entreprise');
        $update_entreprise->bindValue(':nameentreprise', htmlspecialchars($_POST['nameentreprise']));
        $update_entreprise->bindValue(':numerossiret', htmlspecialchars($_POST['numerossiret']));
        $update_entreprise->bindValue(':pays', htmlspecialchars($_POST['pays_entreprise']));
        $update_entreprise->bindValue(':adresse', htmlspecialchars($_POST['adresseentreprise']));
        $update_entreprise->bindValue(':descr', htmlspecialchars($_POST['descr_entreprise']));
        $update_entreprise->bindValue(':tel', htmlspecialchars($_POST['telentreprise']));
        $update_entreprise->bindValue(':website', htmlspecialchars($_POST['link_website']));
        $update_entreprise->bindValue(':email', htmlspecialchars($_POST['emailentreprise']));
        $update_entreprise->bindValue(':datecreation', htmlspecialchars($_POST['datecreation']));
        $update_entreprise->bindValue(':datecloture', htmlspecialchars($_POST['datedecloture']));
        $update_entreprise->bindValue(':iban', htmlspecialchars($_POST['iban_entreprise']));
        $update_entreprise->bindValue(':id_entreprise', htmlspecialchars($_POST['numentreprise']));
        $update_entreprise->execute();

        $update_membre = $bdd->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, tel = :tel, email = :email WHERE id = :id_membre');
        $update_membre->bindValue(':nom', htmlspecialchars($_POST['nom_membre']));
        $update_membre->bindValue(':prenom', htmlspecialchars($_POST['prenom_membre']));
        $update_membre->bindValue(':tel', htmlspecialchars($_POST['tel_membre']));
        $update_membre->bindValue(':email', htmlspecialchars($_POST['email_membre']));
        $update_membre->bindValue(':id_membre', htmlspecialchars($_POST['id_membre']));
        $update_membre->execute();

sleep(1);
header('Location: ../page-user-profile.php');
die();
    
?>