<?php 
include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pd = $bdd->prepare('UPDATE membres SET  doc_note=:doc_note, doc_note_2=:doc_note_2, doc_note_3=:doc_note_3, doc_note_4=:doc_note_4, doc_note_5=:doc_note_5, nb_doc_note=:nb_doc_note');
        $pd->bindValue(':doc_note', "");
        $pd->bindValue(':doc_note_2', "");
        $pd->bindValue(':doc_note_3', "");
        $pd->bindValue(':doc_note_4', "");
        $pd->bindValue(':doc_note_5', "");
        $pd->bindValue(':nb_doc_note', "0");
    
        $pd->execute();

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']);
    $pdoSt->execute();
    $membre = $pdoSt->fetchAll();

    $pdo = $bdd->prepare('SELECT * FROM note WHERE name_membres = :num');
    $pdo->bindValue(':num',$_GET['name_membres']);
    $pdo->execute();
    $note = $pdo->fetchAll();

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
    <title>Liste note de frais</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout content-left-sidebar chat-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="<?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout">

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
                            <div class="dropdown-menu dropdown-menu-right pb-0"><a class="dropdown-item" href="page-user-profile.php"><i class="bx bx-user mr-50"></i>Profile</a>
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect.php"><i class="bx bx-power-off mr-50"></i>Se déconnecter</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
       <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <style>
                
                .logocoq{
                    width:70%;
                    height: 100%;
                }
                
                </style>
                <li class="nav-item mr-auto modern-nav-toggle text-center">
                    <img class="logocoq" src="../../../app-assets/images/logo/coqpix1.png" />
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class=" nav-item"><a href="#"><div class="livicon-evo" data-options=" name: rocket.svg; style:filled; size: 30px "></div>&nbsp&nbsp&nbsp<span class="menu-title" data-i18n="Dashboard">Coqpit</span></a>
                    <ul class="menu-content">
                        <li><a href="dashboard-analytics.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Analytique</span></a>
                        </li>
                        <li><a href="page-coming-soon.html#dashboard-ecommerce.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">eCommerce</span>&nbsp&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                        </li>
                        <li><a href="file-manager.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Cloudpix">CloudPix</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span>Fonctions</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Ventes">Ventes</span></a>
                    <ul class="menu-content">
                        <li><a href="app-devis-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Devis">Devis</span></a>
                        </li>
                        <li><a href="app-invoice-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Facture">Factures</span></a>
                        </li>
                        <li><a href="app-avoir-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Avoir">Avoirs</span></a>
                        </li>
                        <li><a href="app-bon-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bon de livraison">Bons de livraison</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="us-dollar"></i><span class="menu-title" data-i18n="Achats">Achats</span></a>
                    <ul class="menu-content">
                        <li><a href="app-invoice-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Factures">Factures</span></a>
                        </li>
                        <li><a href="app-bon-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bulletin de commande">Bulletins de commande</span></a>
                        </li>
                        <li><a href="app-note-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Note de frais">Note de frais</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="Projet">Projets</span></a>
                    <ul class="menu-content">
                        <li><a href="page-coming-soon.html#mission.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Mission">Missions &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></span></a>
                        </li>
                        <li><a href="teams-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Equipes">Teams</a>
                        </li>
                        <li><a href="task.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Taches">Taches</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="page-coming-soon.html#inventaire-list.php"><i class="menu-livicon" data-icon="box-add"></i><span class="menu-title" data-i18n="Stockage">Inventaire</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                </li>
                <li class=" nav-item"><a href="opportunite.php"><i class="menu-livicon" data-icon="trophy"></i><span class="menu-title" data-i18n="Buisness">Buisness</span><span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="briefcase"></i><span class="menu-title" data-i18n="Formation">Formations</span></a>
                    <ul class="menu-content">
                        <li><a href="page-coming-soon.html#academy.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Academy">Pix'Academy</span>&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                        </li>
                        <li><a href="#maforma.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="MA FORMA">Ma Forma</span>&nbsp&nbsp<span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#rh-home.php"><i class="menu-livicon" data-icon="diagram"></i><span class="menu-title" data-i18n="Stockage">RH</span><span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="sky-dish"></i><span class="menu-title" data-i18n="Veille">Veille</span></a>
                    <ul class="menu-content">
                        <li><a href="page-coming-soon.html#bookmark.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="bookmarks">BookMarks</span></a>
                        </li>
                        <li><a href="#benchmark.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="benchmark">BenchMark</span>&nbsp&nbsp<span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span>Données</span>
                </li>
                <li class=" nav-item"><a href="client.php"><i class="menu-livicon" data-icon="user"></i><span class="menu-title" data-i18n="Clients">Clients</span></a>
                </li>
                <li class=" nav-item"><a href="fournisseur-list.php"><i class="menu-livicon" data-icon="truck"></i><span class="menu-title" data-i18n="Fournisseurs">Fournisseurs</span></a>
                </li>
                <li class=" nav-item"><a href="article-list.php"><i class="menu-livicon" data-icon="tag"></i><span class="menu-title" data-i18n="Articles">Articles</span></a>
                </li>
                <li class=" nav-item"><a href="membres-liste.php"><i class="menu-livicon" data-icon="grid"></i><span class="menu-title" data-i18n="Membres">Membres</span></a>
                </li>
            
                <li class=" navigation-header"><span>Editions</span>
                </li>
                <li class=" nav-item"><a href="page-coming-soon.html#Bilan.php"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Bilans">Bilans</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                </li>
                <li class=" nav-item"><a href="page-coming-soon.html#balance.php"><i class="menu-livicon" data-icon="balance"></i><span class="menu-title" data-i18n="Balances">Balances</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                </li>
                <li class=" navigation-header"><span>Déclarations</span>
                </li>
                <li class=" nav-item"><a href="social.php"><i class="menu-livicon" data-icon="umbrella"></i><span class="menu-title" data-i18n="Charts">Sociales</span></span></a>
                </li>
                <li class=" nav-item"><a href="fiscale.php"><i class="menu-livicon" data-icon="piggybank"></i><span class="menu-title" data-i18n="Google Maps">Fiscales</span></a>
                </li>
                <li class=" navigation-header"><span>Divers</span>
                </li>
                <li class=" nav-item"><a href="outils.php"><i class="menu-livicon" data-icon="heart"></i><span class="menu-title" data-i18n="Google Maps">Outils</span></a>
                </li>
                <li class=" nav-item"><a href="page-coming-soon.html#financement.php"><i class="menu-livicon" data-icon="credit-card-in"></i><span class="menu-title" data-i18n="Google Maps">Financement</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                </li>
                <li class=" nav-item"><a href="page-coming-soon.html#assurance.php"><i class="menu-livicon" data-icon="car"></i><span class="menu-title" data-i18n="Google Maps">Assurance</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                </li>
                <li class=" nav-item"><a href="news.php"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Google Maps">News</span></a>
                </li>
                <li class=" nav-item"><a href="faq.php"><i class="menu-livicon" data-icon="info"></i><span class="menu-title" data-i18n="Google Maps">FAQ</span></a>
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
                    <!-- app chat user profile left sidebar start -->
                    <div class="chat-user-profile">
                        <header class="chat-user-profile-header text-center border-bottom">
                            <span class="chat-profile-close">
                                <i class="bx bx-x"></i>
                            </span>
                            <div class="my-2">
                                <div class="avatar">
                                    <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="user_avatar" height="100" width="100">
                                </div>
                                <h5 class="mb-0"><?= $entreprise['nameentreprise'] ?></h5>
                                <span><?= $entreprise['descr_entreprise'] ?></span>
                            </div>
                        </header>
                        <div class="chat-user-profile-content">
                            <div class="chat-user-profile-scroll">
                                <h6>PERSONAL INFORAMTION</h6>
                                <ul class="list-unstyled mb-2">
                                    <li class="mb-25"><?= $entreprise['emailentreprise'] ?></li>
                                    <li><?= $entreprise['telentreprise'] ?></li>
                                </ul>
                                <h6 class="text-uppercase mb-1">SETTINGS</h6>
                                <ul class="list-unstyled">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- app chat user profile left sidebar ends -->
                    <!-- app chat sidebar start -->
                    <div class="chat-sidebar card">
                        <span class="chat-sidebar-close">
                            <i class="bx bx-x"></i>
                        </span>
                        <div class="chat-sidebar-search">
                            <div class="d-flex align-items-center">
                                <div class="chat-sidebar-profile-toggle">
                                    <div class="avatar">
                                        <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="user_avatar" height="36" width="36">
                                    </div>
                                </div>
                                <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
                                    <input type="text" class="form-control round" id="chat-search" placeholder="Search">
                                    <div class="form-control-position">
                                        <i class="bx bx-search-alt text-dark"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="chat-sidebar-list-wrapper pt-2">
                            <h6 class="px-2 pt-2 pb-25 mb-0">Membres</h6>
                            <ul class="chat-sidebar-list">
                                <?php foreach($membre as $membres): ?>
                                <li>
                                    <a href="app-note-list_filtre.php?name_membres=<?= $membres['nom'] ?>"><div class="d-flex align-items-center">
                                        <div class="avatar m-0 mr-50"><img src="../../../src/img/<?= $membres['img_membres'] ?>" height="36" width="36" alt="sidebar user image">
                                            <span class="avatar-status-busy"></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0"><?= $membres['nom'] ?> <?= $membres['prenom'] ?></h6><span class="text-muted"><?= $membres['role_membres'] ?></span>
                                        </div>
                                    </div></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="container-fluid">
                        <div class="dropdown invoice-options mx-auto primary">
                            <style>
                            .back-blue{background: #1a233a;}
                            </style>
                            <button class="btn border mr-2 back-blue" type="button" id="invoice-options-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-plus white"></i><span class="white">Ajouter une note de frais</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-options-btn">
                                <?php foreach($membre as $membres): ?>
                                    <a type="submit" class="dropdown-item" href="app-note-add.php?numnote=<?= $membres['id'] ?>"><?= $membres['nom'] ?> <?= $membres['prenom'] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        </div>                        
                    </div>
                    <!-- app chat sidebar ends -->
                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- app chat overlay -->
                        <div class="chat-overlay"></div>
                        <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <span class="align-left">Membres</span>
                                    </th>
                                    <th>Intitulés</th>
                                    <th>Montants</th>
                                    <th>Dates</th>
                                    <th>Actions</th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($note as $notee): ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="app-invoice-view.php?numfacture=<?= $notee['id'] ?>"><img class="rounded-circle" src="../../../src/img/<?= $notee['img_membres'] ?>" height="60" width="60" alt="sidebar user image"></a>
                                    </td>
                                    <td>
                                        <span class="invoice-amount">&nbsp&nbsp<?= $notee['objet'] ?></span>
                                    </td>
                                    <td><span class="invoice-amount">&nbsp&nbsp<?= $notee['montant'] ?> €</span></td>
                                    <td><small class="text-muted"><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($notee['dte'])); ?></small></td>
                                    <!-- badge badge-light-success badge-pill -->
                                    <td>
                                        <div class="invoice-action"><br>
                                            <a href="../../../src/files/note/zip/<?= $notee['zip_name'] ?>" download class="invoice-action-view mr-1">
                                                <i class='bx bxs-download'></i>
                                            </a>
                                            <a href="php/delete_note.php?numnote=<?= $notee['id'] ?>" class="invoice-action-view mr-1">
                                                <i class='bx bxs-trash'></i>
                                            </a>                           
                                            
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>