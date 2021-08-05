<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if($_GET['valid']=="true"){
$pdo = $bdd->prepare('UPDATE crea_societe SET depo_domi=:depo_domi WHERE id=:num LIMIT 1');
$pdo->bindValue(':num', $_GET['id']);
$pdo->bindValue(':depo_domi', $_POST['depo_domi']);   
$pdo->execute();

header("Location: ../creation-list-domiciliation.php?id=".$_GET['id']."");
exit();
}
if($_GET['valid']=="false"){
    $pdoS = $bdd->prepare('UPDATE crea_societe SET depo_domi=:depo_domi WHERE id=:num LIMIT 1');
    $pdoS->bindValue(':num', $_GET['id']);
    $pdoS->bindValue(':depo_domi', "");   
    $pdoS->execute();
    
    header("Location: ../creation-list-domiciliation.php?id=".$_GET['id']."");
    exit();
    }
?>
