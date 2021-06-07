<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if(!empty($_GET['name_files'])){

    $pdoSta = $bdd->prepare('SELECT recent FROM flash WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSta->execute();
    $recentt = $pdoSta->fetch();

    if($recentt['recent'] == "0"){
        $updat = $bdd->prepare('UPDATE flash SET recent = ? WHERE id = ?');
        $updat->execute(array(
        htmlspecialchars("1"),
        htmlspecialchars($_SESSION['id_session'])
    ));
    $recent = "1";
    }

    if($recentt['recent'] == "1"){
        $upda = $bdd->prepare('UPDATE flash SET recent = ? WHERE id = ?');
        $upda->execute(array(
        htmlspecialchars("2"),
        htmlspecialchars($_SESSION['id_session'])
    ));
    $recent = "2";
    }

    if($recentt['recent'] == "2"){
        $upd = $bdd->prepare('UPDATE flash SET recent = ? WHERE id = ?');
        $upd->execute(array(
        htmlspecialchars("3"),
        htmlspecialchars($_SESSION['id_session'])
    ));
    $recent = "3";
    }

    if($recentt['recent'] == "3"){
        $up = $bdd->prepare('UPDATE flash SET recent = ? WHERE id = ?');
        $up->execute(array(
        htmlspecialchars("4"),
        htmlspecialchars($_SESSION['id_session'])
    ));
    $recent = "4";
    }

    if($recentt['recent'] == "4"){

        $u1 = $bdd->prepare('UPDATE stockage_admin SET recent = "0" WHERE recent = "4"');
        $u1->execute();

        $u1 = $bdd->prepare('UPDATE stockage_admin SET recent = "4" WHERE recent = "3"');
        $u1->execute();


        $u1 = $bdd->prepare('UPDATE stockage_admin SET recent = "3" WHERE recent = "2"');
        $u1->execute();


        $u1 = $bdd->prepare('UPDATE stockage_admin SET recent = "2" WHERE recent = "1"');
        $u1->execute();

    $recent = "1";
    }


    if($_GET['type_files_note'] == "note"){
        $typ_note = "note";
    }else{
        $typ_note = "";
    }

    if($_GET['type_files_avoir'] == "avoir"){
        $typ_avoir = "avoir";
    }else{
        $typ_avoir = "";
    }

    if($_GET['type_files_fac_achat'] == "fac_achat"){
        $typ_achat = "fac_achat";
    }else{
        $typ_achat = "";
    }

    if($_GET['type_files_fac_ventes'] == "fac_ventes"){
        $typ_ventes = "fac_ventes";
    }else{
        $typ_ventes = "";
    }

    if($_GET['type_files_caisse_ventes'] == "cas_ventes"){
        $typ_caisse = "cas_ventes";
    }else{
        $typ_caisse = "";
    }

    if($_GET['banque'] == "banque"){
        $typ_banque = "banque";
    }else{
        $typ_banque = "";
    }

    $insert = $bdd->prepare('INSERT INTO stockage_admin (name_entreprise, name_files, size_files, dte_files, dte_j, dte_m, dte_a, num_saisie, img_files, type_files_note, type_files_avoir, type_files_fac_achat, type_files_fac_ventes, type_files_caisse_ventes, banque, send_files, recent, favo, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
        ($_GET['name_entreprise']),
        ($_GET['name_files']),
        ($_GET['size_files']),
        ($_GET['dte_files']),
        ($_GET['dte_j']),
        ($_GET['dte_m']),
        ($_GET['dte_a']),
        ("pas de numeros"),
        ($_GET['img_files']),
        ($typ_note),
        ($typ_avoir),
        ($typ_achat),
        ($typ_ventes),
        ($typ_caisse),
        ($typ_banque),
        ("nonvalide"),
        ($recent),
        (""),
        ($_SESSION['id_session'])
    ));

    $update = $bdd->prepare('UPDATE stockage SET  send_files = ? WHERE id = ?');
    $update->execute(array(
        htmlspecialchars("#03f322"),
        htmlspecialchars($_GET['id'])
    ));

    if($_GET['type_files_note'] == "note"){
        $cal_note = "1";
        $size_note = $_GET['size_files'];
    }else{
        $cal_note = "0";
        $size_note = "0";
    }

    if($_GET['type_files_avoir'] == "avoir"){
        $cal_avoir = "1";
        $size_avoir = $_GET['size_files'];
    }else{
        $cal_avoir = "0";
        $size_avoir = "0";
    }

    if($_GET['type_files_fac_achat'] == "fac_achat"){
        $cal_fac_achat = "1";
        $size_fac_achat = $_GET['size_files'];
    }else{
        $cal_fac_achat = "0";
        $size_fac_achat = "0";
    }

    if($_GET['type_files_fac_ventes'] == "fac_ventes"){
        $cal_fac_ventes = "1";
        $size_fac_ventes = $_GET['size_files'];
    }else{
        $cal_fac_ventes = "0";
        $size_fac_ventes = "0";
    }

    if($_GET['type_files_caisse_ventes'] == "cas_ventes"){
        $cal_caisse = "1";
        $size_caisse = $_GET['size_files'];
    }else{
        $cal_caisse = "0";
        $size_caisse = "0";
    }

    if($_GET['banque'] == "banque"){
        $cal_banque = "1";
        $size_banque = $_GET['size_files'];
    }else{
        $cal_banque = "0";
        $size_banque = "0";
    }




    $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id=:num');
    $pdoS->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoS->execute();
    $calculs = $pdoS->fetch();

    $updateEE = $bdd->prepare('UPDATE calculs SET nb_facture_achats = ?, nb_facture_ventes = ?, nb_note = ?, nb_avoir = ?, nb_caisse = ?, nb_banque = ?');
    $updateEE->execute(array(
        htmlspecialchars($calculs['nb_facture_achats'] + $cal_fac_achat),
        htmlspecialchars($calculs['nb_facture_ventes'] + $cal_fac_ventes),
        htmlspecialchars($calculs['nb_note'] + $cal_note),
        htmlspecialchars($calculs['nb_avoir'] + $cal_avoir),
        htmlspecialchars($calculs['nb_caisse'] + $cal_caisse),
        htmlspecialchars($calculs['nb_banque'] + $cal_banque)
    ));

    $updateaa = $bdd->prepare('UPDATE calculs SET size_achats = ?, size_ventes = ?, size_note = ?, size_avoir = ?, size_caisse = ?, size_banque = ?');
    $updateaa->execute(array(
        htmlspecialchars($calculs['size_achats'] + $size_fac_achat),
        htmlspecialchars($calculs['size_ventes'] + $size_fac_ventes),
        htmlspecialchars($calculs['size_note'] + $size_note),
        htmlspecialchars($calculs['size_avoir'] + $size_avoir),
        htmlspecialchars($calculs['size_caisse'] + $size_caisse),
        htmlspecialchars($calculs['size_banque'] + $size_banque)
    ));

    header('Location: ../loading/loading.html');
}else{
    echo "Il n'y a pas de document ...";
}    
?>
