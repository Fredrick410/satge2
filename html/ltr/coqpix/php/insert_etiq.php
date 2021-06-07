<?php 

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $color = $_POST['color'];
    if($_POST['color'] == ""){
        $color = "#ffffff";
    }

    $insert = $bdd->prepare('INSERT INTO etiquette (name_etiq, color, id_session) VALUES(?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['name_etiq']),
        htmlspecialchars($color),
        htmlspecialchars($_SESSION['id_session'])
    ));

    header('Location: ../task.php');

?>