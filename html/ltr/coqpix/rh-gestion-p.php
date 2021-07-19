<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id_session']);
$pdoS->execute();
$entreprise = $pdoS->fetch();

$pdoS = $bdd->prepare('SELECT * FROM mission WHERE id = :num');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$mission = $pdoS->fetchAll();

?>

<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Mission</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout 2-columns  navbar-sticky footer-static menu-collapsed " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout">
    <style>
        .none-validation {
            display: none;
        }
    </style>
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
            <div class="form-group">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-pill">
                        <li class="breadcrumb-item"><a href="rh-home.php"><i class="bx bx-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="rh-gestion-membre.php">Membres</a></li>
                        <li class="breadcrumb-item active" style="cursor: pointer;">Profil - Haddou Youness</li>
                    </ol>
                </nav>
            </div>
            <div class="form-group">
                <br>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-8 border-right">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="avatar mr-1 avatar-xl d-inline">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-20.jpg" alt="error img">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <h5> Mélanie</h5>
                                        <div class="row">
                                            <div class="col">
                                                <label>Société:</label><br>
                                                Audit action plus
                                            </div>
                                            <div class="col">
                                                <label>Matricule:</label><br>
                                                XXX
                                            </div>
                                            <div class="col">
                                                <label>Afficher la photo:</label><br>
                                                Oui
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col border-right" style='padding-left: 50px;'> 
                                <h5 style='height: 20px;'></h5>
                                <div class="row">
                                    <div class="col">
                                        <label>Société:</label><br>
                                        Audit action plus
                                    </div>
                                    <div class="col">
                                        <label>Matricul:</label><br>
                                        XXX
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="badge badge-pill badge-glow badge-primary mr-1 mb-1">
                            <div style='position: relative; top: 3%;'>
                                <i class="bx bx-edit"></i><p>Modifier la fiche employé</p>
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
    
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>