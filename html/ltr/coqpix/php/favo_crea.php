<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT favorite_crea FROM crea_societe WHERE id=:num');   
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();  
    $crea = $pdoSta->fetch();

    if($crea['favorite_crea'] == ""){

        $update = $bdd->prepare('UPDATE crea_societe SET favorite_crea = ? WHERE id = ?');
        $update->execute(array(
        htmlspecialchars("1"),
        htmlspecialchars($_GET['num'])
    ));
        
    }

    if($crea['favorite_crea'] == "1"){

        $update = $bdd->prepare('UPDATE crea_societe SET favorite_crea = ? WHERE id = ?');
        $update->execute(array(
        htmlspecialchars(""),
        htmlspecialchars($_GET['num'])
    ));
        
    }

    header('Location: ../creation-list.php');
    exit();
?>