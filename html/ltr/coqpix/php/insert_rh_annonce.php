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

    $score = "0";
    if(!empty($_POST['qcmanglais'])){
        if($_POST['qcmanglais'] == "on"){
            if($score == "0"){
                $result = "anglais";
                $score = "1";
            }else{
                $result = ''.$result.',anglais';
            }
        }
    }
    if(!empty($_POST['qcmconfiance'])){
        if($_POST['qcmconfiance'] == "on"){
            if($score == "0"){
                $result = "confiance";
                $score = "1";
            }else{
                $result = ''.$result.',confiance';
            }
        }
    }
    if(!empty($_POST['qcmintelligence'])){
        if($_POST['qcmintelligence'] == "on"){
            if($score == "0"){
                $result = "intelligence";
                $score = "1";
            }else{
                $result = ''.$result.',intelligence';
            }
        }
    }
    if(!empty($_POST['qcmpsy'])){
        if($_POST['qcmpsy'] == "on"){
            if($score == "0"){
                $result = "psy";
                $score = "1";
            }else{
                $result = ''.$result.',psy';
            }
        }
    }
    if(!empty($_POST['qcmphy'])){
        if($_POST['qcmphy'] == "on"){
            if($score == "0"){
                $result = "phy";
                $score = "1";
            }else{
                $result = ''.$result.',phy';
            }
        }
    }

    if(empty($_POST['qcmanglais']) && empty($_POST['qcmconfiance']) && empty($_POST['qcmintelligence']) && empty($_POST['qcmpsy']) && empty($_POST['qcmphy'])){
        $result = "";
    }

    $qcm_annonce = $result;
    $link_one = passgen1(25);
    $link_two = passgen2(25);
    $link_annonce = "";
    $color_annonce = $_POST['color_annonce'];
    $statut = "actif";

    $insert = $bdd->prepare('INSERT INTO rh_annonce (name_annonce, description_annonce, img_annonce, code_annonce, email_annonce, tel_annonce, age, poste, niveau, pays, temps, qcm, link, color_annonce, statut, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
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
        htmlspecialchars($qcm_annonce),
        htmlspecialchars($link_annonce),
        htmlspecialchars($color_annonce),
        htmlspecialchars($statut),
        htmlspecialchars($_SESSION['id_session'])
    ));

    $pdoStat = $bdd->prepare('SELECT * FROM rh_annonce WHERE name_annonce=:name_annonce AND description_annonce=:description_annonce AND temps=:temps AND email_annonce=:email_annonce AND id_session=:id_session');
    $pdoStat->bindValue(':name_annonce', $name_annonce);
    $pdoStat->bindValue(':description_annonce', $description_annonce);
    $pdoStat->bindValue(':temps', $temps_annonce);
    $pdoStat->bindValue(':email_annonce', $email_annonce);
    $pdoStat->bindValue(':id_session', $_SESSION['id_session']);
    $pdoStat->execute();
    $annonce = $pdoStat->fetch();

    $str = $annonce['name_annonce'];
    $replaced = preg_replace("/\s+/", "", $str);

    // $link_annonce_update = ''.$link_one.'&annonce='.$replaced.'&num='.$annonce['id'].'&'.$link_two.'';
    $link_annonce_update = "zeaeazeaze";

    $pdo = $bdd->prepare('UPDATE rh_annonce SET link=:link WHERE id=:id LIMIT 1');
    $pdo->bindValue(':link', $link_annonce_update);
    $pdo->bindValue(':id', $annonce['id']);
    $pdo->execute();

    header('Location: ../rh-recrutement.php');



?>