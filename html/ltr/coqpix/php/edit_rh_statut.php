<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$id = $_SESSION['candidat'];
if($_SESSION['candidat'] == $_GET['num']){
    if (isset($_GET['type'])) {
        $type = array("success", "failure");
        if (in_array($_GET['type'], $type)) {
            try {
                $update = $bdd->prepare("UPDATE rh_candidature SET statut=:statut WHERE id=:id");
                $update->bindValue(':id', $_GET['num'], PDO::PARAM_INT);
                $update->bindValue(':statut', $_GET['type']);
                $update->execute();
            } catch (PDOException $exception) {
                var_dump($exception->getMessage());
            }
        }
    }
}
header("Location: ../rh-recrutement-view.php?num=$id");
exit();
