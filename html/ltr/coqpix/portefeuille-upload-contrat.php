<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
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
    <title>Portefeuille - upload</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .none-validation{display: none;};

	/* Code By Webdevtrick ( https://webdevtrick.com ) */
    .container {
    padding: 50px 10%;
    }
    
    .box {
    position: relative;
    background: #ffffff;
    width: 100%;
    }
    
    .box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
    border-bottom: 1px solid #f4f4f4;
    margin-bottom: 10px;
    }
    
    .box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
    }
    
    .dropzone-wrapper {
    border: 2px dashed #91b0b3;
    color: #92b0b3;
    position: relative;
    height: 350px;
    }
    
    .dropzone-desc {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    text-align: center;
    width: 40%;
    top: 50px;
    font-size: 16px;
    }
    
    .dropzone,
    .dropzone:focus {
    position: absolute;
    outline: none !important;
    width: 100%;
    height: 350px;
    cursor: pointer;
    opacity: 0;
    }

    .gifimg{
        position: relative;
        top: -20px;
        z-index: 1;
    }
    
    .dropzone-wrapper:hover,
    .dropzone-wrapper.dragover {
    background: #ecf0f5;
    z-index: 10;
    }
    
    .preview-zone {
    text-align: center;
    }
    
    .preview-zone .box {
    box-shadow: none;
    border-radius: 0;
    margin-bottom: 0;
    }
    
    .btn-primary {
    background-color: crimson;
    border: 1px solid #212121;
    }

    .btn-yellow {
    background-color: #f3e53c;
    border: 1px solid #C7CF00;
    border-radius: 5px;
    }
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #f3e53c;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix2.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php /*include('php/menu_backend.php');*/ ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content" style="background-color: ;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="col-lg-12">
                <div class="form-group">
                    <a href="portefeuille.php" type="button" class="btn btn-icon btn-light-danger mr-1 mb-1"><i class='bx bx-arrow-back'></i></a>
                </div>
                <div class="row">
                    <div class="col" style="border-right: 1px solid grey;">
                        <h5 class="m-1" style="font-weight: bold;">Ajouter le prix au contrat</h5>
                        <div class="form-group" style="width: 300px; margin: 50px auto; text-align: center;">
                            <h6 style="font-weight: bold;">Prix du contrat:</h6><br>
                            <form action="generate-pdf-3.php" method="POST">
                                <input type="text" name="prix" class="w-100 mb-1" style="text-align: center;" placeholder="saisir un prix" required><br>
                                <input type="text" name="id_crea" class="" value="<?= $_GET['num']; ?>" hidden>
                                <button type="submit" class="btn-yellow my-1 mx-auto w-75">Valider le prix</button>
                            </form>
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="m-1" style="font-weight: bold;">Contrat de prestations de service</h5>
                        <embed src=../../../src/crea_societe/contrat/<?= $crea['doc_contrat'] ?> width="100%" height="600px" type='application/pdf'/>
                    </div>
                </div>
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>