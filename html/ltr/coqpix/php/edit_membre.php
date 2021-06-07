<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if(empty($_POST['perms_ventes'])){
        $perms_ventes = "";
    }else{
        $perms_ventes = $_POST['perms_ventes'];
    }

    if(empty($_POST['perms_achats'])){
        $perms_achats = "";
    }else{
        $perms_achats = $_POST['perms_achats'];
    }

    if(empty($_POST['perms_projets'])){
        $perms_projets = "";
    }else{
        $perms_projets = $_POST['perms_projets'];
    }

    if(empty($_POST['perms_inventaires'])){
        $perms_inventaires = "";
    }else{
        $perms_inventaires = $_POST['perms_inventaires'];
    }

    $pdo = $bdd->prepare('UPDATE membres SET  nom=:nom, prenom=:prenom, pays=:pays, langue=:langue, tel=:tel, email=:email, dtenaissance=:dtenaissance, name_entreprise=:name_entreprise, role_membres=:role_membres, perms_ventes=:perms_ventes, perms_achats=:perms_achats, perms_projets=:perms_projets, perms_inventaires=:perms_inventaires WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':nom', $_POST['nom']);
    $pdo->bindValue(':prenom', $_POST['prenom']);
    $pdo->bindValue(':pays', $_POST['pays']);
    $pdo->bindValue(':langue', $_POST['langue']);
    $pdo->bindValue(':tel', $_POST['tel']);
    $pdo->bindValue(':email', $_POST['email']);
    $pdo->bindValue(':dtenaissance', $_POST['dtenaissance']);
    $pdo->bindValue(':name_entreprise', $_POST['name_entreprise']);
    $pdo->bindValue(':role_membres', $_POST['role_membres']);
    $pdo->bindValue(':perms_ventes', $perms_ventes);
    $pdo->bindValue(':perms_achats', $perms_achats);
    $pdo->bindValue(':perms_projets', $perms_projets);
    $pdo->bindValue(':perms_inventaires', $perms_inventaires);
    
    $pdo->execute();
        
        sleep(2);
        header('Location: ../membres-liste.php');
        
    

?>
