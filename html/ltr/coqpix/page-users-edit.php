<?php 

require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoStat->execute();
    $entreprise = $pdoStat->fetch();

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
    <title>Editer profile</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/jkanban/jkanban.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
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
                        <li><a href="app-bon-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bon de livraison">Bon de livraison</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="us-dollar"></i><span class="menu-title" data-i18n="Achats">Achats</span></a>
                    <ul class="menu-content">
                        <li><a href="app-invoice-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Factures">Factures</span></a>
                        </li>
                        <li><a href="app-bon-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bulletin de commande">Bulletin de commande</span></a>
                        </li>
                        <li><a href="app-note-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Note de frais">Note de frais</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="Projet">Projet</span></a>
                    <ul class="menu-content">
                        <li><a href="mission.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Mission">Mission &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></span></a>
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
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="briefcase"></i><span class="menu-title" data-i18n="Formation">Formation</span></a>
                    <ul class="menu-content">
                        <li><a href="page-coming-soon.html#academy.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Academy">Pix'Academy</span>&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                        </li>
                        <li><a href="#maforma.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="MA FORMA">Ma Forma</span>&nbsp&nbsp<span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="rh-home.php"><i class="menu-livicon" data-icon="diagram"></i><span class="menu-title" data-i18n="Stockage">RH</span><span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
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
                <li class=" nav-item"><a href="social.php"><i class="menu-livicon" data-icon="umbrella"></i><span class="menu-title" data-i18n="Charts">Sociale</span></span></a>
                </li>
                <li class=" nav-item"><a href="fiscale.php"><i class="menu-livicon" data-icon="piggybank"></i><span class="menu-title" data-i18n="Google Maps">Fiscale</span></a>
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
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="h-auto card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Info Société</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                            <i class="bx bx-info-circle mr-25"></i><span class="d-none d-sm-block">Info Dirigeant</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->
                                        <form action="php/insert_image_edit.php" method="POST" enctype="multipart/form-data">
                                        <div class="media mb-2">
                                            <a class="mr-2" href="#">
                                                <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Image de l'entreprise</h4>
                                                <div class="col-12 px-0 d-flex">
                                                    <input type="file" accept="image/png, image/jpg, image/jpeg" name="FILES" required>                                                   
                                                </div><br>
                                                <input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary">
                                            </div>
                                        </div>
                                        </form>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                            <form action="php/edit_profile_1.php" method="GET">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Nom de la société :</label>
                                                            <input name="nameentreprise" type="text" class="form-control" placeholder="Nom de la société" value="<?= $entreprise['nameentreprise']; ?>" required data-validation-required-message="Le nom d'entreprise est imcomplet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Numéros Siret :</label>
                                                            <input name="numerossiret" type="text" class="form-control" placeholder="N°Siret" value="<?= $entreprise['numerossiret']; ?>" required data-validation-required-message="Le nom d'entreprise est imcomplet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Pays de la société :</label>
                                                            <input name="pays_entreprise" type="text" class="form-control" placeholder="Pays" value="<?= $entreprise['pays_entreprise']; ?>" required data-validation-required-message="Pays de la société">
                                                        </div>
                                                    </div>
                                                        <div class="controls">
                                                            <label>*Adresse société :</label>
                                                            <input name="adresseentreprise" type="text" class="form-control" placeholder="Adresse de la societe" value="<?= $entreprise['adresseentreprise']; ?>" required data-validation-required-message="L'adresse de la societe est obligatoire">
                                                        </div><br>
                                                        <label>Secteur d'activité :</label>
                                                        <fieldset class="invoice-address form-group">
                                                            <select name="descr_entreprise" class="form-control invoice-item-select">
                                                                <option value="<?= $entreprise['descr_entreprise'] ?>"><?= $entreprise['descr_entreprise'] ?></option>
                                                                <option value="Agroalimentaire">Agroalimentaire</option>
                                                                <option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
                                                                <option value="Chimie / Parachimie">Chimie / Parachimie</option>
                                                                <option value="Électronique / Électricité">Électronique / Électricité</option>
                                                                <option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
                                                                <option value="Machines et équipements / Automobile">Machines et équipements / Automobile</option>
                                                                <option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
                                                                <option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
                                                                <option value="Banque / Assurance">Banque / Assurance</option>
                                                                <option value="BTP / Matériaux de construction">BTP / Matériaux de construction</option>
                                                                <option value="Commerce / Négoce / Distribution">Commerce / Négoce / Distribution</option>
                                                                <option value="Édition / Communication / Multimédia">Édition / Communication / Multimédia</option>
                                                                <option value="Études et conseils">Études et conseils</option>
                                                                <option value="Informatique / Télécoms">Informatique / Télécoms</option>
                                                                <option value="Métallurgie / Travail du métal">Métallurgie / Travail du métal</option>
                                                                <option value="Transports / Logistique">Transports / Logistique</option>
                                                                <option value="Services aux entreprises">Services aux entreprises</option>
                                                                <option value="Autres">Autres</option>
                                                            </select>
                                                        </fieldset>
                                                        <div class="form-group">
                                                            <label>*Date de cloture :</label>
                                                            <input name="datedecloture" type="date" class="form-control" value="<?= $entreprise['datedecloture'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>*Numéros de téléphone :</label>
                                                        <input name="telentreprise" type="text" class="form-control" placeholder="Numéros de téléphone de la société" value="<?= $entreprise['telentreprise']; ?>" required data-validation-required-message="Le numéros de la société est obligatoire">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Siteweb de la société :</label>
                                                        <input name="link_website" type="text" class="form-control" placeholder="www.monentreprise.fr" value="<?= $entreprise['link_website']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Email Societe :</label>
                                                            <input name="emailentreprise" type="email" class="form-control" placeholder="E-mail de la societe" value="<?= $entreprise['emailentreprise']; ?>" required data-validation-required-message="L'e-mail de la societe obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Début d'activité :</label>
                                                            <input name="datecreation" type="text" placeholder="jj-mm-aa" class="form-control" value="<?= $entreprise['datecreation']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>IBAN :</label>
                                                        <input name="iban_entreprise" type="text" class="form-control" placeholder="FR-" value="<?= $entreprise['iban_entreprise']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <label>Compléter les Infos Dirigeants</label>&nbsp&nbsp<i class='bx bx-right-arrow-alt'></i>
                                                </div>
                                            </div>
                                        <!-- users edit account form ends -->
                                    </div>
                                    <div class="tab-pane fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                        <!-- users edit Info form start -->
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <h5 class="mb-1"><i class="bx bx-link mr-25"></i>Information dirigeant</h5>
                                                    <div class="form-group">
                                                        <label>Nom :</label>
                                                        <input name="nom_diri" class="form-control" type="text" placeholder="Nom du dirigeant" value="<?= $entreprise['nom_diri']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Prénom :</label>
                                                        <input name="prenom_diri" class="form-control" type="text" placeholder="Prénom du dirigeant" value="<?= $entreprise['prenom_diri']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adresse :</label>
                                                        <input name="adresse_diri" class="form-control" type="text" placeholder="Adresse du dirigeant" value="<?= $entreprise['adresse_diri']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Téléphone :</label>
                                                        <input name="tel_diri" class="form-control" type="text" placeholder="Téléphone du dirigeant" value="<?= $entreprise['tel_diri']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-mail :</label>
                                                        <input name="email_diri" class="form-control" type="text" placeholder="E-mail du dirigeant" value="<?= $entreprise['email_diri']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-1 mt-sm-0">

                                                                    <!-- PUBLICITER -->
                                                    
                                                </div>
                                                <input name="numentreprise" type="hidden" value="<?= $entreprise['id'] ?>">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
                                                </div>
                                                <label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
                                            </div>
                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
            </div>
        </div>
    </div>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/jkanban/jkanban.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <script src="../../../app-assets/js/scripts/navs/navs.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>