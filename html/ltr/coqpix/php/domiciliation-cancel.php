<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_crea.php';
    
$update = $bdd->prepare('UPDATE crea_societe SET doc_domiciliation = ? WHERE id = ?');
$update->execute(array( (""), $_SESSION['id_crea'] ));
header('Location: ../page-creation.php');
?>