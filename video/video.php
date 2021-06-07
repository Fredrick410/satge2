<?php
require_once '../html/ltr/coqpix/php/config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
session_start();

        $pdo = $bdd->prepare('SELECT * FROM entreprise WHERE id =:num');
        $pdo->bindValue(':num', $_SESSION['id_session']);
        $pdo->execute();
        $entreprise = $pdo->fetch();

        $numerosentreprirse = $entreprise['id'];

        $pdo = $bdd->prepare('UPDATE entreprise SET color=:color, new_user="Désactivé" WHERE id=:num');  
        $pdo->bindValue(':num', $numerosentreprirse);
		$pdo->bindValue(':color', "badge badge-light-warning badge-pill");
        $pdo->execute();


?>
<!DOCTYPE html>
<html class="loading" lang="fr">

<head>
    <title>Coqpix</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>    
    <header>
        <video class="video" autoplay no-repeat poster="">
            <source src="video.mp4" type="video/mp4">
        </video>
    </header>

<script language="javascript" type="text/javascript">
    window.setTimeout('window.location="../html/ltr/coqpix/auth-update-first.php"; ',83000);
</script>
</body>

</html>