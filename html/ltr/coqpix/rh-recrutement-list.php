<?php

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id']);
$true = $pdoS->execute();
$entreprise = $pdoS->fetch();

$pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE id_session = :num ORDER BY id DESC LIMIT 4');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$candidature_limit = $pdoS->fetchAll();

$pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE id_session = :num');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$candidature = $pdoS->fetchAll();

$pdoS = $bdd->prepare('SELECT * FROM rh_annonce WHERE id_session = :num');
$pdoS->bindValue(':num', $_SESSION['id_session']);
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/searchPanes.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/searchPanes.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
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

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == "light") {
                                                        echo "semi-";
                                                    } ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise["theme_web"] == "light") {
                                                                                                                                                                                                        echo "semi-";
                                                                                                                                                                                                    } ?>dark-layout">
    <style>
        .none-validation {
            display: none;
        }
    </style>
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
                                <div class="form-group <?php if ($count_annonce > 0) {
                                                            echo "none-validation";
                                                        } ?>">
                                    Aucune annonce de recrutement
                                </div>
                                <?php foreach ($annonce as $annonces) : ?>
                                    <?php

                                    $pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE id_session = :num AND name_annonce=:name_annonce');
                                    $pdoS->bindValue(':num', $_SESSION['id_session']);
                                    $pdoS->bindValue(':name_annonce', $annonces['name_annonce']);
                                    $pdoS->execute();
                                    $candidature_candidature = $pdoS->fetchAll();
                                    $count_candidature = count($candidature_candidature);
                                    $link = $annonces['link'];
                                    ?>
                                    <div class="card text-center bg-transparent" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid <?= $annonces['color_annonce'] ?>;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <h5><?= $annonces['name_annonce'] ?></h5>
                                                </div>
                                                <div class="form-group">
                                                    <span>Nombre de candidature : <?= $count_candidature ?> candidats</span><br>
                                                    <textarea id="to-copy"><?= str_replace("rh-recrutement-list.php", "candidature-recrutement.php?$link", "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?></textarea>
                                                    <button id="copy" type="button" style="border: none;"><span style="color: <?= $annonces['color_annonce'] ?>; cursor: pointer;">Cliquez pour copier le lien de partage <i class='bx bxs-copy-alt' style="position: relative; top: 2px;"></i></span></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="rh-recrutement-list-details.php?annonce=<?= $annonces['name_annonce'] ?>"><button class="btn mt-50" style="background-color: <?= $annonces['color_annonce'] ?>; color: white;">Voir</button></a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="php/change_delete_rh_annonce.php?fonction=change&num=<?= $annonces['id'] ?>&statut=<?php if ($annonces['statut'] == "actif") {
                                                                                                                                                        echo "actif";
                                                                                                                                                    } else {
                                                                                                                                                        echo "pause";
                                                                                                                                                    } ?>"><button class="btn btn-<?php if ($annonces['statut'] == "actif") {
                                                                                                                                                                                        echo "warning";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "success";
                                                                                                                                                                                    } ?> mt-50"><?php if ($annonces['statut'] == "actif") {
                                                                                                                                                                                                    echo "Pause";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "Activer";
                                                                                                                                                                                                } ?></button></a>
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
                            <table class="table">
                                <thead>
                                    <tr class="group" style="background-color: gainsboro;">
                                        <th colspan="6">Dernières candidatures recues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <table id="table-candidatures-last" class="table mb-0">
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
                                            <?php foreach ($candidature_limit as $candidatures_limit) : ?>
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
                                        </tbody>
                                    </table>
                                </tbody>
                            </table>
                            <!-- table ends -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="group" style="background-color: gainsboro;">
                                        <th colspan="6">Tous les jours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <table id="table-candidatures" class="table mb-0">
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
                                            <?php foreach ($candidature as $candidatures) : ?>
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
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.searchPanes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/searchPanes.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script>
        $(document).ready(function() {
            $('#table-candidatures').DataTable({
                dom: 'Pfrtip',
                columnDefs: [{
                        searchPanes: {
                            show: true
                        },
                        targets: [1]
                    },
                    {
                        searchPanes: {
                            show: true
                        },
                        targets: [4]
                    },
                    {
                        searchable: false,
                        targets: 2
                    },
                    {
                        searchable: false,
                        targets: 3
                    },
                    {
                        searchable: false,
                        targets: 5
                    }
                ]
            });
        });
    </script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>