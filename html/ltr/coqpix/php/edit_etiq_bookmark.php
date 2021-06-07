<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE etiquette_bookmark SET name_etiq=:name_etiq, color_etiq=:color_etiq WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':name_etiq', $_POST['name_etiq']);
    $pdo->bindValue(':color_etiq', $_POST['color_etiq']);
    $pdo->execute();

    $pdd = $bdd->prepare('SELECT * FROM etiquette_bookmark');
    $pdd->execute();
    var_dump($pdd);
        sleep(2);
        header('Location: ../bookmark.php');
        
    

?>
