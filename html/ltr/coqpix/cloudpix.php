<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/verif_connexion_comptable.php';
require_once 'php/config.php';
    
    $pdoStat = $bdd->prepare('SELECT * FROM stockage_admin WHERE recent = "1" OR recent = "2" OR recent = "3" OR recent = "4"');   
    $pdoStat->execute();  
    $recent = $pdoStat->fetchAll();

    $pdoSta = $bdd->prepare('SELECT * FROM stockage_admin');   
    $pdoSta->execute();  
    $file = $pdoSta->fetchAll();

    $pdoStatt = $bdd->prepare('SELECT * FROM calculs');
    $pdoStatt->execute();
    $calculs = $pdoStatt->fetch();

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
<style>
.none-validation{display: none;}
</style>
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
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <a class="dropdown-item" href="#comptable-profile.php"><i class="bx bx-user mr-50"></i> Editer Profile (SOON)</a>
                                <a class="dropdown-item" href="php/disconnect.php"><i class="bx bx-power-off mr-50"></i> Déconnexion</a>
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
                <li class=" nav-item <?php if(empty($_SESSION['id_admin'])){echo "none-validation";} ?>"><a href="dashboard-admin.php"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Clients">Dashboard</span></a>
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
                                    <a href="cloudpix.php" class="list-group-item list-group-item-action pt-0 active">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: morph-folder.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Tous
                                        <!-- <span class="badge badge-light-danger badge-pill badge-round float-right mt-50">2</span> Notification -->
                                    </a>
                                    <a href="cloudpix-valide.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: check-alt.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
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
                                <h5>Tous les documents</h5>

                                <!-- App File - Recent Accessed Files Section Starts -->
                                <label class="app-file-label">Fichiers récent</label>
                                <div class="row app-file-recent-access">
                                <?php foreach($recent as $recentt): ?><style>.red {color: rgb(39, 203, 192); text-decoration: underline black;} .black{color: black;}</style>
                                    <div class="col-md-3 col-6">
                                        <div class="card border shadow-none mb-1">  <!--  app-file-info pour faire a apparaitre la div info (a mettre dans la div) -->
                                            <div class="card-content">
                                                <div class="app-file-content-logo card-img-top">
                                                    <a href="<?php if($recentt['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $recentt['id'] ?>&num_ok="><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($recentt['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                    <a href="../../../src/files/<?php if($recentt['type_files_note'] == "note"){echo "note";}if($recentt['type_files_avoir'] == "avoir"){echo "avoir";}if($recentt['type_files_fac_achat'] == "fac_achat"){echo "fac-achat";}if($recentt['type_files_fac_ventes'] == "fac_ventes"){echo "fac-vente";}if($recentt['type_files_caisse_ventes'] == "cas_ventes"){echo "caisse";}if($recentt['banque'] == "banque"){echo "banque";} ?>/<?= $recentt['name_files'] ?>"><div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 20px "></div></a>
                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $recentt['img_files'] ?>" height="38" width="30" alt="Card image cap">
                                                </div>
                                                <div class="card-body p-50">
                                                    <div class="app-file-content-details"><style>.none{ color: grey;} .none:hover{color: #FDAC41;} .yellow{color: #FDAC41;}</style>
                                                        <a href="php/favorie.php?num=<?= $recentt['id'] ?>"><i class='bx bx-star none <?php if($recentt['favo'] == "favorie"){echo "yellow";} ?>'></i></a>
                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $recentt['name_files'] ?></div>
                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $recentt['size_files'] * 0.001 ?> Ko</div>
                                                        <div class="app-file-size font-size-small text-muted mb-25">Date : <?= $recentt['dte_files'] ?></div>
                                                        <div class="app-file-last-access font-size-small red"><?= $recentt['name_entreprise'] ?> > <a class="black" href="cloudpix-<?php if($recentt['type_files_note'] == "note"){echo "note";} if($recentt['type_files_avoir'] == "avoir"){echo "avoir";} if($recentt['type_files_fac_achat'] == "fac_achat"){echo "fac_achat";} if($recentt['type_files_fac_ventes'] == "fac_ventes"){echo "fac_ventes";} if($recentt['type_files_caisse_ventes'] == "cas_ventes"){echo "cas_ventes";} if($recentt['banque'] == "banque"){echo "banque";} ?>.php"><?php if($recentt['type_files_note'] == "note"){echo "Note de frais";} if($recentt['type_files_avoir'] == "avoir"){echo "Avoir";} if($recentt['type_files_fac_achat'] == "fac_achat"){echo "Facture d'achat";} if($recentt['type_files_fac_ventes'] == "fac_ventes"){echo "Facture de ventes";} if($recentt['type_files_caisse_ventes'] == "cas_ventes"){echo "Relevés de caisse";} if($recentt['banque'] == "banque"){echo "Banque";} ?></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <!-- App File - Recent Accessed Files Section Ends -->

                                <!-- App File - Folder Section Starts -->
                                <label class="app-file-label">Dossiers</label>
                                <div class="row app-file-folder">
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-fac_ventes.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <i class="bx bx-folder font-medium-4"></i>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold">Factures ventes</div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?= $calculs['nb_facture_ventes'] ?> Fichiers, <?= $calculs['size_ventes'] * 0.000001 ?>Mo</div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-fac_achat.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <i class="bx bx-folder font-medium-4"></i>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold">Factures achats</div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?= $calculs['nb_facture_achats'] ?> Fichiers, <?= $calculs['size_achats'] * 0.000001 ?>Mo</div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-note.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <i class="bx bx-folder font-medium-4"></i>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold">Note de frais</div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?= $calculs['nb_note'] ?> Fichiers, <?= $calculs['size_note'] * 0.000001 ?>Mo</div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-avoir.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <i class="bx bx-folder font-medium-4"></i>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold">Avoir</div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?= $calculs['nb_avoir'] ?> Fichiers, <?= $calculs['size_avoir'] * 0.000001 ?>Mo</div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-caisse.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <i class="bx bx-folder font-medium-4"></i>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold">Relevés de caisse</div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?= $calculs['nb_caisse'] ?> Fichiers, <?= $calculs['size_caisse'] * 0.000001 ?>Mo</div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="card border shadow-none mb-1">
                                            <div class="card-content">
                                                <div class="card-body px-75 py-50">
                                                    <a href="cloudpix-banque.php"><div class="app-file-folder-content d-flex align-items-center">
                                                        <div class="app-file-folder-logo mr-75">
                                                            <i class="bx bx-folder font-medium-4"></i>
                                                        </div>
                                                        <div class="app-file-folder-details">
                                                            <div class="app-file-folder-name font-size-small font-weight-bold">Relevés bancaires</div>
                                                            <div class="app-file-folder-size font-size-small text-muted"><?= $calculs['nb_banque'] ?> Fichiers, <?= $calculs['size_banque'] * 0.000001 ?>Mo</div>
                                                        </div>
                                                    </div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- App File - Folder Section Ends -->

                                <!-- App File - Files Section Starts -->
                                <label class="app-file-label">Fichiers</label>
                                <div class="row app-file-files">
                                <?php foreach($file as $files): ?>
                                    <div class="col-md-3 col-6">
                                        <div class="card border shadow-none mb-1">   <!-- ajoute a la div "app-file-info" pour l'onglet details-->
                                            <div class="card-content">
                                                <div class="app-file-content-logo card-img-top">
                                                    <a href="<?php if($files['send_files'] == "valide"){echo "php/ok-by-comptable.php?";}else{echo "saisie.php?";} ?>num=<?= $files['id'] ?>&num_ok="><div class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?php if($files['send_files'] == "valide"){ echo "rgb(39, 203, 192)";}else{ echo "#FF0000";} ?>; strokeColorAction: rgb(39, 203, 192); colorsOnHover: custom; colorsHoverTime: 0.1 "></div></a>
                                                    <a href="../../../src/files/<?php if($files['type_files_note'] == "note"){echo "note";}if($files['type_files_avoir'] == "avoir"){echo "avoir";}if($files['type_files_fac_achat'] == "fac_achat"){echo "fac-achat";}if($files['type_files_fac_ventes'] == "fac_ventes"){echo "fac-vente";}if($files['type_files_caisse_ventes'] == "cas_ventes"){echo "caisse";}if($files['banque'] == "banque"){echo "banque";} ?>/<?= $files['name_files'] ?>"><div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 20px "></div></a>
                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/pdf.png" height="38" width="30" alt="Card image cap">
                                                </div>
                                                <div class="card-body p-50">
                                                    <div class="app-file-details">
                                                        <a href="php/favorie.php?num=<?= $files['id'] ?>"><i class='bx bx-star none <?php if($files['favo'] == "favorie"){echo "yellow";} ?>'></i></a>
                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $files['name_files'] ?></div>
                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $files['size_files'] * 0.001 ?> Ko</div>
                                                        <div class="app-file-size font-size-small text-muted mb-25">Date : <?= $files['dte_files'] ?></div>
                                                        <div class="app-file-last-access font-size-small red"><?= $files['name_entreprise'] ?> > <a class="black" href="cloudpix-<?php if($files['type_files_note'] == "note"){echo "note";} if($files['type_files_avoir'] == "avoir"){echo "avoir";} if($files['type_files_fac_achat'] == "fac_achat"){echo "fac_achat";} if($files['type_files_fac_ventes'] == "fac_ventes"){echo "fac_ventes";} if($files['type_files_caisse_ventes'] == "cas_ventes"){echo "cas_ventes";} if($files['banque'] == "banque"){echo "banque";} ?>.php"><?php if($files['type_files_note'] == "note"){echo "Note de frais";} if($files['type_files_avoir'] == "avoir"){echo "Avoir";} if($files['type_files_fac_achat'] == "fac_achat"){echo "Facture d'achat";} if($files['type_files_fac_ventes'] == "fac_ventes"){echo "Facture de ventes";} if($files['type_files_caisse_ventes'] == "cas_ventes"){echo "Relevés de caisse";} if($files['banque'] == "banque"){echo "Relevés bancaires";} ?></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
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