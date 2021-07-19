<?php 
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();

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
    <title>Ressource Humaine</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-knowledge-base.css">
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
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Knowledge base start -->
                <section class="kb-content">
                    <div class="form-group text-center">
                        <h5>Votre SIRH (Système d'information de gestion des ressources humaines)</h5>
                    </div>
                    <div class="form-group">
                        <br>
                        <hr>
                    </div>
                    <div class="row kb-search-content-info mx-1 mx-md-2 mx-lg-5">
                        <div class="col-12">
                            <div class="row match-height">
                                <div class="col-md-4 col-sm-6 kb-search-content">
                                    <div class="card kb-hover-1">
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <a href="rh-recrutement.php">
                                                    <div class=" mb-1">
                                                        <i class="livicon-evo" data-options="name: users.svg; size: 50px; strokeColorAlt: #FDAC41; strokeColor: #5A8DEE; style: lines-alt; eventOn: .kb-hover-1;"></i>
                                                    </div>
                                                    <h5>E-Recrutement</h5>
                                                    <p class=" text-muted">Créer des annonces de recrutements et tester vos candidats ...</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 kb-search-content">
                                    <div class="card kb-hover-2">
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <a href="rh-gestion-p.php">
                                                    <div class=" mb-1">
                                                        <i class="livicon-evo" data-options="name: diagram.svg; size: 50px; strokeColorAlt: #FDAC41; strokeColor: #5A8DEE; style: lines-alt; eventOn: .kb-hover-2;"></i>
                                                    </div>
                                                    <h5>Gestion du personnel</h5>
                                                    <p class=" text-muted">Gestions des salariés et de leur compétence ...</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 kb-search-content">
                                    <div class="card kb-hover-3">
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <a href="#">
                                                    <div class=" mb-1">
                                                        <i class="livicon-evo" data-options="name: swap-horizontal.svg; size: 50px; strokeColorAlt: #FDAC41; strokeColor: #5A8DEE; style: lines-alt; eventOn: .kb-hover-3;"></i>
                                                    </div>
                                                    <h5>Stage</h5>
                                                    <p class=" text-muted">Gérer les rendez-vous de vos stagiaires ...</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 kb-search-content">
                                    <div class="card kb-hover-4">
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <a href="#">
                                                    <div class=" mb-1">
                                                        <i class="livicon-evo" data-options="name: paper-plane.svg; size: 50px; strokeColorAlt: #FDAC41; strokeColor: #5A8DEE; style: lines-alt; eventOn: .kb-hover-4;"></i>
                                                    </div>
                                                    <h5>La gestion des compétences</h5>
                                                    <p class="text-muted">Gestions des compétences et des emplois au seins de votre entreprise</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 kb-search-content">
                                    <div class="card kb-hover-5">
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <a href="#">
                                                    <div class=" mb-1">
                                                        <i class="livicon-evo" data-options="name: smartphone.svg; size: 50px; strokeColorAlt: #FDAC41; strokeColor: #5A8DEE; style: lines-alt; eventOn: .kb-hover-5;"></i>
                                                    </div>
                                                    <h5>Formations</h5>
                                                    <p class=" text-muted">Gestions des formations dans votre entreprise ...</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 kb-search-content">
                                    <div class="card kb-hover-6">
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <a href="#">
                                                    <div class=" mb-1">
                                                        <i class="livicon-evo" data-options="name: desktop.svg; size: 50px; strokeColorAlt: #FDAC41; strokeColor: #5A8DEE; style: lines-alt; eventOn: .kb-hover-6;"></i>
                                                    </div>
                                                    <h5>Evaluation des performances</h5>
                                                    <p class=" text-muted">Evalutions des employés et employeur ...</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <br>
                        <br>
                    </div>
                    <div class="form-group text-center">
                        <img src="../../../src/img/banner-rh2.gif" class="img-fluid" alt="Responsive image">
                    </div>
                </section>
                <!-- Knowledge base ends -->
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
    <script src="../../../app-assets/js/scripts/pages/page-knowledge-base.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>