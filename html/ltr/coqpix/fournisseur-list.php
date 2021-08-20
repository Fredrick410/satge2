<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/permissions_front.php';

    if (permissions()['fournisseurs'] < 1) {
        header('Location: dashboard-analytics.php');
        exit();
    }

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM fournisseur WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']);
    $pdoSt->execute();
    $fournisseur = $pdoSt->fetchAll();

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
    <title>Listes fournisseur</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
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
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <?php // Permission de niveau 2 pour ajouter un fournisseur
                    if (permissions()['fournisseurs'] >= 2) { ?>
                        <div class="users-list-filter px-1 mt-2">
                            <form>
                                <div class="row rounded">
                                    <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                        <a href="fournisseur-add.php" class=""><button type="button" class="btn btn-primary btn-block glow users-list-clear mb-0">Ajouter un fournisseur</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                    <div class="users-list-table mt-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Société</th>
                                                    <th>nom</th>
                                                    <th>email</th>
                                                    <th>téléphone</th>
                                                    <th>secteur</th>
                                                    <?php // Permission de niveau 2 pour modifier ou supprimer un fournisseur
                                                    if (permissions()['fournisseurs'] >= 2) { ?>
                                                        <th>Options</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($fournisseur as $fournisseurr): ?>
                                                <tr>
                                                    <td><a class="mr-2" href="#">
                                                <img src="../../../src/img/astro2.gif" alt="users avatar" class="users-avatar-shadow rounded-circle" height="60" width="80">
                                            </a></td>
                                                    <td><a><?= $fournisseurr['name_fournisseur'] ?></a>
                                                    </td>
                                                    <td><?= $fournisseurr['nom'] ?></td>
                                                    <td><?= $fournisseurr['email'] ?></td>
                                                    <td><?= $fournisseurr['tel'] ?></td>
                                                    <td><?= $fournisseurr['secteur'] ?></td>
                                                    <?php // Permission de niveau 2 pour modifier ou supprimer un fournisseur
                                                    if (permissions()['fournisseurs'] >= 2) { ?>
                                                        <td>
                                                            <?php // Permission de niveau 2 pour modifier un fournisseur
                                                            if (permissions()['fournisseurs'] >= 2) { ?>
                                                                <a href="fournisseur-edit.php?numfour=<?= $fournisseurr['id'] ?>"><i class="bx bx-edit-alt"></i></a>
                                                            <?php } // Permission de niveau 3 pour supprimer un fournisseur
                                                            if (permissions()['fournisseurs'] >= 3) { ?>
                                                                <a href="php/delete_fournisseur.php?num=<?= $fournisseurr['id'] ?>"><i class="bx bx-trash-alt"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>       
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-light.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>