<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

if (isset($_FILES['fichier']) and isset($_POST['id_task'])) {
    try {
        $date = date("d/m,H:i-s");
        $date_jm = explode(",", $date)[0];
        $date_hmin = explode("-", explode(",", $date)[1])[0];
        $date_h = explode(":", $date_hmin)[0] + 1;
        if ($_FILES['fichier']['error'] > 0) {
            echo "Une erreur est survenue lors du téléchargement du fichier";
            die();
        }

        if (empty($_POST['id_task'])) {
            echo "Tache non sélectionnée";
            die();
        }
        else{
            $id_task = htmlspecialchars($_POST['id_task']);
        }

        $target_file = $_FILES['fichier']['name'];
        $real_name = pathinfo($target_file, PATHINFO_FILENAME);
        $type_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $tmpName = $_FILES['fichier']['tmp_name']; 

        $date_now = '-' . str_replace(":", "-", explode(",", $date)[1]) . '';
        $file_name = $real_name . $date_now . "." . $type_file;
                                    //chemin du document
        $path = "../../../../src/task/document/" . $file_name;                     // chemin vers le serveur

        $resultat = move_uploaded_file($tmpName, $path);

        if($resultat){
            $pdo = $bdd->prepare('INSERT INTO task_doc(namedoc_task, date_jm, date_hmin, task_num, id_session) VALUES(?,?,?,?,?)');
            $pdo->execute(array(
                $file_name,
                $date_jm,
                $date_hmin,
                $id_task,
                $_SESSION['id_session']
            ));
        }
    } catch (PDOException $e) {
        echo $e->GetMessage();
        exit();
    }
    exit();
}
