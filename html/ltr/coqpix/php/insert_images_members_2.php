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

    $update = $bdd->prepare('UPDATE membres SET img_membres = ? WHERE id = ?');
    $update->execute(array(

        htmlspecialchars($_FILES['images']['name']),
        htmlspecialchars($_POST['id'])
            
    ));

        header('Location: ../loading/loading-insert-images-membres');
        die();
    
    }else{

       echo "Erreur upload";

   }

?>