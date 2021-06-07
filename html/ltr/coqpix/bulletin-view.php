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

    $pdoStat = $bdd->prepare('SELECT * FROM attestation_fiscale WHERE id_session = :num');
    $pdoStat->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $attestation = $pdoStat->fetchAll();
    $count_attestation = count($attestation);

    if($entreprise['descr_entreprise'] == "Agroalimentaire"){
        $secteur = "Agricole";
    }elseif($entreprise['descr_entreprise'] == "Électronique / Électricité" || $entreprise['descr_entreprise'] == "BTP / Matériaux de construction"){
        $secteur = "BTP";
    }elseif($entreprise['descr_entreprise'] == "Bois / Papier / Carton / Imprimerie" || $entreprise['descr_entreprise'] == "Chimie / Parachimie" || $entreprise['descr_entreprise'] == "Industrie pharmaceutique" || $entreprise['descr_entreprise'] == "Machines et équipements / Automobile" || $entreprise['descr_entreprise'] == "Textile / Habillement / Chaussure" || $entreprise['descr_entreprise'] == "Banque / Assurance" || $entreprise['descr_entreprise'] == "Commerce / Négoce / Distribution" || $entreprise['descr_entreprise'] == "Édition / Communication / Multimédia" || $entreprise['descr_entreprise'] == "Études et conseils" || $entreprise['descr_entreprise'] == "Informatique / Télécoms" || $entreprise['descr_entreprise'] == "Métallurgie / Travail du métal" || $entreprise['descr_entreprise'] == "Métallurgie / Travail du métal" || $entreprise['descr_entreprise'] == "Transports / Logistique" || $entreprise['descr_entreprise'] == "Services aux entreprises"){
        $secteur = "Général";
    }

    if($secteur == ""){$secteur = "SECTEUR NON DEFINI / DEFINIR DANS LES PARAMETRES PROFILS";}
    

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
    <title>Bulletin de salaire</title>
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
    .icon_plus{cursor: pointer; font-size: 30px; color: #07ff84;}
    .icon_minius{cursor: pointer; font-size: 30px; color: #ff0000;}
    .icon_plus:hover{opacity: 0.5;}
    .icon_minius:hover{opacity: 0.5;}
    .icon_action{color: grey; cursor: pointer;}
    .icon_action:hover{color: blue; opacity: 0.9;}
</style>
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
        <div class="content-wrapper">
            <div class="content-body">
                <div class="form-group">
                    <h5>Demande de bulletins de salaires</h5>
                </div>
                <div class="form-group <?php if(empty($_GET['req'])){echo "none-validation";} ?>">
                    <div class="alert border-danger alert-dismissible col-6" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="d-flex align-items-center">
                            <i class="bx bx-error"></i>
                            <span>
                                Erreur ! Vous n'avez pas selectionné de type d'activité ;'(
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <br class="<?php if(!empty($_GET['req'])){echo "none-validation";} ?>">
                    <h6>Etape 1 - Selectionnez votre secteur d'activité</h6>
                </div>
                <div class="form-group">
                    <label>Type de secteur d'activité :</label><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label>- Géneral (Métiers dans le milieu général)</label><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label>- BTP (Métiers dans le milieu du bâtiment exemple : Chef de chantier, Électricien(ne), Conducteur(trice) d'engins de chantier.)</label><br>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label>- Agricole (Métiers dans le milieu agricole exemple : Agriculteur, Bucheron etc ...)</label>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <span>D'après PIX votre secteur d'activité est <?= $entreprise['descr_entreprise'] ?></span>&nbsp&nbsp
                    <small>(Si PIX a faux sur le sujet vous pouvez toujours le modifier dans les paramètres profil <a href="page-users-edit.php">&nbsp&nbsp&nbsp<i class='bx bx-edit' style='position: relative; top: 7px; color: green; font-size: 25px; cursor: pointer;'></i></a> )</small>
                </div>
                <div class="form-group">
                    <br>
                </div>
                <div class="form-group text-center">
                    <h6>Le type de secteur d'activité est donc <?= $secteur ?></h6>
                </div>
                <div class="form-group text-center">
                    <p>Etes-vous d'accord du choix de PIX ?</p>
                </div>
                <div class="form-group text-center">
                    <div class="row">
                        <div class="col">
                            <a href="bulletin-two.php?secteur=<?= $secteur ?>"><button id="bt_oui" type='button' class="btn btn-outline-success mr-1 mb-1">Oui 😁</button></a>
                        </div>
                        <div class="col">
                            <button id="bt_no" onclick="no()" type='button' class="btn btn-outline-danger mr-1 mb-1">Non 😈</button>
                        </div>
                    </div>
                </div>
                <div id="div_section" class="form-group text-center none-validation">
                    <form action="bulletin-two.php">
                        <div class="form-group">
                            <p><code>PIX</code> s'excuse énormement 😢</p>
                            <fieldset class="form-group">
                                <select name="secteur" class="form-control" id="basicSelect">
                                    <option value="">Selectionnez un type d'activité</option>
                                    <optgroup></optgroup>
                                    <option class="<?php if($secteur == "Général"){echo "none-validation";} ?>" value="Général">Général</option>
                                    <option class="<?php if($secteur == "BTP"){echo "none-validation";} ?>" value="BTP">BTP</option>
                                    <option class="<?php if($secteur == "Agricole"){echo "none-validation";} ?>" value="Agricole">Agricole</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success glow mr-1 mb-1">Continuer</button>
                        </div>
                    </form>
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
    <!-- END: Page JS-->
    <script>
    
        function no(){
            document.getElementById('bt_no').style.display = "none";
            document.getElementById('bt_oui').style.display = "none";
            document.getElementById('div_section').style.display = "block";
        }

    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>