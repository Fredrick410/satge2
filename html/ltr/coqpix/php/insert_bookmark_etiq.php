<?php 
require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_etiq = $_POST['name_etiq'];
    $color_etiq = $_POST['color_etiq'];
    $id_session = $_SESSION['id_session'];

    $insert = $bdd->prepare('INSERT INTO etiquette_bookmark (name_etiq , color_etiq, id_session) VALUES(?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_etiq),
        htmlspecialchars($color_etiq),
        htmlspecialchars($id_session)
    ));

    header('Location: ../bookmark.php');
    exit();

?>