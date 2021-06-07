<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
session_start();


    if($_GET['forme'] == "max"){
        $forme = "min";
    }else{
        $forme = "max"; 
    }

    $pdo = $bdd->prepare('UPDATE entreprise SET forme_cloud=:forme_cloud WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_SESSION['id_session']);
    $pdo->bindValue(':forme_cloud', $forme);   
    $pdo->execute();

    header('Location: ../file-manager.php');
    exit();

?>
