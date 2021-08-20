<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_crea.php';
    
$update = $bdd->prepare('UPDATE crea_societe SET doc_domiciliation = ? WHERE id = ?');
$update->execute(array( (""), $_SESSION['id_crea'] ));

$update = $bdd->prepare('UPDATE crea_societe SET adresse_entreprise = ? WHERE id = ?');
$update->execute(array( (""), $_SESSION['id_crea'] ));

$update = $bdd->prepare('UPDATE crea_societe SET ville_entreprise = ? WHERE id = ?');
$update->execute(array( (""), $_SESSION['id_crea'] ));

//désactive la notif générale et la supprime
$pdoSta = $bdd->prepare('DELETE FROM notif_back WHERE type_demande=:type_demande AND id_session=:num');
     $pdoSta->bindValue(':num', $_SESSION['id_crea']);
     $pdoSta->bindValue(':type_demande', "domiciliation");
     $pdoSta->execute();

header('Location: ../page-creation.php');
?>