
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

if (isset($_POST['name_task']) and !empty($_POST['name_task'])) {
    $name_task = htmlspecialchars($_POST['name_task']);
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = "Nom de tâche vide";
    echo json_encode($response_array);
    exit();
}
if (isset($_POST['id_mission']) and !empty($_POST['id_mission'])) {
    $id_mission = htmlspecialchars($_POST['id_mission']);
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = "Mission inexistante";
    echo json_encode($response_array);
    exit();
}
$date_task = date('Y-m-d');
$dateecheance_task = date('Y-m-d');
$status_task = "En attente";
$favorite = "Non";
$assignation_task = "";
$description_task = "";
$etiquette_task = "";
$color_etiq = "";
$date_crea = date('Y-m-d');
$commentaire_task = "";
$lastcommentaire_task = "";
$id_session = $_SESSION['id_session'];

try {
    $insert = $bdd->prepare('INSERT INTO task (name_task, date_task, dateecheance_task, status_task, favorite, assignation_task, description_task, etiquette_task, color_etiq, date_crea, commentaire_task, lastcommentaire_task, id_mission, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        ($name_task),
        ($date_task),
        ($dateecheance_task),
        ($status_task),
        ($favorite),
        ($assignation_task),
        ($description_task),
        ($etiquette_task),
        ($color_etiq),
        ($date_crea),
        ($commentaire_task),
        ($lastcommentaire_task),
        ($id_mission),
        ($id_session)
    ));
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();

?>