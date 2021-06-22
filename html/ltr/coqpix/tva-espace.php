<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/verif_session_connect.php';
require_once 'php/config.php';
   
    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $entreprise = $pdoStat->fetch();

    $periode = explode(";", $entreprise['forme_tva']);

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="01"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $janvier = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="02"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $fevrier = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="03"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $mars = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="04"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $avril = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="05"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $mai = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="06"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $juin = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="07"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $juillet = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="08"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $aout = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="09"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $septembre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="10"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $octobre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="11"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $novembre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="12"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $decembre = $pdoSt->fetchAll();

    //trim

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="01" OR date_m="02" OR date_m="03"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $trim_one = $pdoSt->fetchAll();
    $trim_one_count = count($trim_one);

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="04" OR date_m="05" OR date_m="06"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $trim_two = $pdoSt->fetchAll();
    $trim_two_count = count($trim_two);

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="07" OR date_m="08" OR date_m="09"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $trim_three = $pdoSt->fetchAll();
    $trim_three_count = count($trim_three);

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND date_m="10" OR date_m="11" OR date_m="12"');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $trim_four = $pdoSt->fetchAll();
    $trim_four_count = count($trim_four);

    //annu

    $pdoSt = $bdd->prepare('SELECT * FROM tva WHERE id_session=:num AND periode=:periode');   
    $pdoSt->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT);
    $pdoSt->bindValue(':periode', $periode[0]);
    $pdoSt->execute();  
    $annu = $pdoSt->fetchAll();
    $annu_count = count($annu);

    if($entreprise['forme_tva']){

    }

    if($periode[0] == "mensuel"){
        $mensuel = "";
        $txt_periode = "Mensuelle";
        $trim = "none-validation";
        $annuel = "none-validation";
    }elseif($periode[0] == "trimestriel"){
        $mensuel = "none-validation";
        $txt_periode = "Trimestrielle";
        $trim = "";
        $annuel = "none-validation";
    }
    elseif($periode[0] == "annuel"){
        $mensuel = "none-validation";
        $txt_periode = "Annuelle";
        $trim = "none-validation";
        $annuel = "";
    }

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Déclaration TVA - Coqpix</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/swiper.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">
<style>
    .none-validation{display: none;}
</style>
    <!-- BEGIN: Header-->
    <?php $btnreturn = true;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- coverflow effect swiper start -->
                <section id="component-swiper-coverflow">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Déclaration TVA (Période : <?= $txt_periode ?>)</h4>
                        </div>
                        <div class="card-content <?= $mensuel ?>">
                            <div class="card-body">
                                <div class="swiper-coverflow swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach($janvier as $janvierr): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Janvier</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $janvierr['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $janvierr['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $janvierr['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($fevrier as $fevrierr): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Fevrier</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $fevrierr['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $fevrierr['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $fevrierr['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($mars as $marss): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Mars</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $marss['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $marss['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $marss['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($avril as $avrill): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Avril</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $avrill['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $avrill['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $avrill['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($mai as $maii): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Mai</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $maii['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $maii['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $maii['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($juin as $juinn): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Juin</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $juinn['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $juinn['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $juinn['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($juillet as $juillett): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Juillet</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $juillett['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $juillett['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $juillett['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($aout as $aoutt): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Aout</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $aoutt['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $aoutt['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $aoutt['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($septembre as $septembree): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Septembre</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $septembree['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $septembree['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $septembree['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($octobre as $octobree): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Octobre</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $octobree['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $octobree['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $octobree['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($novembre as $novembree): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Novembre</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $novembree['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $novembree['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $novembree['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach($decembre as $decembree): ?>
                                            <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                                <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Décembre</h4>
                                                <div class="form-group">
                                                    <hr>
                                                </div>
                                                <div class="form-group text-center" style="padding-left: 5px;">
                                                    <label>Vos documents :</label>
                                                </div>
                                                <div class="form-group" style="padding-left: 5px;">
                                                    <p><?= $decembree['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $decembree['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $decembree['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content <?= $trim ?>">
                            <div class="card-body">
                                <div class="swiper-coverflow swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide <?php if($trim_one_count <= 0){echo 'none-validation';} ?> " style="background-color: rgba(187, 233, 255, .4);"> 
                                            <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Trimestre N°1</h4>
                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <div class="form-group text-center" style="padding-left: 5px;">
                                                <label>Vos documents :</label>
                                            </div>
                                            <div class="form-group" style="padding-left: 5px;">
                                                <?php foreach($trim_one as $trime_one): ?>
                                                    <p><?= $trime_one['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $trime_one['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $trime_one['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                             </div>
                                        </div>
                                        <div class="swiper-slide <?php if($trim_two_count <= 0){echo 'none-validation';} ?> " style="background-color: rgba(187, 233, 255, .4);"> 
                                            <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Trimestre N°2</h4>
                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <div class="form-group text-center" style="padding-left: 5px;">
                                                <label>Vos documents :</label>
                                            </div>
                                            <div class="form-group" style="padding-left: 5px;">
                                                <?php foreach($trim_two as $trime_two): ?>
                                                    <p><?= $trime_two['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $trime_two['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $trime_two['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                             </div>
                                        </div>
                                        <div class="swiper-slide <?php if($trim_three_count <= 0){echo 'none-validation';} ?> " style="background-color: rgba(187, 233, 255, .4);"> 
                                            <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Trimestre N°3</h4>
                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <div class="form-group text-center" style="padding-left: 5px;">
                                                <label>Vos documents :</label>
                                            </div>
                                            <div class="form-group" style="padding-left: 5px;">
                                                <?php foreach($trim_three as $trime_three): ?>
                                                    <p><?= $trime_three['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $trime_three['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $trime_three['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                             </div>
                                        </div>
                                        <div class="swiper-slide <?php if($trim_four_count <= 0){echo 'none-validation';} ?> " style="background-color: rgba(187, 233, 255, .4);"> 
                                            <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Trimestre N°4</h4>
                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <div class="form-group text-center" style="padding-left: 5px;">
                                                <label>Vos documents :</label>
                                            </div>
                                            <div class="form-group" style="padding-left: 5px;">
                                                <?php foreach($trim_four as $trime_four): ?>
                                                    <p><?= $trime_four['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $trime_four['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $trime_four['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                             </div>
                                        </div>
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content <?= $annuel ?>">
                            <div class="card-body">
                                <div class="swiper-coverflow swiper-container <?php if($annu_count <= 0){echo "none-validation";} ?>">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                            <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Déclaration de <?= date('Y')-1 ?></h4>
                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <div class="form-group text-center" style="padding-left: 5px;">
                                                <label>Vos documents :</label>
                                            </div>
                                            <div class="form-group" style="padding-left: 5px;">
                                                <p><?= $annu['files_tva'] ?> &nbsp&nbsp<a href="../../../src/tva/<?= $annu['files_tva'] ?>" target="_blank"><i class='bx bx-show-alt' style="position: relative; top: 3px; cursor: pointer;"></i></a>&nbsp<a href="../../../src/tva/<?= $annu['files_tva'] ?>" download><i class='bx bxs-download' style="position: relative; top: 3px;"></i></a></p>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                                <div class="swiper-coverflow swiper-container <?php if($annu_count <= 0){}else{echo "none-validation";} ?>">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" style="background-color: rgba(187, 233, 255, .4);"> 
                                            <h4 class="text-center" style="padding-left: 5px; padding-top: 5px;">Déclaration de <?= date('Y')-1 ?></h4>
                                            <div class="form-group">
                                                <hr>
                                            </div>
                                            <div class="form-group text-center" style="padding-left: 5px;">
                                                <label>Vos documents :</label>
                                            </div>
                                            <div class="form-group" style="padding-left: 5px;">
                                                <p>Aucune déclaration</p>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- coverflow effect swiper ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/extensions/swiper.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>