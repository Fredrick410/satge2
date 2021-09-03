<?php

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

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
    $service = array("prestation","travaux","etudes");
    $sstyp = htmlspecialchars($_POST['sstyp']);
    if ($_POST['categorie'] === "bien" && in_array($sstyp,$service)) {
      header('Location: ../app-devis-add.php?jXN955CbHqqbQ463u5Uq=1');
      exit;
    }elseif ($_POST['categorie'] === "service" && !(in_array($sstyp,$service))) {
      header('Location: ../app-devis-add.php?jXN955CbHqqbQ463u5Uq=1');
      exit;
    }

    $insert = $bdd->prepare('INSERT INTO article (article, referencearticle, prixvente, coutachat, tvavente, tvaachat, umesure, typ,sstyp, id_session,categorie) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['article']),
        htmlspecialchars($_POST['referencearticle']),
        htmlspecialchars($_POST['prixvente']),
        htmlspecialchars($_POST['coutachat']),
        htmlspecialchars($_POST['tvavente']),
        htmlspecialchars($_POST['tvaachat']),
        htmlspecialchars($_POST['umesure']),
        htmlspecialchars($typ),
        $sstyp,
        htmlspecialchars($_SESSION['id_session']),
        htmlspecialchars($_POST['categorie'])
    ));

    header('Location: ../app-devis-add.php?jXN955CbHqqbQ463u5Uq=1');

?>
