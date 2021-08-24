<?php

require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// On vérifie que le formulaire à été complété et si les champs ne sont pas vides

//On met le résultat pseudo du formulaire dans $pseudo
$pseudo = htmlspecialchars($_GET["emailentreprise"]);
$pass = htmlspecialchars($_GET["passwordentreprise"]);
$pass_hash = crypt($pass, '5c725a26307c3b5170634a7e2b');

//On sélectionne dans la table 'utilisateurs' les pseudo qui sont les mêmes que le pseudo tapé dans le formulaire

$query = $bdd->prepare("SELECT id, count(*) AS nb FROM membres WHERE email = :pseudo AND password_membre = :pass");
$query->bindValue(':pseudo', $pseudo);
$query->bindValue(':pass', $pass_hash);
$query->execute();
$membre = $query->fetch();

if ($membre['nb'] == 1) {

    $id_membre = $membre['id'];

    $query = $bdd->prepare("SELECT status_membres as statut FROM membres WHERE id = :id_membre");
    $query->bindValue(':id_membre', $id_membre);
    $query->execute();
    $statut = $query->fetch()['statut'];

    // $non = "Activé";
    // $oui = "Désactivé";
    // $video = "New";
    // $ban = "Bloqué";
    // $block = "Supprimé";

    if ($statut == "New" || $statut == "Activé") {

        $query = $bdd->prepare("SELECT email, id_session, role_membres FROM membres WHERE id = :id_membre");
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();
        $infos_membre = $query->fetch();

        session_start();
        $_SESSION['email'] = $infos_membre['email'];
        $_SESSION['id'] = $infos_membre['id_session'];
        $_SESSION['id_session'] = $infos_membre['id_session'];
        $_SESSION['id_membre'] = $id_membre;
        $_SESSION['role'] = $infos_membre['role_membres'];

        if ($statut == "New") {

            header('Location: ../../../../video/video.php');
            die();

        } else {

            header('Location:../dashboard-analytics.php');
            die();

        }

    } else {

        header('Location:../page-not-authorized.html');
        die();

    }


    if ($verife['new_user'] == $block) {

      header('Location:../page-not-authorized.html');
      die();
    }

    if ($verife['new_user'] == $ban) {

      header('Location:../page-not-authorized.html');
      die();
    }

} else {

    $query_crea = $bdd->prepare("SELECT * FROM crea_societe WHERE email_crea = :pseudo AND password_crea = :pass_hash");
    $query_crea->bindValue(':pseudo', $pseudo);
    $query_crea->bindValue(':pass_hash', $pass_hash);
    $query_crea->execute();
    $count_crea = $query_crea->rowCount();

    if ($count_crea == "1") {

        $selectid = $bdd->prepare("SELECT id FROM crea_societe WHERE email_crea =:pseudo");
        $selectid->bindValue(':pseudo', $pseudo);
        $selectid->execute();
        $viewid = $selectid->fetch();

        session_start();
        $_SESSION['id_crea'] = $viewid['id'];

        sleep(2);
        header('Location: ../page-creation.php');

    } else {

        header('Location: ../../../../?error=0');
        exit();

    }

}

?>
