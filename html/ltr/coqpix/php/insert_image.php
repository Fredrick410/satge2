<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


    $dir = "../../../../src/img/"; // ex : $dir = "../image/logo";
    $target_file = $dir.basename($_FILES['FILES']['name']);
    $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if(move_uploaded_file($_FILES['FILES']['tmp_name'], $target_file)){

    $update = $bdd->prepare('UPDATE entreprise SET img_entreprise = ? WHERE id = ?');
    $update->execute(array(

            ($_FILES['FILES']['name']),
            ($_SESSION['id'])
            
    ));

        header('Location: ../auth-update-first.php');
        die();
    
    }else{

       echo "Erreur upload";

   }

?>