<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

    // DEBUT REQUETES CHART BAS DROITE
    $annee_actuelle = date("Y");
    $mois = array('01','02','03','04','05','06','07','08','09','10','11','12');

    for ($i=0 ; $i<5 ; $i++) {

        // Requete SQL permettant de recuperer le taux de prélevement par annee et par mois
        $select_taux_prelevement = $bdd->prepare('SELECT dte_m AS mois, round(count(*) / (SELECT count(*) FROM prelevement) * 100) AS taux_prelevement FROM prelevement WHERE upper(statut) = "PAYE" AND dte_a = :annee GROUP BY dte_m');
        $select_taux_prelevement->execute(array(':annee' => $annee_actuelle - $i));
        ${'array_taux_prelevement_'.($annee_actuelle - $i)} = array();
        while ($result_taux_prelevement = $select_taux_prelevement->fetch()) {
            ${'array_taux_prelevement_'.($annee_actuelle - $i)}[$result_taux_prelevement['mois']] = $result_taux_prelevement['taux_prelevement'];
        }

        for($j=0; $j<12; $j++) {
            if (array_key_exists($mois[$j], ${'array_taux_prelevement_'.($annee_actuelle - $i)})) {
                ${'taux_prelevement_'.$mois[$j].'_'.($annee_actuelle - $i)} = ${'array_taux_prelevement_'.($annee_actuelle - $i)}[$mois[$j]];
            }
            else {
                ${'taux_prelevement_'.$mois[$j].'_'.($annee_actuelle - $i)} = '0';
            }
        }

    } for ($i=1 ; $i<6 ; $i++) {

        // Requete SQL permettant de recuperer le bilan annuel par annee
        $select_bilan_annuel = $bdd->prepare('SELECT round(count(*) / (SELECT count(*) FROM entreprise WHERE upper(new_user) = "ACTIVE") * 100) AS bilan_annuel FROM bilan WHERE date_a = :annee');
        $select_bilan_annuel->bindValue(':annee', $annee_actuelle - $i);
        $select_bilan_annuel->execute();
        $result_bilan_annuel = $select_bilan_annuel->fetch();
        ${'bilan_annuel_'.($annee_actuelle - $i)} = $result_bilan_annuel['bilan_annuel'];

    }
    // FIN REQUETES CHART BAS DROITE

    // requête pour récupérer le data chart 
    // recup l'année 
    $pdoSt=$bdd->query('SELECT substr(date_crea, 7) AS annee FROM portefeuille');
    $pdoSt->execute();
    $annee = $pdoSt->fetch();
    
    $pdoSt= $bdd->prepare('SELECT substr(date_crea, 4,2) AS mois, COUNT(*) AS nb FROM (SELECT * FROM portefeuille WHERE substr(date_crea, 7) =:annee AND upper(statut) = :statut) AS temp GROUP BY substr(date_crea, 4,2)');
    $pdoSt->execute(array(':annee' => $annee['annee'], ':statut' => "ACTIF"));
    $actif = array();
    while ($result_actif = $pdoSt->fetch()) {
        $actif[$result_actif['mois']] = $result_actif['nb'];
    }

    $pdoSt= $bdd->prepare('SELECT substr(date_crea, 4,2) AS mois, COUNT(*) AS nb FROM (SELECT * FROM portefeuille WHERE substr(date_crea, 7) =:annee AND upper(statut) = :statut) AS temp GROUP BY substr(date_crea, 4,2)');
    $pdoSt->bindValue(':annee', $annee['annee']);
    $pdoSt->bindValue(':statut', "PASSIF");
    $pdoSt->execute();
    $passif = $pdoSt->fetchAll();

    for($i=0; $i<12; $i++) {
        if (array_key_exists($mois[$i], $actif)) {
            ${'nb_actif_'.$mois[$i]} = $actif[$mois[$i]];
        }
        else {
            ${'nb_actif_'.$mois[$i]} = 0;
        }
    }

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard Admin</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/dragula.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/swiper.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-primary navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <?php include('php/menu_backend.php'); ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper pt-0">
            <div class="content-header row">
            </div>
            <div class="content-body row">
                <!-- DEBUT MENU GAUCHE -->
                <div class="col-3">

                </div>
                <!-- FIN MENU GAUCHE -->
                <!-- Dashboard Analytics Start -->
                <div class="col-9">
                    <section id="component-swiper-gallery dashboard-analytics">
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-warning btn-lg btn-block py-1 py-md-0 px-0" ><strong class="d-none d-md-block">Comptabilité</strong></button>
                                </div>
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-info btn-lg btn-block py-1 py-md-0 px-0"><strong class="d-none d-md-block">Juridique</strong></button>
                                </div>
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-danger btn-lg btn-block py-1 py-md-0 px-0"><strong class="d-none d-md-block">Fiscalité</strong></button>
                                </div>
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-primary btn-lg btn-block py-1 py-md-0 px-0"><strong class="d-none d-md-block">Sociale</strong></button>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-gallery gallery-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <!-- DEBUT COMPTA -->
                                    <div class="row">
                                        <!-- DEBUT COLONNE GAUCHE -->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Compta</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Website Analytics</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN COLONNE GAUCHE -->
                                        <!-- DEBUT COLONNE DROITE -->
                                        <!-- FIN TABLE TRESORERIE -->
                                        <div class="col-xl-6 col-md-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                                            <h5 class="card-title"><i class="bx bx-group font-medium-5 align-middle"></i> <span class="align-middle">Comptables</span></h5>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body py-1 px-0">
                                                                <div class="d-flex justify-content-around">

                                                                    <a href="#" id="id_bouton_ventes" style="
                                                                        font-family: Rubik, Helvetica, Arial, serif;
                                                                        color: #FFFFFF;
                                                                        background-color: #5A8DEE;
                                                                        box-shadow: 0 0 3px 3px rgba(92,111,140,0.7);
                                                                        border-radius: 8px;">
                                                                        <div class="py-50 px-1 d-flex align-items-center" id="id_bouton_ventes">
                                                                        <i class="bx bx-dollar mr-50 font-large-1"></i>
                                                                        <div class="d-none d-md-block">
                                                                            <div>Ventes</div>              
                                                                        </div>
                                                                    </div></a>
                                                                    <a href="#" id="id_bouton_achats" style="
                                                                        font-family: Rubik, Helvetica, Arial, serif;
                                                                        color: #FFFFFF;
                                                                        background-color: none;
                                                                        box-shadow: 0 0 3px 3px rgba(92,111,140,0.7);
                                                                        border-radius: 8px;">
                                                                        <div class="py-50 px-1 d-flex align-items-center" id="id_bouton_achats">
                                                                        <i class="bx bx-wallet mr-50 font-large-1"></i>
                                                                        <div class="d-none d-md-block">
                                                                            <div>Achats</div>       
                                                                        </div>
                                                                    </div></a>
                                                                    <a href="#" id="id_bouton_tresorerie" style="
                                                                        font-family: Rubik, Helvetica, Arial, serif;
                                                                        color: #FFFFFF;
                                                                        background-color: none;
                                                                        box-shadow: 0 0 3px 3px rgba(92,111,140,0.7);
                                                                        border-radius: 8px;">
                                                                        <div class="py-50 px-1 d-flex align-items-center" id="id_bouton_tresorerie">
                                                                        <i class="bx bx-diamond mr-50 font-large-1"></i>
                                                                        <div class="d-none d-md-block">
                                                                            <div>Trésorerie</div> 
                                                                        </div>
                                                                    </div></a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- DEBUT TABLE VENTES -->
                                                        <div id="id_table_ventes" style="display:block;">   
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-25.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">Mera Lter</h6>
                                                                                        <span class="font-small-2">Designer</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-info progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="52" aria-valuemin="80" aria-valuemax="100" style="width:52%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-info">- $180</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">Pauly Dez</h6>
                                                                                        <span class="font-small-2">Devloper</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-success progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80" aria-valuemax="100" style="width:90%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-success">+ $553</span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">jini mara</h6>
                                                                                        <span class="font-small-2">Marketing</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-primary progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80" aria-valuemax="100" style="width:15%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-12.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">Lula Taylor</h6>
                                                                                        <span class="font-small-2">UX</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-danger progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80" aria-valuemax="100" style="width:35%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-danger">- $150</span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- FIN TABLE VENTES -->
                                                        <!-- DEBUT TABLE ACHATS -->
                                                        <div id="id_table_achats" style="display:none;"> 
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-25.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">Mera Lter</h6>
                                                                                        <span class="font-small-2">Designer</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-info progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="52" aria-valuemin="80" aria-valuemax="100" style="width:52%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-info">- $180</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">Pauly Dez</h6>
                                                                                        <span class="font-small-2">Devloper</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-success progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80" aria-valuemax="100" style="width:90%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-success">+ $553</span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">jini mara</h6>
                                                                                        <span class="font-small-2">Marketing</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-primary progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80" aria-valuemax="100" style="width:15%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- FIN TABLE ACHATS -->
                                                        <!-- DEBUT TABLE TRESORERIE -->
                                                        <div id="id_table_tresorerie" style="display:none;"> 
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-25.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">Mera Lter</h6>
                                                                                        <span class="font-small-2">Designer</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-info progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="52" aria-valuemin="80" aria-valuemax="100" style="width:52%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-info">- $180</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-75">
                                                                                <div class="media align-items-center">
                                                                                    <a class="media-left mr-50" href="#">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" class="rounded-circle" height="30" width="30">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <h6 class="media-heading mb-0">Pauly Dez</h6>
                                                                                        <span class="font-small-2">Devloper</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-0 w-25">
                                                                                <div class="progress progress-bar-success progress-sm mb-0">
                                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80" aria-valuemax="100" style="width:90%;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><span class="badge badge-light-success">+ $553</span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- FIN TABLE TRESORERIE -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN COMPTABLES -->
                                            <!-- DEBUT PRELEVEMENT ET BILAN -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <?php 
                                                                    for ($i=0; $i<5 ; $i++) {
                                                                        for ($j=0; $j<12 ; $j++) {
                                                                            $id_taux_prelevement = "taux_prelevement_".$mois[$j]."_".($annee_actuelle - $i); ?>
                                                                            <input type="hidden" id="<?= $id_taux_prelevement ?>" value="<?= ${'taux_prelevement_'.$mois[$j].'_'.($annee_actuelle - $i)} ?>"> <?php
                                                                        }
                                                                    } ?>
                                                                    <h6 class="text-white mb-1"> Prélèvement réussis </h6>
                                                                    <div class="d-flex justify-content-center">
                                                                        <select style="width: 80px;" class="form-control" id="id_select_mois_prelevement">
                                                                            <option value="01">Janv</option>
                                                                            <option value="02">Fevr</option>
                                                                            <option value="03">Mars</option>
                                                                            <option value="04">Avril</option>
                                                                            <option value="05">Mai</option>
                                                                            <option value="06">Juin</option>
                                                                            <option value="07">Juil</option>
                                                                            <option value="08">Aout</option>
                                                                            <option value="09">Sept</option>
                                                                            <option value="10">Oct</option>
                                                                            <option value="11">Nov</option>
                                                                            <option value="12">Dec</option>
                                                                        </select>
                                                                        <select style="width: 80px;" class="form-control" id="id_select_annee_prelevement">
                                                                            <option value="<?= $annee_actuelle ?>"><?= $annee_actuelle ?></option>
                                                                            <option value="<?= $annee_actuelle-1 ?>"><?= $annee_actuelle-1 ?></option>
                                                                            <option value="<?= $annee_actuelle-2 ?>"><?= $annee_actuelle-2 ?></option>
                                                                            <option value="<?= $annee_actuelle-3 ?>"><?= $annee_actuelle-3 ?></option>
                                                                            <option value="<?= $annee_actuelle-4 ?>"><?= $annee_actuelle-4 ?></option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="growth-Chart-prelevement"></div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <?php 
                                                                    for ($i=1; $i<6 ; $i++) {
                                                                        $id_bilan_annuel = "bilan_annuel_".($annee_actuelle - $i); ?>
                                                                        <input type="hidden" id="<?= $id_bilan_annuel ?>" value="<?= ${"bilan_annuel_".($annee_actuelle - $i)} ?>"> <?php
                                                                    } ?>
                                                                    <h6 class="text-white mb-1"> Bilans annuels </h6>
                                                                    <div class="d-flex justify-content-center">
                                                                        <select style="width: 80px;" class="form-control" id="id_select_bilan">
                                                                            <option value="<?= $annee_actuelle-1 ?>"><?= $annee_actuelle-1 ?></option>
                                                                            <option value="<?= $annee_actuelle-2 ?>"><?= $annee_actuelle-2 ?></option>
                                                                            <option value="<?= $annee_actuelle-3 ?>"><?= $annee_actuelle-3 ?></option>
                                                                            <option value="<?= $annee_actuelle-4 ?>"><?= $annee_actuelle-4 ?></option>
                                                                            <option value="<?= $annee_actuelle-5 ?>"><?= $annee_actuelle-5 ?></option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="growth-Chart-bilan" class="pb-0"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN PRELEVEMENT ET BILAN -->
                                        </div>
                                    </div>
                                    <!-- FIN COMPTA -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- DEBUT COMPTA -->
                                    <div class="row">
                                        <!-- DEBUT COLONNE GAUCHE -->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Juridique</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Website Analytics</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN COLONNE GAUCHE -->
                                        <!-- DEBUT COLONNE DROITE -->
                                        <div class="col-xl-6 col-md-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Website Analytics</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- DEBUT CROISSANCE -->
                                            <div class="row">
                                                <!-- Croissance 1 -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    2019
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                                                    <a class="dropdown-item" href="#">2019</a>
                                                                    <a class="dropdown-item" href="#">2018</a>
                                                                    <a class="dropdown-item" href="#">2017</a>
                                                                </div>
                                                            </div>
                                                            <div id="growth-Chart"></div>
                                                            <h6 class="mb-0"> 62% Company Growth in 2019</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Croissance 2-->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    2019
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                                                    <a class="dropdown-item" href="#">2019</a>
                                                                    <a class="dropdown-item" href="#">2018</a>
                                                                    <a class="dropdown-item" href="#">2017</a>
                                                                </div>
                                                            </div>
                                                            <div id="growth-Chart"></div>
                                                            <h6 class="mb-0"> 62% Company Growth in 2019</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN CROISSANCE -->
                                        </div>
                                    </div>
                                    <!-- FIN COMPTA -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- DEBUT COMPTA -->
                                    <div class="row">
                                        <!-- DEBUT COLONNE GAUCHE -->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Fiscalité</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Website Analytics</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN COLONNE GAUCHE -->
                                        <!-- DEBUT COLONNE DROITE -->
                                        <div class="col-xl-6 col-md-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Website Analytics</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- DEBUT CROISSANCE -->
                                            <div class="row">
                                                <!-- Croissance 1 -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    2019
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                                                    <a class="dropdown-item" href="#">2019</a>
                                                                    <a class="dropdown-item" href="#">2018</a>
                                                                    <a class="dropdown-item" href="#">2017</a>
                                                                </div>
                                                            </div>
                                                            <div id="growth-Chart"></div>
                                                            <h6 class="mb-0"> 62% Company Growth in 2019</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Croissance 2-->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    2019
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                                                    <a class="dropdown-item" href="#">2019</a>
                                                                    <a class="dropdown-item" href="#">2018</a>
                                                                    <a class="dropdown-item" href="#">2017</a>
                                                                </div>
                                                            </div>
                                                            <div id="growth-Chart"></div>
                                                            <h6 class="mb-0"> 62% Company Growth in 2019</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN CROISSANCE -->
                                        </div>
                                    </div>
                                    <!-- FIN COMPTA -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- DEBUT COMPTA -->
                                    <div class="row">
                                        <!-- DEBUT COLONNE GAUCHE -->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Sociale</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Website Analytics</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN COLONNE GAUCHE -->
                                        <!-- DEBUT COLONNE DROITE -->
                                        <div class="col-xl-6 col-md-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Website Analytics</h4>
                                                            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <p>hello</p>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                                                                    <div class="user-analytics">
                                                                        <i class="bx bx-user mr-25 align-middle"></i>
                                                                        <span class="align-middle text-muted">Users</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-success-chart"></div>
                                                                            <h3 class="mt-1 ml-50">61K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sessions-analytics">
                                                                        <i class="bx bx-trending-up align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Sessions</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-warning-chart"></div>
                                                                            <h3 class="mt-1 ml-50">92K</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">
                                                                        <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                                                        <span class="align-middle text-muted">Bounce Rate</span>
                                                                        <div class="d-flex">
                                                                            <div id="radial-danger-chart"></div>
                                                                            <h3 class="mt-1 ml-50">72.6%</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="analytics-bar-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- DEBUT CROISSANCE -->
                                            <div class="row">
                                                <!-- Croissance 1 -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    2019
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                                                    <a class="dropdown-item" href="#">2019</a>
                                                                    <a class="dropdown-item" href="#">2018</a>
                                                                    <a class="dropdown-item" href="#">2017</a>
                                                                </div>
                                                            </div>
                                                            <div id="growth-Chart"></div>
                                                            <h6 class="mb-0"> 62% Company Growth in 2019</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Croissance 2-->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    2019
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                                                    <a class="dropdown-item" href="#">2019</a>
                                                                    <a class="dropdown-item" href="#">2018</a>
                                                                    <a class="dropdown-item" href="#">2017</a>
                                                                </div>
                                                            </div>
                                                            <div id="growth-Chart"></div>
                                                            <h6 class="mb-0"> 62% Company Growth in 2019</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN CROISSANCE -->
                                        </div>
                                    </div>
                                    <!-- FIN COMPTA -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- Dashboard Analytics end -->
    </div>
    </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->

    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dragula.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="../../../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/swiper.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/dashboard.js"></script>
    <!-- END: Page JS-->
    <script>

        $(document).ready(function() {

            $("#id_bouton_ventes").click(function(e) {
                e.preventDefault();
                // changer la couleur de fond du bouton
                document.getElementById("id_bouton_ventes").style.backgroundColor="#5A8DEE";
                document.getElementById("id_bouton_achats").style.backgroundColor="";
                document.getElementById("id_bouton_tresorerie").style.backgroundColor="";
                // afficher la table correspondant aux ventes et masquer les autres
                document.getElementById("id_table_ventes").style.display = "block";
                document.getElementById("id_table_achats").style.display = "none";
                document.getElementById("id_table_tresorerie").style.display = "none";
            });
            $("#id_bouton_achats").click(function(e) {
                e.preventDefault();
                // changer la couleur de fond du bouton
                document.getElementById("id_bouton_ventes").style.backgroundColor="";
                document.getElementById("id_bouton_achats").style.backgroundColor="#5A8DEE";
                document.getElementById("id_bouton_tresorerie").style.backgroundColor="";
                // afficher la table correspondant aux achats et masquer les autres
                document.getElementById("id_table_ventes").style.display = "none";
                document.getElementById("id_table_achats").style.display = "block";
                document.getElementById("id_table_tresorerie").style.display = "none";
            });
            $("#id_bouton_tresorerie").click(function(e) {
                e.preventDefault();
                // changer la couleur de fond du bouton
                document.getElementById("id_bouton_ventes").style.backgroundColor="";
                document.getElementById("id_bouton_achats").style.backgroundColor="";
                document.getElementById("id_bouton_tresorerie").style.backgroundColor="#5A8DEE";
                // afficher la table correspondant à la trésorerie et masquer les autres
                document.getElementById("id_table_ventes").style.display = "none";
                document.getElementById("id_table_achats").style.display = "none";
                document.getElementById("id_table_tresorerie").style.display = "block";
            });

        });

    </script>

</body>
<!-- END: Body-->

</html>