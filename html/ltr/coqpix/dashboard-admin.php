<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

$pdoSta = $bdd->prepare('SELECT * FROM entreprise');
$vrai = $pdoSta->execute();
$entreprise = $pdoSta->fetchAll();

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
    <title>Dashboard - Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="main.js"></script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-primary navbar-brand-center">
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

    <?php include('php/menu_backend.php'); ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- invoice list -->
                <section class="invoice-list-wrapper">
                    <!-- create invoice button-->
                    <div class="invoice-create-btn mb-1">
                        <a href="backend/add-users.php" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true"><i class='bx bx-plus-medical'></i>&nbsp&nbsp&nbsp&nbspAjouter une société</a>
                    </div>
                    <!-- Options and filter dropdown button-->
                    <div class="action-dropdown-btn d-none">
                        <div class="dropdown invoice-filter-action">

                        </div>
                        <div class="dropdown invoice-options">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <span class="align-middle">NOM SOCiété</span>
                                    </th>
                                    <th>Téléphone</th>
                                    <th>Date créaction</th>
                                    <th>E-mail</th>
                                    <th>Nom</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($entreprise as $entreprisee) : ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#"><?= $entreprisee['nameentreprise'] ?></a>
                                        </td>
                                        <td><span class="invoice-amount"><?= $entreprisee['telentreprise'] ?></span></td>
                                        <td><?php setlocale(LC_TIME, "fr_FR");
                                            echo strftime("%d-%m-%G", strtotime($entreprisee['datecreation'])); ?></small></td>
                                        <td><span class="invoice-customer"><?= $entreprisee['emailentreprise'] ?></span></td>
                                        <td><span class="invoice-customer"><?= $entreprisee['nom_diri'] ?></span></td>
                                        <td><span class="<?= $entreprisee['color'] ?>"><?= $entreprisee['new_user'] ?></span></td>
                                        <td>
                                            <div class="invoice-action">
                                                <a href="backend/edit-societe.php?num=<?= $entreprisee['id'] ?>" class="invoice-action-edit cursor-pointer">
                                                    <i class="bx bx-edit"></i>
                                                </a>&nbsp&nbsp&nbsp&nbsp
                                                <?php if ($entreprisee['new_user'] == "New") {
                                                    echo '<a href="php/change_desactiver.php?id=' . $entreprisee["id"] . '&new_user=Désactivé"class="invoice-action-edit cursor-pointer"><i class="bx bx-fast-forward"></i></a>';
                                                }

                                                if ($entreprisee['new_user'] == "Désactivé") {
                                                    echo '<a href="php/change_new.php?id=' . $entreprisee["id"] . '&new_user=New"class="invoice-action-edit cursor-pointer"><i class="bx bx-reset"></i></a>';
                                                }

                                                if ($entreprisee['new_user'] == "Activé") {
                                                    echo '<a href="php/change_bloquer.php?id=' . $entreprisee["id"] . '&new_user=Bloqué"class="invoice-action-edit cursor-pointer"><i class="bx bx-block"></i></a>';
                                                }

                                                if ($entreprisee['new_user'] == "Bloqué") {
                                                    echo '<a href="php/change_activer.php?id=' . $entreprisee["id"] . '&new_user=Activé"class="invoice-action-edit cursor-pointer"><i class="bx bx-check-circle"></i></a>&nbsp ou &nbsp<a href="php/change_supprimer.php?id=' . $entreprisee["id"] . '&new_user=Supprimé" class="invoice-action-edit cursor-pointer"><i class="bx bxs-trash-alt"></i></a>';
                                                }

                                                if ($entreprisee['new_user'] == "Supprimé") {
                                                    echo '<a href="php/delete_societe.php?id=' . $entreprisee["id"] . '"class="invoice-action-edit cursor-pointer"><i class="bx bxs-x-circle"></i></a>&nbsp ou &nbsp<a href="php/change_activer.php?id=' . $entreprisee["id"] . '&new_user=Activé"class="invoice-action-edit cursor-pointer"><i class="bx bx-add-to-queue"></i></a>';
                                                }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark">
    </footer>
    <!-- END: Footer-->


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
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>