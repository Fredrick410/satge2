<?php
require_once 'verif_session_connect_admin.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if ($_POST['libelle'] != "" and $_POST['qualitatif'] != "") {
    $qualitatif = array("Oui", "Non");
    if (in_array($_POST['qualitatif'], $qualitatif)) {
        try {
            $insert = $bdd->prepare("INSERT INTO qcm(libelle, auteur, qualitatif) VALUES(?, (SELECT nameentreprise FROM admin WHERE id = ?), ?)");
            $insert->execute(array(
                htmlspecialchars($_POST['libelle']),
                htmlspecialchars($_SESSION['id_admin']), //$_SESSION
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
