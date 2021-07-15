<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// On verifie l'existance des parametres
if (isset($_POST['refuse']) and isset($_POST['idcandidat']) and isset($_POST['observations'])) {
    if ($_POST['refuse'] == "refuse") {
        // On verifie si les parametres sont non vides
        // Si oui, on retourne un message d'erreur
        if(!empty($_POST['observations'])){
            $observations = htmlspecialchars($_POST['observations']);
        }
        else{
            $response_array['status'] = 'error';
            $response_array['message'] = "Merci de mettre une observation";
            echo json_encode($response_array);
            exit();
        }
        // On met a jour la table rh_candidature avec le nouveau statut et les observations
        try {
            $update = $bdd->prepare("UPDATE rh_candidature SET statut=:statut, observations=:observations WHERE id=:id");
            $update->bindValue(':id', htmlspecialchars($_POST['idcandidat']), PDO::PARAM_INT);
            $update->bindValue(':statut', "Refusé après entretien", PDO::PARAM_STR);
            $update->bindValue(':observations', $observations, PDO::PARAM_STR);
            $update->execute();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e -> getMessage();
            echo json_encode($response_array);
            exit();
        }
    }
}
// On retourne un code de success
$response_array['status'] = 'success';
$response_array['link'] = 'rh-entretient-candidats.php';
echo json_encode($response_array);
exit();