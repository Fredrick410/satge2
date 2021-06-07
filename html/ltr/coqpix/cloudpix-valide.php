<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_connexion_comptable.php';

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="01"');   
    $pdoSt->execute();  
    $janvier = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="02"');   
    $pdoSt->execute();  
    $fevrier = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="03"');   
    $pdoSt->execute();  
    $mars = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="04"');   
    $pdoSt->execute();  
    $avril = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="05"');   
    $pdoSt->execute();  
    $mai = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="06"');   
    $pdoSt->execute();  
    $juin = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="07"');   
    $pdoSt->execute();  
    $juillet = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="08"');   
    $pdoSt->execute();  
    $aout = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="09"');   
    $pdoSt->execute();  
    $septembre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="10"');   
    $pdoSt->execute();  
    $octobre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="11"');   
    $pdoSt->execute();  
    $novembre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE send_files="valide" AND dte_m="12"');   
    $pdoSt->execute();  
    $decembre = $pdoSt->fetchAll();

    $pdoS = $bdd->prepare('SELECT * FROM calculs');
    $pdoS->execute();
    $calculs = $pdoS->fetch();

    $pdoStattt = $bdd->prepare('SELECT * FROM comptable WHERE id=:id_comptable');
    $pdoStattt->bindValue(':id_comptable', $_SESSION['id_comptable']);
    $pdoStattt->execute();
    $comptable = $pdoStattt->fetch();

?>


<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>CloudPix</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-file-manager.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar file-manager-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">                   
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Français</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> Français</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">Notifications</span></div>
                                </li>
                                <li class="scrollable-container media-list">
                                    <div class="d-flex justify-content-between read-notification cursor-pointer">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Pix</span> confirmation (Soon)</h6><small class="notification-text">Rappel de facture envoye</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Marque comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $comptable['prenom'] ?> <?= $comptable['nom'] ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0"><a class="dropdown-item" href="#comptable-profile.php"><i class="bx bx-user mr-50"></i> Editer Profile (SOON)</a>
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect.php"><i class="bx bx-power-off mr-50"></i> Déconnexion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <style>
                
                .logocoq{
                    width:70%;
                    height: 100%;
                }
                
                </style>
                <li class="nav-item mr-auto modern-nav-toggle text-center">
                    <img class="logocoq" src="../../../app-assets/images/logo/coqpix2.png" />
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class=" navigation-header"><span>Comptabilité</span>
                </li>
                <li class=" nav-item"><a href="cloudpix.php"><i class="menu-livicon" data-icon="cloud-download"></i><span class="menu-title" data-i18n="Clients">Cloudpix</span></a>
                </li>
                <li class=" nav-item"><a href="page-coming-soon.html#rappel.php"><i class="menu-livicon" data-icon="warning-alt"></i><span class="menu-title" data-i18n="Clients">Rappel facture</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                </li>
                <li class=" nav-item"><a href="page-coming-soon.html#declaration.php"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Clients">Déclaration TVA</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="app-file-sidebar sidebar-content d-flex">
                        <!-- App File sidebar - Left section Starts -->
                        <div class="app-file-sidebar-left">
                            <!-- sidebar close icon starts -->
                            <span class="app-file-sidebar-close"><i class="bx bx-x"></i></span>
                            <!-- sidebar close icon ends -->
                            <div class="app-file-sidebar-content">
                                <!-- App File Left Sidebar - Drive Content Starts -->
                                <label class="app-file-label">Cloudpix</label>
                                <div class="list-group list-group-messages my-50">
                                    <a href="cloudpix.php" class="list-group-item list-group-item-action pt-0">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: morph-folder.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Tous
                                        <!-- <span class="badge badge-light-danger badge-pill badge-round float-right mt-50">2</span> Notification -->
                                    </a>
                                    <a href="cloudpix-valide.php" class="list-group-item list-group-item-action active">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: check-alt.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Valides
                                    </a>
                                    <a href="cloudpix-nonvalide.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: dislike.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div> Non valides
                                    </a>
                                    <a href="cloudpix-important.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: morph-star.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Important
                                    </a>
                                </div>
                                <!-- App File Left Sidebar - Drive Content Ends -->

                                <!-- App File Left Sidebar - Labels Content Starts -->
                                <div class="list-group list-group-labels my-50">
                                    <label class="app-file-label">Ventes</label>
                                    <a href="cloudpix-fac_ventes.php" class="list-group-item list-group-item-action pt-0">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: coins.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Factures ventes
                                    </a>
                                    <a href="cloudpix-avoir.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: box-add.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Avoir
                                    </a>
                                    <label class="app-file-label">Achats</label>
                                    <a href="cloudpix-fac_achat.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: us-dollar.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Factures achats
                                    </a>
                                    <a href="cloudpix-note.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: shoppingcart.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div> Note de frais
                                    </a>
                                    <label class="app-file-label">Trésorerie</label>
                                    <a href="cloudpix-banque.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: bank.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Relevés bancaires
                                    </a>
                                    <a href="cloudpix-caisse.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: calculator.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Relevés de caisses
                                    </a>
                                </div>
                                <!-- App File Left Sidebar - Labels Content Ends -->
                            </div>
                        </div>
                    </div>
                    <!-- App File sidebar - Right section Starts -->
                    <div class="app-file-sidebar-info">
                        <div class="card shadow-none mb-0 p-0 pb-1">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                                <h6 class="mb-0">Document.pdf</h6>
                                <div class="app-file-action-icons d-flex align-items-center">
                                    <i class="bx bx-trash cursor-pointer mr-50"></i>
                                    <i class="bx bx-x close-icon cursor-pointer"></i>
                                </div>
                            </div>
                            <div class="card-content">
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item mr-1 pt-50 pr-1 border-right">
                                        <a class=" nav-link active d-flex align-items-center" id="details-tab" data-toggle="tab" href="#details" aria-controls="details" role="tab" aria-selected="true">
                                            <i class="bx bx-file mr-50"></i>Details</a>
                                    </li>
                                    <li class="nav-item pt-50 ">
                                        <a class=" nav-link d-flex align-items-center" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false">
                                            <i class="bx bx-pulse mr-50"></i>Activity</a>
                                    </li>
                                </ul>
                                <div class="tab-content pl-0">
                                    <div class="tab-pane active" id="details" aria-labelledby="details-tab" role="tabpanel">
                                        <div class="border-bottom d-flex align-items-center flex-column pb-1">
                                            <img src="../../../app-assets/images/icon/pdf.png" alt="PDF" height="42" width="35" class="my-1">
                                            <p class="mt-2">15.3mb</p>
                                        </div>
                                        <div class="card-body pt-2">
                                            <label class="app-file-label">Setting</label>
                                            <div class="d-flex justify-content-between align-items-center mt-75">
                                                <p>File Sharing</p>
                                                <div class="custom-control custom-switch custom-switch-primary custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchGlow1">
                                                    <label class="custom-control-label" for="customSwitchGlow1"></label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Synchronization</p>
                                                <div class="custom-control custom-switch custom-switch-primary custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchGlow2" checked>
                                                    <label class="custom-control-label" for="customSwitchGlow2"></label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Backup</p>
                                                <div class="custom-control custom-switch custom-switch-primary custom-switch-glow custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchGlow3">
                                                    <label class="custom-control-label" for="customSwitchGlow3"></label>
                                                </div>
                                            </div>

                                            <label class="app-file-label">Info</label>
                                            <div class="d-flex justify-content-between align-items-center mt-75">
                                                <p>Type</p>
                                                <p class="font-weight-bold">PDF</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Size</p>
                                                <p class="font-weight-bold">15.6mb</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Location</p>
                                                <p class="font-weight-bold">Files > Documents</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Owner</p>
                                                <p class="font-weight-bold">Elnora Reese</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Modified</p>
                                                <p class="font-weight-bold">September 4 2019</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Opened</p>
                                                <p class="font-weight-bold">July 8, 2019</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p>Created</p>
                                                <p class="font-weight-bold">July 1, 2019</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane pl-0" id="activity" aria-labelledby="activity-tab" role="tabpanel">
                                        <div class="card-body">
                                            <ul class="widget-timeline mb-0">
                                                <li class="timeline-items timeline-icon-success active">
                                                    <div class="timeline-time">Today</div>
                                                    <h6 class="timeline-title">You added an item to</h6>
                                                    <p class="timeline-text">You added an item</p>
                                                    <div class="timeline-content">
                                                        <img src="../../../app-assets/images/icon/psd.png" alt="PSD" height="30" width="25" class="mr-50">Mockup.psd
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-info active">
                                                    <div class="timeline-time">10 min ago</div>
                                                    <h6 class="timeline-title">You shared 2 times</h6>
                                                    <p class="timeline-text">Emily Bennett edited an item</p>
                                                    <div class="timeline-content">
                                                        <img src="../../../app-assets/images/icon/sketch.png" alt="Sketch" height="30" width="25" class="mr-50">Template_Design.sketch
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-danger active">
                                                    <div class="timeline-time">Mon 10:20 PM</div>
                                                    <h6 class="timeline-title">You edited an item</h6>
                                                    <p class="timeline-text">You edited an item</p>
                                                    <div class="timeline-content">
                                                        <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-50">Information.doc
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-primary active">
                                                    <div class="timeline-time">Jul 13 2019</div>
                                                    <h6 class="timeline-title">You edited an item</h6>
                                                    <p class="timeline-text">John Keller edited an item</p>
                                                    <div class="timeline-content">
                                                        <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-50">Documentation.doc
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning">
                                                    <div class="timeline-time">Apr 18 2019</div>
                                                    <h6 class="timeline-title">You added an item to</h6>
                                                    <p class="timeline-text">You edited an item</p>
                                                    <div class="timeline-content">
                                                        <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-50">Resume.pdf
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- App File sidebar - Right section Ends -->

                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- File Manager app overlay -->
                        <div class="app-file-overlay"></div>
                        <div class="app-file-area">
                            <!-- File App Content Area -->
                            <!-- App File Header Starts -->
                            <div class="app-file-header">
                                <!-- Header search bar starts RECHERCHER DE COMMENTE -->
                                <!-- <div class="app-file-header-search flex-grow-1">
                                    <div class="sidebar-toggle d-block d-lg-none">
                                        <i class="bx bx-menu"></i>
                                    </div>
                                    <fieldset class="form-group position-relative has-icon-left m-0">
                                        <input type="text" class="form-control border-0 shadow-none" id="email-search" placeholder="Recherche">
                                        <div class="form-control-position">
                                            <i class="bx bx-search"></i>
                                        </div>
                                    </fieldset>
                                </div> -->
                                <!-- Header search bar Ends -->
                                <!-- Header Icons Starts -->
                                <div class="app-file-header-icons">
                                    <div class="fonticon-wrap d-inline mx-sm-1 align-left">
                                        <i class="livicon-evo cursor-pointer" data-options="name: cloud-download.svg; size: 40px; strokeColor: #ff0000; strokeColorAction: #ff0000; fillColor: #ff0000; colorsOnHover: custom"></i>
                                    </div>
                                </div>
                                <!-- Header Icons Ends -->
                            </div>
                            <!-- App File Header Ends -->

                            <!-- App File Content Starts -->
                            <div class="app-file-content p-2">
                                <h5>Fichiers saisies</h5>


                                <!-- App File - Files Section Starts -->
                                <label class="app-file-label">Janvier</label>
                                <div class="row app-file-files">
                                <?php foreach($janvier as $janvierr): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($janvierr['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $janvierr['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($janvierr['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $janvierr['name_files'] ?> > <?= $janvierr['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($janvierr['send_files'] == "valide"){$num_saisie = $janvierr['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Février</label>
                                <div class="row app-file-files">
                                <?php foreach($fevrier as $fevrierr): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($fevrierr['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $fevrierr['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($fevrierr['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $fevrierr['name_files'] ?> > <?= $fevrierr['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($fevrierr['send_files'] == "valide"){$num_saisie = $fevrierr['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Mars</label>
                                <div class="row app-file-files">
                                <?php foreach($mars as $marss): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($marss['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $marss['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($marss['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $marss['name_files'] ?> > <?= $marss['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($marss['send_files'] == "valide"){$num_saisie = $marss['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Avril</label>
                                <div class="row app-file-files">
                                <?php foreach($avril as $avrill): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($avrill['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $avrill['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($avrill['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $avrill['name_files'] ?> > <?= $avrill['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($avrill['send_files'] == "valide"){$num_saisie = $avrill['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Mai</label>
                                <div class="row app-file-files">
                                <?php foreach($mai as $maii): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($maii['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $maii['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($maii['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $maii['name_files'] ?> > <?= $maii['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($maii['send_files'] == "valide"){$num_saisie = $maii['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Juin</label>
                                <div class="row app-file-files">
                                <?php foreach($juin as $juinn): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($juinn['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $juinn['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($juinn['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $juinn['name_files'] ?> > <?= $juinn['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($juinn['send_files'] == "valide"){$num_saisie = $juinn['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Juillet</label>
                                <div class="row app-file-files">
                                <?php foreach($juillet as $juillett): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($juillett['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $juillett['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($juillett['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $juillett['name_files'] ?> > <?= $juillett['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($juillett['send_files'] == "valide"){$num_saisie = $juillett['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Août</label>
                                <div class="row app-file-files">
                                <?php foreach($aout as $aoutt): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($aoutt['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $aoutt['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($aoutt['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $aoutt['name_files'] ?> > <?= $aoutt['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($aoutt['send_files'] == "valide"){$num_saisie = $aoutt['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Septembre</label>
                                <div class="row app-file-files">
                                <?php foreach($septembre as $septembree): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($septembree['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $septembree['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($septembree['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $septembree['name_files'] ?> > <?= $septembree['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($septembree['send_files'] == "valide"){$num_saisie = $septembree['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Octobre</label>
                                <div class="row app-file-files">
                                <?php foreach($octobre as $octobree): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($octobree['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $octobree['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($octobree['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $octobree['name_files'] ?> > <?= $octobree['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($octobree['send_files'] == "valide"){$num_saisie = $octobree['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Novembre</label>
                                <div class="row app-file-files">
                                <?php foreach($novembre as $novembree): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($novembree['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $novembree['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($novembree['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $novembree['name_files'] ?> > <?= $novembree['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($novembree['send_files'] == "valide"){$num_saisie = $novembree['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                <label class="app-file-label">Décembre</label>
                                <div class="row app-file-files">
                                <?php foreach($decembre as $decembree): ?>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <a href="<?php if($decembree['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $decembree['id'] ?>&num_ok=one"><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($decembree['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $decembree['name_files'] ?> > <?= $decembree['dte_files'] ?></div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?php if($decembree['send_files'] == "valide"){$num_saisie = $decembree['num_saisie']; echo 'N° '.$num_saisie.'';}else{echo "Pas de numéros de saisie";} ?></div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <hr>
                                
                                <!-- App File - Files Section Ends -->
                            </div>
                        </div>

                    </div>
                </div>
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-light.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-file-manager.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>