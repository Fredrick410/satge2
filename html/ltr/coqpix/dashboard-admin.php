<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

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
        <div class="content-wrapper">
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
                            <div class="swiper-wrapper mt-25">
                                <div class="swiper-slide dash-compta">
                                    Comptabilité
                                </div>
                                <div class="swiper-slide dash-juri">
                                    Juridique
                                </div>
                                <div class="swiper-slide dash-fisca">
                                    Fiscalité
                                </div>
                                <div class="swiper-slide dash-socia">
                                    Sociale
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
                                <div class="swiper-slide"><!-- DEBUT COMPTA -->
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
                                                <div class="swiper-slide">  <!-- DEBUT COMPTA -->
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
                                        <div class="swiper-slide">  <!-- DEBUT COMPTA -->
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
    <script src="../../../app-assets/js/scripts/extensions/swiper.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
