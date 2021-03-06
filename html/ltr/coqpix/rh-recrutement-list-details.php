<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE name_annonce=:name_annonce AND id_session = :num ORDER BY id DESC LIMIT 4');
    $pdoS->bindValue(':name_annonce',$_GET['annonce']);
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $candidature_limit = $pdoS->fetchAll();

    $pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE name_annonce=:name_annonce AND id_session = :num');
    $pdoS->bindValue(':name_annonce',$_GET['annonce']);
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $candidature = $pdoS->fetchAll();
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
    <title>RH -Recrutement</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
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
                <!-- table Marketing campaigns start -->
                <section id="table-Marketing">
                    <div class="form-group text-center">
                        <h4>CVThèque</h4>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <!-- table start -->
                            <table id="table-marketing-campaigns" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Nom de l'annonce</th>
                                        <th>Age</th>
                                        <th>Durée</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="group">
                                        <td colspan="6">Aujourd'hui</td>
                                    </tr>
                                    <?php foreach($candidature_limit as $candidatures_limit): ?>
                                        <tr>
                                            <td class="text-bold-600"><img class="rounded-circle mr-1" src="../../../app-assets/images/cards/face-regular-24.png" alt="card"><?= $candidatures_limit['nom_candidat'] ?> <?= $candidatures_limit['prenom_candidat'] ?></td>
                                            <td><?= $candidatures_limit['name_annonce'] ?></td>
                                            <td class="text-bold-600"><span><?= $candidatures_limit['age_candidat'] ?> ans</span>
                                            </td>
                                            <td class="text-bold-600"><?= $candidatures_limit['time_candidat'] ?></td>
                                            <td class="text-success"><?= $candidatures_limit['statut'] ?></td>
                                            <td>
                                                <a class="dropdown-item" href="rh-recrutement-view.php?num=<?= $candidatures_limit['id'] ?>">Voir &nbsp&nbsp&nbsp<i class='bx bx-show-alt' style="position: relative; top: 3px;"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="group">
                                        <td colspan="6">Tous les jours</td>
                                    </tr>
                                    <?php foreach($candidature as $candidatures): ?>
                                        <tr>
                                            <td class="text-bold-600"><img class="rounded-circle mr-1" src="../../../app-assets/images/cards/face-regular-24.png" alt="card"><?= $candidatures['nom_candidat'] ?> <?= $candidatures['prenom_candidat'] ?></td>
                                            <td><?= $candidatures['name_annonce'] ?></td>
                                            <td class="text-bold-600"><span><?= $candidatures['age_candidat'] ?> ans</span>
                                            </td>
                                            <td class="text-bold-600"><?= $candidatures['time_candidat'] ?></td>
                                            <td class="text-success"><?= $candidatures['statut'] ?></td>
                                            <td>
                                                <a class="dropdown-item" href="rh-recrutement-view.php?num=<?= $candidatures['id'] ?>">Voir &nbsp&nbsp&nbsp<i class='bx bx-show-alt' style="position: relative; top: 3px;"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- table ends -->
                        </div>
                    </div>
                </section>
                <!-- table Marketing campaigns ends -->
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
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/table-extended.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>