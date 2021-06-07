<?php 
require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_search = $_POST['name_search'];
    $url_search = $_POST['url_search'];
    $description_search = $_POST['description_search'];
    $date_search = date('d/m/Y');
    $etiquette_search = $_POST['etiquette_search'];
    $favorite_search = "no";
    $statut_search = "En cours";
    $img_search = "lightgallry/01.jpg";
    $id_session = $_SESSION['id_session'];

    $insert = $bdd->prepare('INSERT INTO bookmark (name_search, url_search, description_search, date_search, etiquette_search, favorite_search, statut_search, img_search, id_session) VALUES(?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_search),
        htmlspecialchars($url_search),
        htmlspecialchars($description_search),
        htmlspecialchars($date_search),
        htmlspecialchars($etiquette_search),
        htmlspecialchars($favorite_search),
        htmlspecialchars($statut_search),
        htmlspecialchars($img_search),
        htmlspecialchars($id_session)
    ));

    header('Location: ../bookmark.php');
    exit();

?>