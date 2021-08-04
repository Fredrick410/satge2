<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_prelevement = htmlspecialchars($_POST['name_prelevement']);
    $montant = htmlspecialchars($_POST['montant']);
    $dte = htmlspecialchars($_POST['dte_prelevement']);
    $dte_m = htmlspecialchars($_POST['date_m']);
    $dte_a = htmlspecialchars($_POST['date_a']);
    $statut = htmlspecialchars($_POST['statut']);
    $dte_rejet = "";
    $id_session = htmlspecialchars($_GET['num']);

    echo $dte;

    $insert = $bdd->prepare('INSERT INTO prelevement_social (name_prelevement , montant, dte, dte_m, dte_a, statut, dte_rejet, id_session) VALUES(?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_prelevement),
        htmlspecialchars($montant),
        htmlspecialchars($dte),
        htmlspecialchars($dte_m),
        htmlspecialchars($dte_a),
        htmlspecialchars($statut),
        htmlspecialchars($dte_rejet),
        htmlspecialchars($id_session)
    ));

    header('Location: ../portefeuille-view-social.php?num='.$id_session.'');
    exit();

?>