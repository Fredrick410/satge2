<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

// On verifie l'existence des parametres
if ($_POST['libelle'] != "" and $_POST['qualitatif'] != "") {
    $qualitatif = array("Oui", "Non");
    // On verifie la valeur de qualitatif
    if (in_array($_POST['qualitatif'], $qualitatif)) {
        try {
            $insert = $bdd->prepare("INSERT INTO qcm(libelle, auteur, qualitatif) VALUES(?, (SELECT nameentreprise FROM entreprise WHERE id = ?), ?)");
            $insert->execute(array(
                htmlspecialchars($_POST['libelle']),
                htmlspecialchars($_SESSION['id_session']), //$_SESSION
                $_POST['qualitatif']
            ));
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            exit();
        }
        exit();
    }
}
exit();
