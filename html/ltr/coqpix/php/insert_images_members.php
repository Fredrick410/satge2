<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $dir = "../../../../src/img/"; // ex : $dir = "../image/logo";
    $target_file = $dir.basename($_FILES['images']['name']);
    $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if(move_uploaded_file($_FILES['images']['tmp_name'], $target_file)){

    $update = $bdd->prepare('UPDATE images SET images = ? WHERE name_entreprise = ?');
    $update->execute(array(

        ($_FILES['images']['name']),
        ($_POST['name_entreprise'])
            
    ));

        header('Location: ../membres-add.php');
        die();
    
    }else{

       echo "Erreur upload";

   }

?>