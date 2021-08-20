<?php 

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

$incre = $bdd->prepare('SELECT MAX(id_prestation) FROM prestation ');
$incre->execute();
$test = $incre->fetch();
$maxid = $test['MAX(id_prestation)'] + 1;


    if($_POST['coutachat'] == ""){

        $typ = "Aucun";
            
    }else{

        $typ = "Ventes";

    }

    if(isset($_FILES['img']) AND !empty($_FILES['img']['name'])) {
        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
        if($_FILES['img']['size'] <= $tailleMax) {
           $extensionUpload = strtolower(substr(strrchr($_FILES['img']['name'], '.'), 1));
           if(in_array($extensionUpload, $extensionsValides)) {
              $chemin = "../../../../app-assets/images/prestation/".$maxid.".".$extensionUpload;
              $resultat = move_uploaded_file($_FILES['img']['tmp_name'], $chemin);
              if($resultat) {
                 $path = $maxid.".".$extensionUpload;
                 $insert = $bdd->prepare('INSERT INTO prestation (prestation, referencepresta, coutachat, tvaachat, umesure, typ, img, id_session, id_fournisseur) VALUES(?,?,?,?,?,?,?,?,?)');
                $insert->execute(array(
                    htmlspecialchars($_POST['prestation']),
                    htmlspecialchars($_POST['referencepresta']),
                    htmlspecialchars($_POST['coutachat']),
                    htmlspecialchars($_POST['tvaachat']),
                    htmlspecialchars($_POST['umesure']),
                    htmlspecialchars($typ),
                    htmlspecialchars($path),
                    htmlspecialchars($_SESSION['id_session']),
                    htmlspecialchars($_POST['id_fournisseur'])
                ));
               
                    
              } else {
                 $msg = "Erreur durant l'importation de votre photo";
              }
           } else {
              $msg = "Votre photo être au format jpg, jpeg, gif ou png";
           }
        } else {
           $msg = "Votre photo ne doit pas dépasser 2Mo";
        }

    }elseif(empty($_FILES['img']['name'])){
        $insert = $bdd->prepare('INSERT INTO prestation (prestation, referencepresta, coutachat, tvaachat, umesure, typ, id_session, id_fournisseur) VALUES(?,?,?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($_POST['prestation']),
            htmlspecialchars($_POST['referencepresta']),
            htmlspecialchars($_POST['coutachat']),
            htmlspecialchars($_POST['tvaachat']),
            htmlspecialchars($_POST['umesure']),
            htmlspecialchars($typ),
            htmlspecialchars($_SESSION['id_session']),
            htmlspecialchars($_POST['id_fournisseur'])
        ));
    }

    header('Location: ../app-invoice-add.php?jXN955CbHqqbQ463u5Uq=1');

?>