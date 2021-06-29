<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

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

    //iimage

    if(isset($_FILES['img']) AND !empty($_FILES['img']['name'])) {
        $pdoDell = $bdd->prepare('SELECT * FROM article WHERE id=:num');
        $pdoDell->bindValue(':num', $_POST['id']);
        $pdoDell->execute();
        $article = $pdoDell->fetch();

        $image = $article['img'];
        
        $chemin = "../../../../app-assets/images/article/$image";
        if(file_exists($chemin)){
        unlink($chemin);
        }
        
        
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($_FILES['img']['size'] <= $tailleMax) {
               $extensionUpload = strtolower(substr(strrchr($_FILES['img']['name'], '.'), 1));
               if(in_array($extensionUpload, $extensionsValides)) {
                  $chemin = "../../../../app-assets/images/article/".$_POST['id'].".".$extensionUpload;
                  $resultat = move_uploaded_file($_FILES['img']['tmp_name'], $chemin);
                  if($resultat) {
                     $path = $_POST['id'].".".$extensionUpload;
                     $pdo = $bdd->prepare('UPDATE article SET article=:article, referencearticle=:referencearticle, prixvente=:prixvente, coutachat=:coutachat, tvavente=:tvavente, tvaachat=:tvaachat, umesure=:umesure, typ=:typ, img=:img, stock=:stock, nom_fournisseur=:nom_fournisseur  WHERE id=:num AND id_session=:id_session LIMIT 1');
                     $pdo->bindValue(':num', $_POST['id']);
                     $pdo->bindValue(':article', $_POST['article']);
                     $pdo->bindValue(':referencearticle', $_POST['referencearticle']);
                     $pdo->bindValue(':prixvente', $_POST['prixvente']);
                     $pdo->bindValue(':coutachat', $_POST['coutachat']);
                     $pdo->bindValue(':tvavente', $_POST['tvavente']);
                     $pdo->bindValue(':tvaachat', $_POST['tvaachat']);
                     $pdo->bindValue(':umesure', $_POST['umesure']);
                     $pdo->bindValue(':typ', $typ);
                     $pdo->bindValue(':img', $path);
                     $pdo->bindValue(':id_session', $_SESSION['id_session']);  
                     $pdo->bindValue(':stock', $_POST['stock']);
                     $pdo->bindValue(':nom_fournisseur', $_POST['nom_fournisseur']);
                     $pdo->execute();

                     
                     header('Location: ../article-list.php');
                      
                  } else {
                     echo "Erreur durant l'importation de votre photo, votre image doit faire maximum 2 Mo.";
                  }
               } else {
                  echo "Votre photo être au format jpg, jpeg, gif ou png";
               }
        }   
         
    }else
    {
        $pdo = $bdd->prepare('UPDATE article SET article=:article, referencearticle=:referencearticle, prixvente=:prixvente, coutachat=:coutachat, tvavente=:tvavente, tvaachat=:tvaachat, umesure=:umesure, typ=:typ, img=:img, stock=:stock, nom_fournisseur=:nom_fournisseur WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_POST['id']);
        $pdo->bindValue(':article', $_POST['article']);
        $pdo->bindValue(':referencearticle', $_POST['referencearticle']);
        $pdo->bindValue(':prixvente', $_POST['prixvente']);
        $pdo->bindValue(':coutachat', $_POST['coutachat']);
        $pdo->bindValue(':tvavente', $_POST['tvavente']);
        $pdo->bindValue(':tvaachat', $_POST['tvaachat']);
        $pdo->bindValue(':umesure', $_POST['umesure']);
        $pdo->bindValue(':typ', $typ);
        $pdo->bindValue(':id_session', $_SESSION['id_session']);  
        $pdo->bindValue(':stock', $_POST['stock']);
        $pdo->bindValue(':nom_fournisseur', $_POST['nom_fournisseur']);
        $pdo->execute();

        sleep(2);
        header('Location: ../article-list.php');
    }
        
    

?>
