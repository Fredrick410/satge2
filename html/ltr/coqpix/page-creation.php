<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea'], PDO::PARAM_INT);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

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
    <title>Mon espace</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/swiper.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/faq.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
.none-validation{display: none;}
.block-validation{display: block;}
.red{color: red;}
</style>

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-secondary navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="#">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name"><?= $crea['name_crea'] ?></span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="form-group">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
                <!-- faq start -->
                <section class="faq">
                    <div class="row">
                        <div class="col-12">
                            <!-- swiper start -->
                            <div class="card bg-transparent shadow-none">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="swiper-centered-slides swiper-container p-1">
                                            <div class="swiper-wrapper">
                                                <?php
                                                if($crea['status_crea'] == "EURL"){
                                                            $linkview = "morale";
                                                    }else{        
                                                        if($crea['status_crea'] == "SARL"){
                                                            $linkview = "morale";
                                                        }else{
                                                            if($crea['status_crea'] == "SAS"){
                                                                $linkview = "morale";
                                                            }else{
                                                                if($crea['status_crea'] == "SASU"){
                                                                    $linkview = "morale";
                                                                }else{
                                                                    if($crea['status_crea'] == "SCI"){
                                                                        $linkview = "morale";
                                                                    }else{
                                                                        if($crea['status_crea'] == "EIRL"){
                                                                            $linkview = "physique";
                                                                        }else{
                                                                            if($crea['status_crea'] == "Micro-entreprise"){
                                                                                $linkview = "physique";
                                                                            }else{
                                                                                $linkview = "physique";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                if($crea['status_crea'] == ""){
                                                    $noneform = "none-validation";
                                                }else{
                                                    $noneform = "block-validation";
                                                }
                                                ?>
                                                 <div class="swiper-slide rounded swiper-shadow <?php echo $noneform; ?>" id="getting-text"><a href="domiciliation.php"><i class="bx bx-home mb-1 font-large-1"></a></i>
                                                <a href="domiciliation.php"><div class="cent-text1">Se Domicilier</div></a>
                                                </div>
                                                <div class="swiper-slide rounded swiper-shadow <?php echo $noneform; ?>" id="getting-text"><a href="creation-view-<?php echo $linkview; ?>-pieceid.php"><i class="bx bx-notepad mb-1 font-large-1"></a></i>
                                                <a href="creation-view-<?php echo $linkview; ?>-pieceid.php"><div class="cent-text1">Document</div></a>
                                                </div>
                                                <div class="swiper-slide rounded swiper-shadow" id="pricing-text"> <a href="page-creation-edit.php"><i class="bx bxs-user-circle mb-1 font-large-1"></a></i>
                                                    <a href="page-creation-edit.php"><div class="cent-text1">Profil</div></a>
                                                </div>
                                                <?php
                                                    if($crea['notification_crea'] > 0){
                                                        $notification = '('.$crea['notification_crea'].')'; 
                                                    }else{
                                                        $notification = ""; 
                                                    }
                                                ?>
                                                <div class="swiper-slide rounded swiper-shadow" id="sales-text"> <a href="page-creation-chat.php"><i class="bx bx-chat mb-1 font-large-1"></a></i>
                                                    <a href="page-creation-chat.php"><div class="cent-text1">Chat&nbsp&nbsp<small class="red"><?php echo $notification; ?></small></div></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- swiper ends -->
                        </div>
                    </div>
                </section>
                <!-- faq ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/faq.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>