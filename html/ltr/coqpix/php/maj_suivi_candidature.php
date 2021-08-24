<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

$id = $_SESSION['candidat'];

if($_SESSION['candidat'] == $_POST['num']){
    if (isset($_POST['suivi']) and isset($_POST['type_suivi'])) {
        $type_suivi = array("suivi_tel", "suivi_mail", "suivi_test_specif", "suivi_entretien");
        $suivi = array("oui", "non");
        if (in_array($_POST['type_suivi'], $type_suivi) and in_array($_POST['suivi'], $suivi)) {
            if($_POST['suivi'] == "oui"){
                $query = "UPDATE rh_candidature SET " .$_POST['type_suivi']. "='oui' WHERE id=:id";
            }
            else{
                $query = "UPDATE rh_candidature SET " .$_POST['type_suivi']. "='non' WHERE id=:id";
            }
            try {
                $update = $bdd->prepare($query);
                $update->bindValue(':id', htmlspecialchars($_POST['num']), PDO::PARAM_INT);
                $update->execute();
            } catch (PDOException $exception) {
                var_dump($exception->getMessage());
            }
        }
    }
}
exit();
