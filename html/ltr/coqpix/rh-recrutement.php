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
    <title>RH - Recrutement</title>
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

    <!-- BEGIN: Header-->
    <?php $btnreturn = true;
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
                <div class="alert bg-rgba-primary">
                    <i class="bx bx-info-circle mr-1 align-middle"></i>
                    <span class="align-middle">
                        Votre espace RH bientot disponible en totalité
                    </span>
                </div>

                <!-- Groups section start -->
                <section id="groups">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card-group">
                                <div onclick="tprecrutement()" class="card">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="../../../app-assets/images/pages/content-img-3.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="">e-Recrutement</h4>
                                            <p class="card-text">
                                                Créer vos annonces de recrutement etc...</p>
                                        </div>
                                    </div>
                                </div>
                                <script>

                                function tprecrutement(){
                                    document.location.href="rh-recrutement-new.php"; 
                                }

                                </script>
                                <div class="card" onclick="tprecrutement_two()">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="../../../app-assets/images/pages/content-img-4.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Espace candidature</h4>
                                            <p class="card-text">
                                                Consultation des réponses à vos annonces et CVThèque.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <script>

                                function tprecrutement_two(){
                                    document.location.href="rh-recrutement-list.php"; 
                                }

                                </script>
                                <div class="card">
                                    <div class="card-content" onclick="tprecrutement_entretient()">
                                        <img class="card-img-top img-fluid" src="../../../app-assets/images/pages/content-img-1.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Entretient</h4>
                                            <p class="card-text">
                                                vos options dans la création d'annonce d'entretient, avec un accompagnement de qualité
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <script>

                                function tprecrutement_entretient(){
                                    document.location.href="rh-recrutement-entretient.php"; 
                                }

                                </script>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Groups section end -->
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