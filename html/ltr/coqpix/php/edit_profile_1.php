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
        $update_entreprise->bindValue(':nameentreprise', htmlspecialchars($_GET['nameentreprise']));
        $update_entreprise->bindValue(':numerossiret', htmlspecialchars($_GET['numerossiret']));
        $update_entreprise->bindValue(':pays', htmlspecialchars($_GET['pays_entreprise']));
        $update_entreprise->bindValue(':adresse', htmlspecialchars($_GET['adresseentreprise']));
        $update_entreprise->bindValue(':descr', htmlspecialchars($_GET['descr_entreprise']));
        $update_entreprise->bindValue(':tel', htmlspecialchars($_GET['telentreprise']));
        $update_entreprise->bindValue(':website', htmlspecialchars($_GET['link_website']));
        $update_entreprise->bindValue(':email', htmlspecialchars($_GET['emailentreprise']));
        $update_entreprise->bindValue(':datecreation', htmlspecialchars($_GET['datecreation']));
        $update_entreprise->bindValue(':datecloture', htmlspecialchars($_GET['datedecloture']));
        $update_entreprise->bindValue(':iban', htmlspecialchars($_GET['iban_entreprise']));
        $update_entreprise->bindValue(':id_entreprise', htmlspecialchars($_GET['numentreprise']));
        $update_entreprise->execute();

        $update_membre = $bdd->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, tel = :tel, email = :email WHERE id = :id_membre');
        $update_membre->bindValue(':nom', htmlspecialchars($_GET['nom_membre']));
        $update_membre->bindValue(':prenom', htmlspecialchars($_GET['prenom_membre']));
        $update_membre->bindValue(':tel', htmlspecialchars($_GET['tel_membre']));
        $update_membre->bindValue(':email', htmlspecialchars($_GET['email_membre']));
        $update_membre->bindValue(':id_membre', htmlspecialchars($_GET['id_membre']));
        $update_membre->execute();

        sleep(1);
        header('Location: ../page-user-profile.php');
        die();
    
?>