<?php

require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (isset($_FILES['photo_team']) and !empty($_FILES['photo_team']['name'])) {

    if ($_FILES['photo_team']['error'] > 0) {

        echo "Une erreur est survenue lors du téléchargement de l'image";
        die();
    }

    // On recupère le chemin
    $dossier = '../../../../src/img/';
    $fichier = basename($_FILES['photo_team']['name']);
    $real_name = substr($fichier, 0, -4);
    $file_type = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
    $final_path = $dossier . $real_name . "." . $file_type;
    $resultat = $real_name . "." . $file_type;
    if (move_uploaded_file($_FILES['photo_team']['tmp_name'], $final_path)) //Si la fonction renvoie FALSE, c'est que ça n'a pas fonctionné...
    {
        $pdo = $bdd->prepare('UPDATE teams SET name_team=:name_team , tags_name=:tags_name , email_team=:email_team , tel_team=:tel_team, photo_team=:photo_team  WHERE id=:num LIMIT 1');
        $pdo->bindValue(':name_team', htmlspecialchars($_POST['name_team']));
        $pdo->bindValue(':tags_name', htmlspecialchars($_POST['tags_name']));
        $pdo->bindValue(':email_team', htmlspecialchars($_POST['email_team']));
        $pdo->bindValue(':tel_team', htmlspecialchars($_POST['tel_team']));
        $pdo->bindValue(':photo_team', htmlspecialchars($resultat));
        $pdo->bindValue(':num', $_GET['num']);

        $pdo->execute();
    }
} else {
    $pdo = $bdd->prepare('UPDATE teams SET name_team=:name_team , tags_name=:tags_name , email_team=:email_team , tel_team=:tel_team  WHERE id=:num LIMIT 1');
    $pdo->bindValue(':name_team', $_POST['name_team']);
    $pdo->bindValue(':tags_name', $_POST['tags_name']);
    $pdo->bindValue(':email_team', $_POST['email_team']);
    $pdo->bindValue(':tel_team', $_POST['tel_team']);
    $pdo->bindValue(':num', $_GET['num']);

    $pdo->execute();
}

sleep(1);
header('Location: ../teams-view.php?num=' . $_GET['num'] . '');
