<?php
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        if ($_GET['for'] == "first"){

            $pdo = $bdd->prepare('UPDATE portefeuille SET name_entreprise=:name_entreprise, nom_diri=:nom_diri, prenom_diri=:prenom_diri, tel_diri=:tel_diri, email_diri=:email_diri  WHERE id = :num LIMIT 1');
            $pdo->bindValue(':name_entreprise', $_POST['name_entreprise']);
            $pdo->bindValue(':nom_diri', $_POST['nom_diri']);
            $pdo->bindValue(':prenom_diri', $_POST['prenom_diri']);
            $pdo->bindValue(':tel_diri', $_POST['tel_diri']);
            $pdo->bindValue(':email_diri', $_POST['email_diri']);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../portefeuille-view.php?num='.$_GET['num'].'');
            die();

        }

        if($_GET['for'] == "second"){

            $pdo = $bdd->prepare('UPDATE portefeuille SET estimation=:estimation, prix=:prix WHERE id = :num LIMIT 1');
            $pdo->bindValue(':estimation', $_POST['estimation']);
            $pdo->bindValue(':prix', $_POST['prix']);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../portefeuille-view.php?num='.$_GET['num'].'');
            die();

        }
        
    

?>