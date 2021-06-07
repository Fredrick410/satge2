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


    $pdo = $bdd->prepare('UPDATE article SET article=:article, referencearticle=:referencearticle, prixvente=:prixvente, coutachat=:coutachat, tvavente=:tvavente, tvaachat=:tvaachat, umesure=:umesure, typ=:typ, id_session=:id_session WHERE id=:num LIMIT 1');
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
    $pdo->execute();
        
        sleep(2);
        header('Location: ../article-list.php');
        
    

?>
