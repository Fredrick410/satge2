<?php 

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

$incre = $bdd->prepare('SELECT MAX(id_article) FROM article ');
$incre->execute();
$test = $incre->fetch();
$maxid = $test['MAX(id_article)'] + 1;


    if($_POST['prixvente'] == "" && $_POST['coutachat'] == ""){

        $typ = "Aucun";

    }else{

        if($_POST['coutachat'] == ""){

                $typ = "Ventes";
            
        }else{

            if($_POST['prixvente'] == "" ){

                $typ = "Achats";
            }else{

                $typ = "Ventes et Achats";

            }
            
        }

    }

    if(isset($_FILES['img']) AND !empty($_FILES['img']['name'])) {
        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
        if($_FILES['img']['size'] <= $tailleMax) {
           $extensionUpload = strtolower(substr(strrchr($_FILES['img']['name'], '.'), 1));
           if(in_array($extensionUpload, $extensionsValides)) {
              $chemin = "../../../../app-assets/images/article/".$maxid.".".$extensionUpload;
              $resultat = move_uploaded_file($_FILES['img']['tmp_name'], $chemin);
              if($resultat) {
                 $path = $maxid.".".$extensionUpload;
                 $insert = $bdd->prepare('INSERT INTO article (article, referencearticle, prixvente, coutachat, tvavente, tvaachat, umesure, typ, img, id_session, stock, nom_fournisseur, id_fournisseur) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
                $insert->execute(array(
                    htmlspecialchars($_POST['article']),
                    htmlspecialchars($_POST['referencearticle']),
                    htmlspecialchars($_POST['prixvente']),
                    htmlspecialchars($_POST['coutachat']),
                    htmlspecialchars($_POST['tvavente']),
                    htmlspecialchars($_POST['tvaachat']),
                    htmlspecialchars($_POST['umesure']),
                    htmlspecialchars($typ),
                    htmlspecialchars($path),
                    htmlspecialchars($_SESSION['id_session']),
                    htmlspecialchars($_POST['stock']),
                    htmlspecialchars($_POST['nom_fournisseur']),
                    htmlspecialchars($_POST['id_fournisseur'])
                    // htmlspecialchars($_POST['adresse']),
                    // htmlspecialchars($_POST['codepostal']),
                    // htmlspecialchars($_POST['departement']),
                    // htmlspecialchars($_POST['email']),
                    // htmlspecialchars($_POST['tel'])
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
        $insert = $bdd->prepare('INSERT INTO article (article, referencearticle, prixvente, coutachat, tvavente, tvaachat, umesure, typ, id_session, stock, nom_fournisseur, id_fournisseur) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($_POST['article']),
            htmlspecialchars($_POST['referencearticle']),
            htmlspecialchars($_POST['prixvente']),
            htmlspecialchars($_POST['coutachat']),
            htmlspecialchars($_POST['tvavente']),
            htmlspecialchars($_POST['tvaachat']),
            htmlspecialchars($_POST['umesure']),
            htmlspecialchars($typ),
            htmlspecialchars($_SESSION['id_session']),
            htmlspecialchars($_POST['stock']),
            htmlspecialchars($_POST['nom_fournisseur']),
            htmlspecialchars($_POST['id_fournisseur'])
            // htmlspecialchars($_POST['adresse']),
            // htmlspecialchars($_POST['codepostal']),
            // htmlspecialchars($_POST['departement']),
            // htmlspecialchars($_POST['email']),
            // htmlspecialchars($_POST['tel'])
        ));
    }


     header('Location: ../inventaire-stock.php');



    

?>