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

    $pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStt->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoStt->execute();
    $entreprisee = $pdoStt->fetch();

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
    <title>Profile</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-user-profile.css">
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
                <!-- page user profile start -->
                <section class="page-user-profile">
                    <div class="row">
                        <div class="col-12">
                            <!-- user profile heading section start -->
                            <div class="card">
                                <div class="card-content">
                                    <div class="user-profile-images">
                                        <!-- user timeline image -->
                                        <img src="../../../app-assets/images/profile/post-media/profile-banner.jpg" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                                    </div>
                                    <div class="user-profile-text">
                                        <h4 class="mb-0 text-bold-500 profile-text-color"><?= $entreprise['nameentreprise'] ?></h4>
                                        <small>Entreprise</small>
                                    </div>
                                    <!-- user profile nav tabs start -->
                                    <div class="card-body px-0">
                                        <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                            <li class="nav-item pb-0">
                                                <a class=" nav-link d-flex px-1 active" id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="true"><i class="bx bx-home"></i><span class="d-none d-md-block">Profile</span></a>
                                            </li>
                                            <li class="nav-item pb-0">
                                                <a class="nav-link d-flex px-1" href="page-users-edit.php"><i class="bx bx-user"></i><span class="d-none d-md-block">Editer</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- user profile nav tabs ends -->
                                </div>
                            </div>
                            <!-- user profile heading section ends -->

                            <!-- user profile content section start -->
                            <div class="row">
                                <!-- user profile nav tabs content start -->
                                <div class="col-lg-9">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="feed" aria-labelledby="feed-tab" role="tabpanel">
                                            <!-- user profile nav tabs feed start -->
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    
                                                    <!-- user profile nav tabs feed middle section story swiper ends -->
                                                    <!-- user profile nav tabs feed middle section user-2 card starts -->
                                                    
                                                    <!-- user profile nav tabs feed middle section user-2 card ends -->
                                                    <!-- user profile nav tabs feed middle section user-3 card starts -->
                                                    
                                                    <!-- user profile nav tabs feed middle section user-3 card ends -->
                                                    <!-- user profile nav tabs feed middle section user-4 card starts -->
                                                    
                                                    <!-- user profile nav tabs feed middle section user-4 card ends -->
                                                </div>
                                                <!-- user profile nav tabs feed middle section ends -->
                                            </div>
                                            <!-- user profile nav tabs feed ends -->
                                        </div>
                                        <div class="tab-pane " id="activity" aria-labelledby="activity-tab" role="tabpanel">
                                            <!-- user profile nav tabs activity start -->
                                            
                                            <!-- user profile nav tabs activity start -->
                                        </div>

                                        </div>
                                        <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                            <!-- user profile nav tabs profile start -->
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-3 text-center mb-1 mb-sm-0">
                                                                        <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" class="rounded" alt="group image" height="120" width="120" />
                                                                    </div>
                                                                    <div class="col-12 col-sm-9">
                                                                        <div class="row">
                                                                            <div class="col-12 text-center text-sm-left">
                                                                                <h6 class="media-heading mb-0"><?= $entreprise['nameentreprise'] ?><i class="cursor-pointer bx bxs-star text-warning ml-50 align-middle"></i></h6>
                                                                            </div>
                                                                            <div class="col-12 text-center text-sm-left">
                                                                                <div class="mb-1">
                                                                                </div>
                                                                                <p><?= $entreprise['descr_entreprise'] ?></p>
                                                                                <a href="page-users-edit.php"><button class="btn btn-sm d-none d-sm-block float-right btn-light-primary">
                                                                                    <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>Editer</span>
                                                                                </button></a>
                                                                                <a href="page-users-edit.php"><button class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary"></a>
                                                                                    <i class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>Editer</span></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Détails</h5>
                                                        <ul class="list-unstyled">
                                                            <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i><?= $entreprise['pays_entreprise'] ?></li>
                                                            <li><i class="cursor-pointer bx bx-phone-call mb-1 mr-50"></i><?= $entreprise['telentreprise'] ?></li>
                                                            <li><i class="cursor-pointer bx bx-time mb-1 mr-50"></i>Date de création : <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($entreprisee['datecreation']));?></li>
                                                            <li><i class="cursor-pointer bx bx-envelope mb-1 mr-50"></i><?= $entreprise['emailentreprise'] ?></li>
                                                        </ul>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6><small class="text-muted">Téléphone</small></h6>
                                                                <p><?= $entreprise['telentreprise'] ?></p>
                                                            </div>
                                                            <div class="col-12">
                                                                <h6><small class="text-muted">Nom entreprise</small></h6>
                                                                <p><?= $entreprise['nameentreprise'] ?></p>
                                                            </div>                                                            
                                                        </div>
                                                        <a href="page-users-edit.php"><button class="btn btn-sm d-none d-sm-block float-right btn-light-primary mb-2">
                                                            <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>Edier</span>
                                                        </button></a>
                                                        <a href="page-users-edit.php"><button class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary">
                                                            <i class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>Editer</span></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- user profile nav tabs profile ends -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                </div>
                                <!-- user profile right side content ends -->
                            </div>
                            <!-- user profile content section start -->
                        </div>
                    </div>
                </section>
                <!-- page user profile ends -->

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
    <script src="../../../app-assets/js/scripts/pages/page-user-profile.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>