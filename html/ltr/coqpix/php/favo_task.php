<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';
    
    $pdoSta = $bdd->prepare('SELECT favorite FROM task WHERE id=:num');   
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();  
    $stock = $pdoSta->fetch();

    if($stock['favorite'] == "1"){

        $update = $bdd->prepare('UPDATE task SET favorite = ? WHERE id = ?');
        $update->execute(array(
        htmlspecialchars("0"),
        htmlspecialchars($_GET['num'])
    ));
        
    }

    if($stock['favorite'] == "0"){

        $update = $bdd->prepare('UPDATE task SET favorite = ? WHERE id = ?');
        $update->execute(array(
        htmlspecialchars("1"),
        htmlspecialchars($_GET['num'])
    ));
        
    }

    header('Location: ../task.php');
    exit();
?>
