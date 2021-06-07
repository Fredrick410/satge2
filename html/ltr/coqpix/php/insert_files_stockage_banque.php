<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_FILES['files']['error'] > 0){

        echo"Une erreur est survenue lors du téléchargement du fichier";
        die();

    }

    $size_files = $_FILES['files']['size'];                                       // Nous recuperons la taille du fichier
    $name_files = $_FILES['files']['name'];                                       // Nous recuperons le nom du fichier
    $img_files = strtolower(substr(strrchr($name_files, '.'), 1));               // Nous recuperons le type du fichier ex pdf ect
    $dte_files = date('d-m-Y');
    $dte_files = $_POST['dte_files'];                                                  // Nous recuperons la date ou le fichier à etait upload
    $dte_j = substr($dte_files, -2, 10);
    $dte_m = substr($dte_files, -5, -3);                                                         // Nous recuperons le mois
    $dte_a = substr($dte_files, 0, 4);                                                            // Nous recuperons le mois
    
    $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
    $path = "../../../../src/files/banque/". $name_files;                     // chemin vers le serveur

    $resultat = move_uploaded_file($tmpName, $path);

    if($img_files == "pdf"){
        $img_files = "pdf.png";
    }else{
        if($img_files == "psd"){
            $img_files = "psd.png";
        }else{
            if($img_files == "sketch"){
                $img_files = "sketch.png";
            }else{
                $img_files = "doc.png";
            }
        }
    }

    if($resultat){
        
        $insert = $bdd->prepare('INSERT INTO stockage (name_files, size_files, dte_files, dte_j, dte_m, dte_a, img_files, type_files_note, type_files_avoir, type_files_fac_achat, type_files_fac_ventes, type_files_caisse_ventes, banque, send_files, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
        ($name_files),
        ($size_files),
        ($dte_files),
        ($dte_j),
        ($dte_m),
        ($dte_a),
        ($img_files),
        (""),
        (""),
        (""),
        (""),
        (""),
        ("banque"),
        ("#FF0000"),
        ($_SESSION['id_session'])
    ));

    header('Location: ../file-manager-banque.php?');

    }
    
?>