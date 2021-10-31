<?php

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

// Fonctions pour generer une couleur en hexadecimal de facon aleatoire
function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return random_color_part() . random_color_part() . random_color_part();
}

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id']);
$pdoS->execute();
$entreprise = $pdoS->fetch();

$pdoS = $bdd->prepare('SELECT * FROM teams WHERE id_session = :num');
$pdoS->bindValue(':num', $_SESSION['id']);
$pdoS->execute();
$team = $pdoS->fetchAll();

//On recupere tous les membres.
$pdoS = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$membres = $pdoS->fetchAll();

// Supression des notifications
$pdoS = $bdd->prepare('DELETE FROM notif_front WHERE id_session = ? AND type_demande = ?');
$pdoS->execute(array($_SESSION['id_session'], 'teams_membres'));

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
    <title>Mes equipes</title>
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

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == "light") {
                                                        echo "semi-";
                                                    } ?>dark-layout content-left-sidebar todo-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="<?php if ($entreprise['theme_web'] == "light") {
                                                                                                                                                                                                                                                echo "semi-";
                                                                                                                                                                                                                                            } ?>dark-layout">

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
                    <div class="users-list-filter px-1">
                        <div class="row rounded py-2 mb-2">
                            <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                <a href="teams-add.php" class=""><button type="button" class="btn btn-secondary btn-block glow users-list-clear mb-0">Ajouter une team</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table">
                                            <thead class="thead-dark">
                                                <tr class="text-center">
                                                    <th>Nom</th>
                                                    <th>Photo</th>
                                                    <th>Nombre de membre</th>
                                                    <th>Membres</th>
                                                    <th>Date de création</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($team as $teams) :

                                                    $pdoS = $bdd->prepare('SELECT * FROM teams_membres WHERE id_session = :num AND team_num=:team_num ');
                                                    $pdoS->bindValue(':num', $_SESSION['id']);
                                                    $pdoS->bindValue(':team_num', $teams['id']);
                                                    $pdoS->execute();
                                                    $team_membre = $pdoS->fetchAll();
                                                    $count_membre = count($team_membre);

                                                ?>
                                                    <tr class="text-center">
                                                        <td><?= $teams['name_team'] ?></td>
                                                        <td><?php if (!empty($teams['photo_team'])) { ?><img class="rounded-circle" src="../../../src/img/<?= $teams['photo_team'] ?>" alt="photo" width="60" height="60"><?php } else {
                                                                                                                                                                                                        echo "Non définie";
                                                                                                                                                                                                    } ?></td>
                                                        <td><?= $count_membre ?></td>
                                                        <td>
                                                            <?php
                                                            if ($count_membre != 0) {
                                                            ?>
                                                                <ul class="list-unstyled users-list m-0 d-flex align-items-center">
                                                                    <?php
                                                                    $nb_membre = 0;
                                                                    foreach ($membres as $membre) {
                                                                        $name_membre = array_column($team_membre, 'name_membre');
                                                                        $found_key = array_search($membre['nom'] . " " . $membre['prenom'], $name_membre);
                                                                        if ($found_key !== false) {
                                                                            if (empty($membre['img_membres'])) {
                                                                                $acronyme = "";
                                                                                $a = str_word_count($mission_task_membres[$i][$j][$k]['nom'] . ' ' . $mission_task_membres[$i][$j][$k]['prenom'], 1);
                                                                                foreach ($a as $value) {
                                                                                    $acronyme .= strtoupper(substr($value, 0, 1));
                                                                                }
                                                                                $membre['color'] = '#' . strtoupper(random_color());
                                                                    ?>
                                                                                <li class="kanban-badge avatar pull-up my-0">
                                                                                    <div class="media-object rounded-circle badge-circle badge-circle-sm font-size-small font-weight-bold" style="background-color: <?= $membre['color'] ?> ;">
                                                                                        <?= $acronyme ?>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <li class="avatar pull-up my-0">
                                                                                    <img class="media-object rounded-circle" src="<?= "../../../src/img/" . $membre['img_membres'] ?>" alt="Avatar" height="40" width="40">
                                                                                </li>
                                                                    <?php
                                                                            }
                                                                            $nb_membre++;
                                                                            if ($nb_membre > 5) {
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if ($nb_membre > 5) {
                                                                    ?>
                                                                        <li class="kanban-badge avatar pull-up my-0">
                                                                            <div class="media-object rounded-circle badge-circle badge-circle-sm font-size-small font-weight-bold" style="background-color: #ffffff; color: #000000; height: 35px; width: 35px;">
                                                                                ...
                                                                            </div>
                                                                        </li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $teams['date_crea'] ?></td>

                                                        <td><a href="teams-view.php?num=<?= $teams['id'] ?>"><i class='bx bx-search-alt'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_team.php?num=<?= $teams['id'] ?>"><i style="cursor: pointer;" class="bx bx-trash-alt"></i></a></td>
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
    <!-- <script src="../../../app-assets/js/scripts/pages/page-users.js"></script> -->
    <script>
        $(document).ready(function() {
            var table = $('#users-list-datatable').DataTable({
                dom: 'Pfrtip',
                columnDefs: [{
                    orderable: false,
                    width: "8%",
                    targets: [1, 3, 5]
                }, ]
            });
            $('#users-list-datatable_filter').children().children().on('keyup', function() {
                table
                    .columns(0)
                    .search(this.value)
                    .draw();
            });
        });
    </script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>