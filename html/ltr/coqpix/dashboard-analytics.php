<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();
   
    $pdoStat = $bdd->prepare('SELECT * FROM facture WHERE id_session = :num');
    $pdoStat->bindValue(':num',$_SESSION['id_session']);
    $pdoStat->execute();
    $true = $pdoStat->execute();
    $facture = $pdoStat->fetchAll();

    $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $calculs = $pdoS->fetch();

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
    <title>Dashboard - analytics</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/dragula.min.css">
    <script src="../../../app-assets/vendors/js/extensions/shepherd.min.js"></script>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/clock.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">

    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
    include('php/menu_header_front.php');?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <!-- Greetings Content Starts -->
                        <div class="col-xl-6 col-md-8 col-12 dashboard-greetings">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="greeting-text"><?= $entreprise['nameentreprise'] ?></h3>
                                    <a href="teste.php"><p class="mb-0">Suivi de votre gain total</p></a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="dashboard-content-left">
                                            <h3 class="text-primary font-large-2 text-bold-450"><?= $calculs['facture_all'] ?><p class="font-large-1">&nbsp Euros</p></h3>
                                                <p>L'ensemble des factures depuis le début.</p>
                                                <a href="app-invoice-list.php"><button type="button" class="btn btn-primary glow">Voir facture</button></a>
                                            </div>
                                            <div class="dashboard-content-right">
                                                <img src="../../../app-assets/images/icon/cup.png" height="220" width="220" class="img-fluid" alt="Dashboard Ecommerce" />
                                            </div>
                                            <?php
                                                var_dump($_SESSION['email']);
                                                var_dump($_SESSION['id']);
                                                var_dump($_SESSION['id_session']);
                                                var_dump($_SESSION['id_membre']);
                                                var_dump($_SESSION['role']);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Multi Radial Chart Starts -->
                        
                        <!--<div class="col-xl-4 col-md-6 col-12 dashboard-visit">
                                    <!-- <div class="card">
                                        <div class="card-content">
                                            <div class="card-body text-center pb-0">
                                                <div id="success-line-chart"><div id="clock"><img src="../../../src/logo/astro.gif" class="img_one"><div id="secondes"></div><div id="minutes"></div><div id="heures"></div></div><br><br><br><br></div>
                                            </div>
                                        </div>
                                    </div>
                        </div> -->
                        <div class="col-xl-6 dashboard-users">
                            <div class="row  ">
                                <!-- Statistics Cards Starts -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-10 dashboard-users-success">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-1">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-briefcase-alt font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Produit (Soon)</div>
                                                        <h3 class="mb-0">0</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12 dashboard-users-danger">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-1">
                                                        <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                            <i class="bx bx-user font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">Utilisateur</div>
                                                        <h3 class="mb-0">1</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-1 col-12 dashboard-revenue-growth">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                                                    <h4 class="card-title">Hausse des revenus</h4>
                                                    <div class="d-flex align-items-end justify-content-end">
                                                        <span class="mr-25">0 €</span>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body pb-0">
                                                        <div id="revenue-growth-chart"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Revenue Growth Chart Starts -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Latest Update Starts -->
                        <div class=" col-12 dashboard-latest-update">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center pb-50">
                                    <h4 class="card-title">Mes activités</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body p-0 pb-1">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-primary m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bxs-truck text-primary font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content">
                                                        <span class="list-title">Ventes</span>
                                                        <small class="text-muted d-block">Total des ventes</small>
                                                    </div>
                                                </div>
                                            <span><?= $calculs['facture_all'] ?> €</span>
                                            </li>
                                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-info m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bxs-cart text-info font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content">
                                                        <span class="list-title">Achats</span>
                                                        <small class="text-muted d-block">Total des achats</small>
                                                    </div>
                                                </div>
                                                <span><?= $calculs['facture_all_achat'] ?> €</span>
                                            </li>
                                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-danger m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bx-credit-card text-danger font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content">
                                                        <span class="list-title">Investissements</span>
                                                        <small class="text-muted d-block">Total des devis en cours</small>
                                                    </div>
                                                </div>
                                            <span><?= $calculs['devis_all'] ?> €</span>
                                            </li>
                                            <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                <div class="list-left d-flex">
                                                    <div class="list-icon mr-1">
                                                        <div class="avatar bg-rgba-primary m-0">
                                                            <div class="avatar-content">
                                                                <i class="bx bxs-dollar-circle text-primary font-size-base"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-content">
                                                        <span class="list-title">Bénéfices</span>
                                                        <small class="text-muted d-block">Total des bénéfices</small>
                                                    </div>
                                                </div>
                                                <span><?=  $calculs['facture_all'] - $calculs['facture_all_achat'] ?> €</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Marketing Campaigns Starts -->
                        <div class="col-xl-15 col-12 dashboard-marketing-campaign">
                            <div class="card marketing-campaigns">
                                <div class="card-header d-flex justify-content-between align-items-center pb-1">
                                    <h4 class="card-title">Liste facture</h4>
                                    <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-md-9 col-12">
                                                
                                                <div class="d-inline-block">
                                                    <!-- chart-2 -->
                                                    <div class="d-flex mb-75 market-statistics-2">
                                                        <!-- chart statistics-2 -->
                                                        <div id="donut-danger-chart"></div>
                                                        <!-- data-2 -->
                                                        <div class="statistics-data my-auto">
                                                            <div class="statistics">
                                                                <span class="font-medium-2 mr-50 text-bold-600">Nombre de facture : </span><span class="text-danger"><?= $calculs['facture_nb'] ?></h1></span>
                                                            </div>
                                                            <div class="statistics-date">
                                                                <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>
                                                                <small class="text-muted">Ajout le plus récent le <?= $calculs['lastdte'] ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12 text-md-right">
                                                <a href="app-invoice-list.php"><button class="btn btn-sm btn-primary glow mt-md-2 mb-1">Voir Facture</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <!-- table start -->
                                    <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">
                                        <thead>
                                            <tr>
                                                <th>Clients</th>
                                                <th>Dates</th>
                                                <th>Montants</th>
                                                <th >Factures</th>
                                                <th>Statuts</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($facture as $factures):
                                        $numeros = $factures['numerosfacture'];
                                        try{
  
                                            $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros ) T ";
  
                                            $req = $bdd->prepare($sql);
                                            $req->bindValue(':num',"1"); //$_SESSION['id_session']
                                            $req->bindValue(':numeros',$numeros); 
                                            $req->execute();
                                            $res = $req->fetch();
                                            }catch(Exception $e){
                                                echo "Erreur " . $e->getMessage();
                                            }

                                            $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;
                                        
                                        ?>
                                            <tr>
                                                <td class="py-1 line-ellipsis">
                                                    <img class="rounded-circle mr-1" src="../../../app-assets/images/icon/fs.png" alt="card" height="24" width="24"><?= $factures['facturepour'] ?>
                                                </td>
                                                <td class="py-1">
                                                    <span><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($factures['dte']));?></span>
                                                </td>
                                                <td class="py-1">&nbsp&nbsp&nbsp<?= $montant_t; ?> <?= $factures['monnaie'] ?></td>
                                                <td class="py-1">FAC - <?= $factures['numerosfacture'] ?></td>
                                                <td class="<?= $factures['status_color'] ?>"><?= $factures['status_facture'] ?></td>
                                                </td>
                                            </tr>
                                            
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- table ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->
    <div class="widget-chat-demo">
        <!-- widget chat demo footer button start -->
        <button class="btn btn-primary chat-demo-button glow px-1"><i class="livicon-evo" data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i><span class="badge badge-pill badge-danger badge-up badge-round badge-glow">1</span></button>
        <!-- widget chat demo footer button ends -->
        <!-- widget chat demo start -->
        <div class="widget-chat widget-chat-demo d-none">
            <div class="card mb-0">
                <div class="card-header border-bottom p-0">
                    <div class="media m-75">
                        <a href="JavaScript:void(0);">
                            <div class="avatar mr-75">
                                <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avtar images" width="32" height="32">
                                <span class="avatar-status-online"></span>
                            </div>
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);">Kiara Cruiser</a></h6>
                            <span class="text-muted font-small-3">Active</span>
                        </div>
                        <i class="bx bx-x widget-chat-close float-right my-auto cursor-pointer"></i>
                    </div>
                </div>
                <div class="card-body widget-chat-container widget-chat-demo-scroll">
                    <div class="chat-content">
                        <div class="badge badge-pill badge-light-secondary my-1">today</div>
                        <div class="chat">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>How can we help? 😄</p>
                                    <span class="chat-time">7:45 AM</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>Hey John, I am looking for the best admin template.</p>
                                    <p>Could you please help me to find it out? 🤔</p>
                                    <span class="chat-time">7:50 AM</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>Stack admin is the responsive bootstrap 4 admin template.</p>
                                    <span class="chat-time">8:01 AM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top p-1">
                    <form class="d-flex" onsubmit="widgetChatMessageDemo();" action="javascript:void(0);">
                        <input type="text" class="form-control chat-message-demo mr-75" placeholder="Type here...">
                        <button type="submit" class="btn btn-primary glow px-1"><i class="bx bx-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- widget chat demo ends -->

    </div>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
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
    <script src="../../../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="../../../app-assets/js/scripts/pages/script.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/tour.js"></script>  
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
    


    
    <?php
         //Exectution des "premiers pas"
        $pdoS = $bdd->prepare('SELECT premiere_connexion FROM entreprise WHERE id=:id_session');
        $pdoS->bindValue(':id_session', $_SESSION['id_session']);
        $pdoS->execute();
        $premiere_connexion = ($pdoS->fetch())['premiere_connexion'];
        if ( $premiere_connexion == 1) {
            ?><script>document.onload = tour.start()</script><?php


        }
    ?>



</body>
<!-- END: Body-->

</html>
