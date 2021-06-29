<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id=:num');
    $pdoSta->bindValue(':num', $_GET['num']);
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdoSta = $bdd->prepare('SELECT * FROM bulletin_salaire WHERE id_session=:num AND statut_bulletin="En cours"');
    $pdoSta->bindValue(':num', $_GET['num']);
    $pdoSta->execute();
    $bulletin_wait = $pdoSta->fetchAll();
    $count_wait = count($bulletin_wait);

    $pdoSta = $bdd->prepare('SELECT * FROM bulletin_salaire WHERE id_session=:num AND statut_bulletin="Terminée"');
    $pdoSta->bindValue(':num', $_GET['num']);
    $pdoSta->execute();
    $bulletin_valid = $pdoSta->fetchAll();
    $count_valid = count($bulletin_valid);

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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .icon{color: #727E8C;}
    .icon:hover{color: #00fbff; opacity: 0.5; cursor: pointer;}
    .none-validation{display: none;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #3c91d5;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name" style='color: white;'>Coqpix</span><span class="user-status" style='color: white;'>En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen" style='color: white;'></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_backend.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="form-group">
                    <h4>Demande bulletins de salaire <?= $entreprise['nameentreprise'] ?></h4>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group <?php if($count_wait !== 0){echo "none-validation";} ?>">
                    <p>Aucune demande de bulletins de salaire ...</p>
                </div>
                <div class="form-group">
                    <?php foreach($bulletin_wait as $bulletin_waits): ?>
                        <div class="card bg-transparent col-6" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid <?php if($bulletin_waits['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_waits['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;" >
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-group">
                                        <h5>Bulletin de salaire de (<?= $bulletin_waits['name_membre'] ?>)</h5>
                                        <p>Demander le <?= $bulletin_waits['date_demande'] ?></p>
                                        <label>Statut de votre demande : </label>&nbsp<p style="display: inline; color: <?php if($bulletin_waits['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_waits['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;"><?= $bulletin_waits['statut_bulletin'] ?></p>
                                    </div>
                                    <div class="row">
                                        <div class="row <?php if($bulletin_waits['statut_bulletin'] == "Terminée"){echo "none-validation";} ?>">
                                            <div class="col">
                                                <a href="salaire-upload.php?document=Bulletin de <?= $bulletin_waits['name_membre'] ?>&num=<?= $entreprise['id'] ?>&id=<?= $bulletin_waits['id'] ?>"><button class="btn btn-outline-<?php if($bulletin_waits['statut_bulletin'] == "En cours"){echo "warning";}else{echo "success";} ?> mr-1 mb-1">Upload l'attestation</button></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <a href="pdf.php?document=<?= $bulletin_waits['name_membre'] ?>" onclick="window.open(this.href); return false;"><button class="btn btn-outline-success mr-1 mb-1">Télécharger le bulletin</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;  ?>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <h4>Bulletin(s) de salaire de <?= $entreprise['nameentreprise'] ?></h4>
                </div>
                <div class="form-group <?php if($count_valid !== 0){echo "none-validation";} ?>">
                    <p>Aucune attestation ...</p>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <?php foreach($bulletin_valid as $bulletin_valids): ?>
                            <div class="card bg-transparent col-6" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid <?php if($bulletin_valids['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_valids['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;" >
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-group">
                                        <h5>Bulletin de salaire de (<?= $bulletin_valids['name_membre'] ?>)</h5>
                                        <p>Demander le <?= $bulletin_valids['date_demande'] ?></p>
                                        <p>Donner le <?= $bulletin_valids['date_donner'] ?></p>
                                        <label>Statut de votre demande : </label>&nbsp<p style="display: inline; color: <?php if($bulletin_valids['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_valids['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;"><?= $bulletin_valids['statut_bulletin'] ?></p>
                                    </div>
                                    <div class="row <?php if($bulletin_valids['statut_bulletin'] == "En cours"){echo "none-validation";} ?>">
                                        <div class="col">
                                            <a href="../../../src/bulletin_salaire/<?= $bulletin_valids['files_bulletin'] ?>" style="display: inline;" target="_blank"><i class='bx bx-show-alt icon_action'></i></a>&nbsp&nbsp&nbsp<a href="../../../src/bulletin_salaire/<?= $bulletin_valids['files_bulletin'] ?>" style="display: inline;" download><i class='bx bxs-download icon_action' download></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;  ?>
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
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>