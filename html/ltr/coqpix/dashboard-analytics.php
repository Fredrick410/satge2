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
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix"><div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>   <!--NOTIFICATION-->
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">0 Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                                            <!-- CONTENUE ONE -->
                                    </a>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> création du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php') ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
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
                        <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="greeting-text"><?= $entreprise['nameentreprise'] ?></h3>
                                    <p class="mb-0">Suivi de votre gain total</p>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Multi Radial Chart Starts -->
                        
                        <div class="col-xl-4 col-md-6 col-12 dashboard-visit">
                                    <!-- <div class="card">
                                        <div class="card-content">
                                            <div class="card-body text-center pb-0">
                                                <div id="success-line-chart"><div id="clock"><img src="../../../src/logo/astro.gif" class="img_one"><div id="secondes"></div><div id="minutes"></div><div id="heures"></div></div><br><br><br><br></div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                        <div class="col-xl-4 col-12 dashboard-users">
                            <div class="row  ">
                                <!-- Statistics Cards Starts -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-12 dashboard-users-success">
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
                                        <div class="col-xl-12 col-lg-6 col-12 dashboard-revenue-growth">
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
                                                                <i class="bx bxs-zap text-primary font-size-base"></i>
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
                                                                <i class="bx bx-stats text-info font-size-base"></i>
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
                                                                <i class="bx bx-user text-primary font-size-base"></i>
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
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>