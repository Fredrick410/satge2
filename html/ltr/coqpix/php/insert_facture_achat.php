<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
session_start();

            

            if (is_uploaded_file($_FILES['files']['tmp_name'])) {
            echo "File ". $_FILES['files']['name'] ." téléchargé avec succès.\n";
            $dir = '../../../../src/files/fac-achat/';
        
            if(!is_dir($dir)){
                echo " Le répertoire de destination n'existe pas !";
            exit;
            }
        
            $name_files = $_FILES['files']['name'];      
            $date_H = date("H") + 1;
            $date_mins = date("-i-s");                 
            $date_now = $date_H.$date_mins;
            $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
            $target_file = $_FILES['files']['tmp_name'];   
            $real_name = substr($name_files, 0, -4);
            $name_final = ''.$real_name.'-'.$date_now.''.$type_files.'';                                  
            $file_name = $dir. $name_final;

            if($resultat = move_uploaded_file($target_file, $file_name)){

                $name_facture = !empty($_POST["name_facture"]) ? $_POST["name_facture"] : NULL;
                $num_facture = !empty($_POST["num_facture"]) ? $_POST["num_facture"] : NULL;
                $name_fournisseur = !empty($_POST["name_fournisseur"]) ? $_POST["name_fournisseur"] : NULL;
                $dte = !empty($_POST["dte"]) ? $_POST["dte"] : NULL;
                $doc_facture = !empty($_POST["doc_facture"]) ? $_POST["doc_facture"] : NULL;
                $id_session = !empty($_SESSION["id_session"]) ? $_SESSION["id_session"] : NULL;

                $insert = $bdd->prepare('INSERT INTO facture_achat (name_facture, num_facture, name_fournisseur, dte, doc_facture, id_session) VALUES(?,?,?,?,?,?)');
                $insert->execute(array(
                    htmlspecialchars($_POST['name_facture']),
                    htmlspecialchars($_POST['num_facture']),
                    htmlspecialchars($_POST['name_fournisseur']),
                    htmlspecialchars($_POST['dte']),
                    htmlspecialchars($name_final),
                    htmlspecialchars($_SESSION['id_session'])
                ));

                $size_files = $_FILES['files']['size']; ;
                $date_j = substr($dte, -2);
                $date_m = substr($dte,5,-3);
                $date_a = substr($dte,0 ,4);

                $insert = $bdd->prepare('INSERT INTO stockage (name_files, size_files, dte_files, dte_j, dte_m, dte_a, img_files, type_files_note, type_files_avoir, type_files_fac_achat, type_files_fac_ventes, type_files_caisse_ventes, banque, send_files, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                $insert->execute(array(
                    htmlspecialchars(($name_final)),
                    htmlspecialchars(($size_files)),
                    htmlspecialchars(($dte)),
                    htmlspecialchars(($date_j)),
                    htmlspecialchars(($date_m)),
                    htmlspecialchars(($date_a)),
                    htmlspecialchars(($type_files)),
                    (""),
                    (""),
                    ("fac_achat"),
                    (""),
                    (""),
                    (""),
                    ("#FF0000"),
                    htmlspecialchars(($_SESSION['id_session']))
                ));

                header('Location: ../app-invoice-achat-list.php');
                exit();

            }else{
                echo "Erreur lors de l'upload du fichier : ";
                echo "Nom du fichier : '". $_FILES['files']['tmp_name'] . "'.";
            }
        }
?>