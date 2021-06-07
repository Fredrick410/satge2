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

    $pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE id_session = :num ORDER BY id DESC LIMIT 4');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $candidature_limit = $pdoS->fetchAll();

    $pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $candidature = $pdoS->fetchAll();

    $pdoS = $bdd->prepare('SELECT * FROM rh_annonce WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $annonce = $pdoS->fetchAll();
    $count_annonce = count($annonce);
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
<style>
    .none-validation{display: none;}
</style>
    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
                        </ul>
                        <script>
                            function retourn() {
                                window.history.back();
                            }
                        </script>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix"><div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>   <!--NOTIFICATION-->
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">0 Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                                            <!-- CONTENUE ONE -->
                                    </a>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> création du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php') ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Columns section start -->
                <section id="columns">
                    <div class="form-group text-center">
                        <hr>
                        <h4>Mes annonces de recrutement</h4>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <div class="card-columns">
                                <div class="form-group <?php if($count_annonce > 0){echo "none-validation";} ?>">
                                    Aucune annonce de recrutement
                                </div>
                                <?php foreach($annonce as $annonces): ?>
                                <?php
                                
                                    $pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE id_session = :num AND name_annonce=:name_annonce');
                                    $pdoS->bindValue(':num',$_SESSION['id_session']);
                                    $pdoS->bindValue(':name_annonce',$annonces['name_annonce']);
                                    $pdoS->execute();
                                    $candidature_candidature = $pdoS->fetchAll();
                                    $count_candidature = count($candidature_candidature); 

                                ?>
                                    <div class="card text-center bg-transparent" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid <?= $annonces['color_annonce'] ?>;" >
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <h5><?= $annonces['name_annonce'] ?></h5>
                                                </div>
                                                <div class="form-group">
                                                    <span>Nombre de candidature : <?= $count_candidature ?> candidats</span><br>
                                                    <textarea id="to-copy" >www.coqpix.com/html/ltr/coqpix/candidature-recrutement.php?<?= $annonces['link'] ?></textarea>
                                                    <button id="copy" type="button" style="border: none;"><span style="color: <?= $annonces['color_annonce'] ?>; cursor: pointer;">Cliquez pour copier le lien de partage <i class='bx bxs-copy-alt' style="position: relative; top: 2px;"></i></span></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="rh-recrutement-list-details.php?annonce=<?= $annonces['name_annonce'] ?>"><button class="btn mt-50" style="background-color: <?= $annonces['color_annonce'] ?>; color: white;">Voir</button></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="php/change_delete_rh_annonce.php?fonction=change&num=<?= $annonces['id'] ?>&statut=<?php if($annonces['statut'] == "actif"){ echo "actif";}else{echo "pause";} ?>"><button class="btn btn-<?php if($annonces['statut'] == "actif"){ echo "warning";}else{echo "success";} ?> mt-50"><?php if($annonces['statut'] == "actif"){ echo "Pause";}else{echo "Activer";} ?></button></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="php/change_delete_rh_annonce.php?num=<?= $annonces['id'] ?>&fonction=delete"><button class="btn mt-50" style="background-color: #ea0000; color: white;">Supprimer</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Columns section end -->
                <!-- table Marketing campaigns start -->
                <section id="table-Marketing">
                    <div class="form-group text-center">
                        <hr>
                        <h4>CVThèque</h4>
                        <hr>
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