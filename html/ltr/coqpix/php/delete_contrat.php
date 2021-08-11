<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $pdoDe = $bdd->prepare('UPDATE crea_societe SET doc_contrat = ? WHERE id = ?');
        $pdoDe->execute(array( (''), $_GET['id']  ));

        sleep(1);
        header('Location: ../portefeuille.php');
        exit();

?>