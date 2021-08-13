<?php

require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $update_membre = $bdd->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, tel = :tel, email = :email WHERE id = :id_membre');
    $update_membre->bindValue(':nom', htmlspecialchars($_POST['nom_membre']));
    $update_membre->bindValue(':prenom', htmlspecialchars($_POST['prenom_membre']));
    $update_membre->bindValue(':tel', htmlspecialchars($_POST['tel_membre']));
    $update_membre->bindValue(':email', htmlspecialchars($_POST['email_membre']));
    $update_membre->bindValue(':id_membre', htmlspecialchars($_GET['id_membre']));
    $update_membre->execute();

sleep(1);
header('Location: ../page-user-profile.php');
die();
    
?>