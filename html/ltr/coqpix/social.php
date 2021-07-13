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

    $pdoStat = $bdd->prepare('SELECT * FROM attestation_sociale WHERE id_session = :num');
    $pdoStat->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $attestation = $pdoStat->fetchAll();
    $count_attestation = count($attestation);

    $pdoStat = $bdd->prepare('SELECT * FROM bulletin_salaire WHERE id_session = :nums');
    $pdoStat->bindValue(':nums',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $bulletin_salaire = $pdoStat->fetchAll();
    $count_bulletin = count($bulletin_salaire);

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
    <title>Mon espace - Social</title>
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
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic card section start -->
                <section id="content-types">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/05.jpg" alt="Card image cap" />
                                    <div class="card-body text-center">
                                        <h4 class="card-title">Déclaration sociale nominative (DSN)</h4>
                                        <p class="card-text">
                                            Dans cet espace dédié vous avez accès à vos DSN, bien pratique !!!<br>
                                            Triées par période et stockées dans votre cloud.
                                        </p>
                                        <a href="dsn-espace.php"><button class="btn btn-primary block">Mon espace</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">Mes charges sociales (URSSAF/MSA)</h4>
                                        <p class="card-text">
                                            Toutes vos déclarations sociales à portée de main.
                                        </p>
                                        <a href="charge-espace.php"><button class="btn btn-primary block">Mes charges sociales</button></a>
                                    </div>
                                    <img class="card-img-bottom img-fluid" src="../../../app-assets/images/slider/06.jpg" alt="Card image cap">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="form-group text-center">
                                    <h5 style='padding-top: 10px;'>Bulletin de salaire</h5>
                                </div>
                                <div class="form-group text-center">
                                    <p style='padding-left: 20px;'>Faire une demande de bulletins de salaire pour l'ensemble des membres de de votre société, la demande sera traitée par nos équipes le plus rapidement possible.</p>
                                    <p style='padding-left: 20px;'>Vous avez ( <label style='color: red;'><?= $count_bulletin ?></label> ) bulletin(s) de salaire(s).</p>
                                    <div class="form-group">
                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="bulletin-choose.php"><button class="btn btn-info mr-1 mb-1">Bulletins de salaire</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="form-group text-center">
                                    <h5 style='padding-top: 10px;'>Attestation</h5>
                                </div>
                                <div class="form-group text-center">
                                    <p style='padding-left: 20px;'>Demander une attestation social sans prise de tete et très rapidement.</p>
                                    <p style='padding-left: 20px;'>Vous avez ( <label style='color: red;'> <?= $count_attestation ?> </label> ) attestation(s).</p>
                                    <div class="form-group">
                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="attestation-social.php"><button class="btn btn-warning mr-1 mb-1">Demander une attestation</button></a>
                                    </div>   
                                </div>
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Card types section end -->
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