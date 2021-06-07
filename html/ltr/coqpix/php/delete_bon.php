<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        //delete des articles pas définie

        $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros= ""');
        $pdoDel->execute();

        $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros=:num AND id_session =:id_session AND typ="bonvente"');
        $pdoDel->bindValue(':num', $_GET['numbon']);
        $pdoDel->bindValue(':id_session', $_SESSION['id_session']); //$_SESSION
        $pdoDel->execute();

        $pdoDe = $bdd->prepare('DELETE FROM bon WHERE id=:id AND id_session=:id_session');
        $pdoDe->bindValue(':id', $_GET['id']);
        $pdoDe->bindValue(':id_session',$_SESSION['id_session']); //$_SESSION
        $pdoDe->execute();

        sleep(1);
        header('Location: ../app-bon-list.php');
        exit();
    
?>