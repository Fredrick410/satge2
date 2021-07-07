<?php 

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

$incre = $bdd->prepare('SELECT MAX(id) FROM article ');
$incre->execute();
$test = $incre->fetch();
$maxid = $test['MAX(id)'] + 1;

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

    $insert = $bdd->prepare('INSERT INTO article (article, referencearticle, prixvente, coutachat, tvavente, tvaachat, umesure, typ, id_session, stock, nom_fournisseur) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
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
        htmlspecialchars($_POST['nom_fournisseur'])
    ));

    header('Location: ../app-invoice-add.php?jXN955CbHqqbQ463u5Uq=1');

?>