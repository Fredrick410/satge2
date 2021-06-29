<?php
require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    function passgen1($nbChar) {
        $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
        srand((double)microtime()*1000000);
        $pass = '';
        for($i=0; $i<$nbChar; $i++){
            $pass .= $chaine[rand()%strlen($chaine)];
    }
    return $pass;
    }

    function passgen2($nbChar){
        return substr(str_shuffle(
        'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789("$^^ù!:;,'),1, $nbChar); 
    }

    $name_annonce = $_POST['name_annonce'];
    $description_annonce = $_POST['description_annonce'];
    $img_annonce = "";
    $code_annonce = $_POST['code_annonce'];
    $email_annonce = $_POST['email_annonce'];
    $tel_annonce = $_POST['tel_annonce'];
    $age_annonce = $_POST['age_annonce'];
    $poste_annonce = $_POST['poste_annonce'];
    $niveau_annonce = $_POST['niveau_annonce'];
    $pays_annonce = $_POST['pays_annonce'];
    $qcms = $_POST['qcms'];

    if($_POST['date_y'] == "0"){
        $date_y = "";
    }else{
        $date_y = ''.$_POST['date_y'].' ans,';
    }

    if($_POST['date_m'] == ""){
        $date_m = "";
    }else{
        $date_m = ''.$_POST['date_m'].' mois,';
    }

    if($_POST['date_d'] == "0"){
        $date_d = "";
    }else{
        $date_d = ''.$_POST['date_d'].' jours';
    }

    $temps_annonce = ''.$date_y.''.$date_m.''.$date_d.'';

    if(!empty($_POST['qcms'])){
        $qcms = $_POST['qcms'];
    }

    $color_annonce = $_POST['color_annonce'];
    $statut = "actif";

    $insert = $bdd->prepare('INSERT INTO rh_annonce (name_annonce, description_annonce, img_annonce, code_annonce, email_annonce, tel_annonce, age, poste, niveau, pays, temps, link, color_annonce, statut, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_annonce),
        htmlspecialchars($description_annonce),
        htmlspecialchars($img_annonce),
        htmlspecialchars($code_annonce),
        htmlspecialchars($email_annonce),
        htmlspecialchars($tel_annonce),
        htmlspecialchars($age_annonce),
        htmlspecialchars($poste_annonce),
        htmlspecialchars($niveau_annonce),
        htmlspecialchars($pays_annonce),
        htmlspecialchars($temps_annonce),
        htmlspecialchars($link_annonce),
        htmlspecialchars($color_annonce),
        htmlspecialchars($statut),
        htmlspecialchars($_SESSION['id_session'])
    ));

    $id_annonce = $bdd->lastInsertId();

    foreach ($qcms as $key => $value) {
        $insert = $bdd->prepare('INSERT INTO rh_annonce_qcm VALUES(?,?)');
        $insert->execute(array(
            htmlspecialchars($id_annonce),
            htmlspecialchars($value)
        ));
    }

    $link_annonce = "num=".$id_annonce;

    $pdo = $bdd->prepare('UPDATE rh_annonce SET link=:link WHERE id=:id LIMIT 1');
    $pdo->bindValue(':link', $link_annonce);
    $pdo->bindValue(':id', $id_annonce);
    $pdo->execute();

    header('Location: ../rh-recrutement.php');



?>