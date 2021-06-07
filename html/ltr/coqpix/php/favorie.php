<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT favo FROM stockage_admin WHERE id=:num');   
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();  
    $stock = $pdoSta->fetch();

    if($stock['favo'] == ""){

        $update = $bdd->prepare('UPDATE stockage_admin SET favo = ? WHERE id = ?');
        $update->execute(array(
        htmlspecialchars("favorie"),
        htmlspecialchars($_GET['num'])
    ));
        
    }

    if($stock['favo'] == "favorie"){

        $update = $bdd->prepare('UPDATE stockage_admin SET favo = ? WHERE id = ?');
        $update->execute(array(
        htmlspecialchars(""),
        htmlspecialchars($_GET['num'])
    ));
        
    }

    header('Location: ../cloudpix.php');
    exit();
?>
