<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE teams SET name_team=:name_team , tags_name=:tags_name , email_team=:email_team , tel_team=:tel_team  WHERE id=:num LIMIT 1');
    $pdo->bindValue(':name_team', $_POST['name_team']);
    $pdo->bindValue(':tags_name', $_POST['tags_name']);
    $pdo->bindValue(':email_team', $_POST['email_team']);
    $pdo->bindValue(':tel_team', $_POST['tel_team']);
    $pdo->bindValue(':num', $_GET['num']);
    
    $pdo->execute();
        
    sleep(1);
    header('Location: ../teams-view.php?num='.$_GET['num'].'');
        
    

?>
