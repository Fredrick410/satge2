<?php 
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStt->bindValue(':numentreprise',$_SESSION['id_session']);
    $pdoStt->execute();
    $entreprise = $pdoStt->fetch();

    $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE id = :num');
    $pdoStt->bindValue(':num' ,$_GET['num']);
    $pdoStt->execute();
    $candidature = $pdoStt->fetch();
    $pourc = "0";

    //progression 3 PART 33 par partie

        //profile part /4 = 8,25
            if($candidature['nom_candidat'] !== ""){
                $pourc = $pourc + 8.333;
            }   
            if($candidature['prenom_candidat'] !== ""){
                $pourc = $pourc + 8.333;
            }   
            if($candidature['age_candidat'] !== ""){
                $pourc = $pourc + 8.333;
            }   
            if($candidature['formationetude'] !== ""){
                $pourc = $pourc + 8.333;
            }   
        
        //Niveau /6 = 5.5556

            if($candidature['logiciel'] !== ""){
                $pourc = $pourc + 5.556;
            }   
            if($candidature['langue'] !== ""){
                $pourc = $pourc + 5.556;
            }   
            if($candidature['formationetude'] !== ""){
                $pourc = $pourc + 5.556;
            }   
            if($candidature['interet'] !== ""){
                $pourc = $pourc + 5.556;
            }  
            if($candidature['qualite'] !== ""){
                $pourc = $pourc + 5.556;
            }   
            if($candidature['default_candi'] !== ""){
                $pourc = $pourc + 5.556;
            }
        
        //document /2 = 16.6667
             if($candidature['cv_doc'] !== ""){
                $pourc = $pourc + 16.6667;
            }   
            if($candidature['lettredemotivation_doc'] !== ""){
                $pourc = $pourc + 16.6667;
            }   

        if($pourc > 100){
            $pourc = "100";
        }

        $pourc = substr($pourc, 0, 5);


    
    if ($pourc > "0" && $pourc < "33.3333333333") {$pourc_color = "danger";   }if ($pourc > "30" && $pourc < "66.6666666666") {$pourc_color = "warning";}if ($pourc > "66.6666666666" && $pourc <= "100") {$pourc_color = "success";}
    
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
    <title>Recrutement</title>
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
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
                        </ul>
                        <script>
                            function retourn() {
                                window.history.back();
                            }
                        </script>
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
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprisee['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
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
            <div class="content-body">                
                <!-- Progress Sizes start -->
                <section id="progress-sizes">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5 class="">Progression du candidat - <?= $pourc ?>%</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="progress progress-bar-<?= $pourc_color ?> mb-1 progress-sm">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="80" aria-valuemax="100" style="width:<?= $pourc ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Progress Sizes end -->
                <!-- List group navigation start -->
                <section class="list-group-navigation">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Candidature N°<?= $candidature['num_candidat'] ?> - <?php if($candidature['sexe_candidat'] == "Homme"){echo "Mr";}else{echo "Mme";} ?> HADDOU - <?= $candidature['name_annonce'] ?></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 ">
                                                <div class="list-group" role="tablist">
                                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Profiles</a>
                                                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Niveaux</a>
                                                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Documents</a>
                                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Options (SOON)</a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-8 mt-1">
                                                <div class="tab-content text-justify" id="nav-tabContent">
                                                    <div class="tab-pane show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group text-center">
                                                                    <label>Description</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Nom : <small><?= $candidature['nom_candidat'] ?></small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Prénom : <small><?= $candidature['prenom_candidat'] ?></small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Age : <small><?= $candidature['age_candidat'] ?> ans</small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <hr>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Spécialitée : <small><?= $candidature['specialite_candidat'] ?></small></span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <img src="../../../src/img/team_img.png" class="rounded" alt="Photo de profile">
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                                        <div class="form-group">
                                                            <span>Logiciels : <small><?= $candidature['logiciel'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Langues : <small><?= $candidature['langue'] ?> </small></span>
                                                        </div> 
                                                        <div class="form-group">
                                                            <span>Formations & Diplomes : <small><?= $candidature['formationetude'] ?> </small></span>
                                                        </div>   
                                                        <div class="form-group">
                                                            <span>Interets : <small><?= $candidature['interet'] ?> </small></span>
                                                        </div>  
                                                        <div class="form-group">
                                                            <span>Mes Qualitées : <small><?= $candidature['qualite'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Mes defaults : <small><?= $candidature['default_candi'] ?> </small></span>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                                                        <div class="row">
                                                            <div class="col text-center <?php if($candidature['cv_doc'] == ""){echo "none-validation";} ?>">
                                                                <label>CV</label>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <i class='bx bxs-file-pdf'></i> <?= $candidature['cv_doc'] ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/cv/<?= $candidature['cv_doc'] ?>"><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-show-alt' style=""></i> Prévisualiser</button></a>
                                                                        </div>
                                                                        <div class="col">   
                                                                            <a href="../../../src/recrutement/cv/<?= $candidature['cv_doc'] ?>" download><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-download' style=""></i> Télécharger</button></a>                                                         
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col text-center <?php if($candidature['lettredemotivation_doc'] == ""){echo "none-validation";} ?>">
                                                                <label>Lettre de motivation</label>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <i class='bx bxs-file-pdf'></i> <?= $candidature['lettredemotivation_doc'] ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/lettredemotivation/<?= $candidature['lettredemotivation_doc'] ?>"><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-show-alt' style=""></i> Prévisualiser</button></a>
                                                                        </div>
                                                                        <div class="col">   
                                                                            <a href="../../../src/recrutement/lettredemotivation/<?= $candidature['lettredemotivation_doc'] ?>" download><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-download' style=""></i> Télécharger</button></a>                                                         
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col text-center <?php if($candidature['other_doc'] == ""){echo "none-validation";} ?>">
                                                                <label>Autre document</label>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <i class='bx bxs-file-pdf'></i> <?= $candidature['other_doc'] ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/other/<?= $candidature['other_doc'] ?>"><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-show-alt' style=""></i> Prévisualiser</button></a>
                                                                        </div>
                                                                        <div class="col">   
                                                                            <a href="../../../src/recrutement/other/<?= $candidature['other_doc'] ?>" download><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-download' style=""></i> Télécharger</button></a>                                                         
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                                                        <div class="form-group">
                                                            <div class="form-group text-center">
                                                                <label>Paramètres et options</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>QCM (<small>Les qcm permettent de tester les candidats dans les domaines suivants</small>): </label>         
                                                            </div>
                                                            <div class="form-group">
                                                                <hr>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>QCM Anglais</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customSwitchcolor1">
                                                                                <label class="custom-control-label" for="customSwitchcolor1"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>QCM Confiance</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customSwitchcolor2">
                                                                                <label class="custom-control-label" for="customSwitchcolor2"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>QCM Intelligence</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customSwitchcolor3">
                                                                                <label class="custom-control-label" for="customSwitchcolor3"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>QCM Psycologique</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customSwitchcolor4">
                                                                                <label class="custom-control-label" for="customSwitchcolor4"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>QCM Physique</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="customSwitchcolor5">
                                                                                <label class="custom-control-label" for="customSwitchcolor5"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- List group navigation ends -->
                <!-- Block level buttons start -->
                <section id="block-level-buttons">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body" style="background-color: none;">
                                        <div class="row">
                                            <div class="col text-center">
                                                <label>RESULTAT DES TESTS (SOON)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Block level buttons end -->
                <!-- Block level buttons start -->
                <section id="block-level-buttons">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body" style="background-color: none;">
                                        <div class="row">
                                            <div class="col">
                                                <a href="php/edit_rh_statut.php?num=<?= $_GET['num'] ?>&type=success"><button type="button" class="btn mb-1 btn-outline-success btn-lg btn-block">Accepter le candidat</button></a>
                                            </div>
                                            <div class="col">
                                                <a href="php/edit_rh_statut.php?num=<?= $_GET['num'] ?>&type=blocked"><button type="button" class="btn mb-1 btn-outline-danger btn-lg btn-block">Resufer le candidat</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Block level buttons end -->
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
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>