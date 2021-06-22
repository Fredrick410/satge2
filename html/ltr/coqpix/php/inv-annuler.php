<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    // vide

    
$color = "badge badge-light-warning badge-pill";
    $insert = $bdd->prepare('UPDATE facture SET status_facture=:facture, status_color=:color WHERE id=:id');
    $insert->bindValue(':id', $_GET['id']);
    $insert->bindValue(':facture', $_GET['statusfac']);
    $insert->bindValue(':color', $color);
    $insert->execute();

       

    header('Location: ../app-invoice-list.php');
    exit();


    
?>