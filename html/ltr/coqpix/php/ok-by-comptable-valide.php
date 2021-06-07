<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT send_files FROM stockage_admin WHERE id=:num');   
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();  
    $stock = $pdoSta->fetch();

    if($stock['send_files'] == "nonvalide"){

        $updat = $bdd->prepare('UPDATE stockage_admin SET send_files = ?, num_saisie = ? WHERE id = ?');
        $updat->execute(array(
        htmlspecialchars("valide"),
        htmlspecialchars($_GET['num_saisie']),
        htmlspecialchars($_GET['num'])
    ));
        
    }

    if($stock['send_files'] == "valide"){

        $update = $bdd->prepare('UPDATE stockage_admin SET send_files = ?, num_saisie = ? WHERE id = ?');
        $update->execute(array(
        htmlspecialchars("nonvalide"),
        htmlspecialchars(""),
        htmlspecialchars($_GET['num'])
    ));
        
    }
    
    header('Location: ../cloudpix-valide.php');
?>
