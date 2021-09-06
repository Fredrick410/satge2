<?php

    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    require_once 'config.php';

    $num = $_GET['num'];
    $type = $_GET['type'];

    if (is_uploaded_file($_FILES['doc_files']['tmp_name'])) {
        echo "File ". $_FILES['doc_files']['name'] ." téléchargé avec succès.\n";
        $dir = '../../../../src/fiscal/'.$type.'/';

        if(!is_dir($dir)){
            echo " Le répertoire de destination n'existe pas !";
            echo " $dir";
            exit;
        }

        $name_files = $_FILES['doc_files']['name'];                         
        $date_now = '-'.date("H-i-s");
        $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
        $target_file = $_FILES['doc_files']['tmp_name'];                                     
        $real_name = substr($name_files, 0, -4);
        $file_name = $dir. $real_name . $date_now . $type_files; 


        if($resultat = move_uploaded_file($target_file, $file_name)){
            $update = $bdd->prepare('UPDATE fiscal SET doc_'.$type.' = ? WHERE id = ?');
            $update->execute(array( ($real_name . $date_now . $type_files), $num  ));

            header('Location: ../control-fiscal-view.php?num='.$num.'');
            exit();

        }else{
            echo "Erreur lors du déplacement de fichier !"; 
            exit;
        }
    
    }else{
        echo "Erreur lors de l'upload du fichier : ";
        echo "Nom du fichier : '". $_FILES['doc_files']['tmp_name'] . "'.";
    }



?>