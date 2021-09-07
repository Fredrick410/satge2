<?php
include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

// Convert a date or timestamp into French.
function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}

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
$pdoS->bindValue(':numentreprise', $_SESSION['id_session']);
$pdoS->execute();
$entreprise = $pdoS->fetch();

//Recuperation des taches.
$pdoS = $bdd->prepare('SELECT * FROM task WHERE id_session = :num ORDER BY id');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$tasks = $pdoS->fetchAll();


foreach ($tasks as $task) {
    $pdoS = $bdd->prepare('SELECT COUNT(*) as nb_comment FROM task_commentaire WHERE task_num = :num');
    $pdoS->bindValue(':num', $task['id']);
    $pdoS->execute();
    $task_comment_number[] = $pdoS->fetch();
}

foreach ($tasks as $task) {
    $pdoS = $bdd->prepare('SELECT COUNT(*) as nb_doc FROM task_doc WHERE task_num = :num');
    $pdoS->bindValue(':num', $task['id']);
    $pdoS->execute();
    $task_doc_number[] = $pdoS->fetch();
}

foreach ($tasks as $task) {
    $pdoS = $bdd->prepare('SELECT * FROM tasks_teams INNER JOIN teams ON(tasks_teams.id_team = teams.id)  WHERE id_task = :num');
    $pdoS->bindValue(':num', $task['id']);
    $pdoS->execute();
    $task_teams[] = $pdoS->fetchAll();
    if (!empty($task_teams[count($task_teams) - 1])) {
        for ($i = count($task_teams) - 1; $i < count($task_teams); $i++) {
            for ($j = 0; $j < count($task_teams[$i]); $j++) {
                for ($k = 0; $k < count($task_teams) - 1; $k++) {
                    $name_team = array_column($task_teams[$k], 'name_team');
                    $found_key = array_search($task_teams[$i][$j]['name_team'], $name_team);
                    if ($found_key !== false) {
                        $task_teams[$i][$j]['color'] = $task_teams[$k][$found_key]['color'];
                    }
                }
                if (!isset($task_teams[$i][$j]['color'])) {
                    $task_teams[$i][$j]['color'] = '#' . strtoupper(random_color());
                }
            }
        }
    }
}
//print("<pre>". print_r($task_teams,true)."</pre>");

foreach ($tasks as $task) {
    $pdoS = $bdd->prepare('SELECT * FROM tasks_membres INNER JOIN membres ON(tasks_membres.id_membre = membres.id)  WHERE id_task = :num');
    $pdoS->bindValue(':num', $task['id']);
    $pdoS->execute();
    $task_membres[] = $pdoS->fetchAll();
    if (!empty($task_membres[count($task_membres) - 1])) {
        for ($i = count($task_membres) - 1; $i < count($task_membres); $i++) {
            for ($j = 0; $j < count($task_membres[$i]); $j++) {
                for ($k = 0; $k < count($task_membres) - 1; $k++) {
                    if (isset($name_membre)) {
                        unset($name_membre);
                    }
                    foreach ($task_membres[$k] as $membre) {
                        $name_membre[] = $membre['nom'] . ' ' . $membre['prenom'];
                    }
                    $found_key = array_search($task_membres[$i][$j]['nom'] . ' ' . $task_membres[$i][$j]['prenom'], $name_membre);
                    if ($found_key !== false) {
                        $task_membres[$i][$j]['color'] = $task_membres[$k][$found_key]['color'];
                    }
                }
                if (!isset($task_membres[$i][$j]['color'])) {
                    $task_membres[$i][$j]['color'] = '#' . strtoupper(random_color());
                }
            }
        }
    }
}
//print("<pre>". print_r($task_membres,true)."</pre>");

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

    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/animate.css">
    <!-- Plugins css Ends-->
    <link id="color" rel="stylesheet" href="../../../cuba/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/responsive.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        .none-validation {
            display: none;
        }

        li {
            list-style: none;
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout 2-columns  navbar-sticky footer-static menu-collapsed " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout">
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
                <div class="col-12">
                    <button type="button" id="mission" class="btn btn-primary mb-1">
                        <i class='bx bx-task mr-50'></i> Mission
                    </button>
                </div>
            </div>
            <div class="content-body">
                <div class="page-body">
                    <div class="container-fluid">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-6">
                                    <h3>
                                        Project List</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid starts-->
                    <div class="container-fluid">
                        <div class="row project-cards">
                            <div class="col-md-12 project-list">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true"><i data-feather="target"></i>Tout</a></li>
                                                <li class="nav-item"><a class="nav-link" id="not-started-tab" data-bs-toggle="tab" href="#not-started" role="tab" aria-controls="not-started" aria-selected="false"><i data-feather="info"></i>Non démarré</a></li>
                                                <li class="nav-item"><a class="nav-link" id="doing-tab" data-bs-toggle="tab" href="#doing" role="tab" aria-controls="doing" aria-selected="false"><i data-feather="info"></i>En cours</a></li>
                                                <li class="nav-item"><a class="nav-link" id="done-tab" data-bs-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false"><i data-feather="check-circle"></i>Terminé</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content" id="tabContent">
                                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                                <div class="row">
                                                    <?php
                                                    for ($i = 0; $i < count($tasks); $i++) {
                                                    ?>
                                                        <div class="col-lg-4">
                                                            <div class="project-box"><span class="badge badge-primary"><?= $tasks[$i]['status_task'] ?></span>
                                                                <h6><?= $tasks[$i]['name_task'] ?></h6>
                                                                <p><?= $tasks[$i]['description_task'] ?></p>
                                                                <div class="row details">
                                                                    <?php
                                                                    $end = new DateTime($tasks[$i]['dateecheance_task']);
                                                                    $start = new DateTime($tasks[$i]['date_task']);
                                                                    $now = new DateTime(date('Y-m-d'));

                                                                    $duree_task = $end->diff($start)->format("%a"); //3
                                                                    $duree_effectuee_task = $now->diff($start)->format("%a"); //3
                                                                    if ($tasks[$i]['status_task'] === 'Terminé') {
                                                                        $pourcentage = 100;
                                                                    } else if ($tasks[$i]['status_task'] === 'En attente') {
                                                                        $pourcentage = 0;
                                                                    } else if ($end == $start) {
                                                                        $pourcentage = 99;
                                                                    } else if ($now >= $end) {
                                                                        $pourcentage = 99;
                                                                    } else {
                                                                        $pourcentage = round($duree_effectuee_task / $duree_task, 2);
                                                                    }
                                                                    ?>
                                                                    <div class="col-6"><span>Pièces jointes</span></div>
                                                                    <div class="col-6 text-primary"><?= $task_doc_number[$i]['nb_doc'] ?></div>
                                                                    <div class="col-6"> <span>Commentaires</span></div>
                                                                    <div class="col-6 text-primary"><?= $task_comment_number[$i]['nb_comment'] ?></div>
                                                                    <div class="col-6"> <span>Date de début</span></div>
                                                                    <div class="col-6 text-primary"><?= $start->format('d-m-Y') ?></div>
                                                                    <div class="col-6"> <span>Date de fin</span></div>
                                                                    <div class="col-6 text-primary"><?= $end->format('d-m-Y') ?></div>
                                                                </div>
                                                                <div class="customers mx-auto">
                                                                    <ul>
                                                                        <?php
                                                                        foreach ($task_membres[$i] as  $membre) {
                                                                            $acronyme = "";
                                                                            $a = str_word_count($membre['nom'] . ' ' . $membre['prenom'], 1);
                                                                            foreach ($a as $value) {
                                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                                            }
                                                                        ?>
                                                                            <li class="d-inline-block">
                                                                                <div class="badge-circle badge-circle-sm font-size-small font-weight-bold" style="background-color: <?= $membre['color'] ?>;"><?= $acronyme ?></div>
                                                                            </li>
                                                                        <?php
                                                                        }
                                                                        foreach ($task_teams[$i] as  $team) {
                                                                            $acronyme = "";
                                                                            $a = str_word_count($team['name_team'], 1);
                                                                            foreach ($a as $value) {
                                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                                            }
                                                                        ?>
                                                                            <li class="d-inline-block">
                                                                                <div class="badge-circle badge-circle-sm font-weight-bold" style="background-color: <?= $team['color'] ?>;"><?= $acronyme ?></div>
                                                                            </li>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                                <div class="project-status mt-4">
                                                                    <div class="media mb-0">
                                                                        <p><?= $pourcentage ?>% </p>
                                                                        <div class="media-body text-end">&nbsp;<span> effectué</span></div>
                                                                    </div>
                                                                    <div class="progress" style="height: 5px">
                                                                        <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: <?= $pourcentage ?>%" aria-valuenow="<?= $pourcentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="not-started" role="tabpanel" aria-labelledby="not-started-tab">
                                                <div class="row">
                                                    <?php
                                                    for ($i = 0; $i < count($tasks); $i++) {
                                                        if ($tasks[$i]['status_task'] == 'En attente') {
                                                    ?>
                                                            <div class="col-lg-4">
                                                                <div class="project-box"><span class="badge badge-primary"><?= $tasks[$i]['status_task'] ?></span>
                                                                    <h6><?= $tasks[$i]['name_task'] ?></h6>
                                                                    <p><?= $tasks[$i]['description_task'] ?></p>
                                                                    <div class="row details">
                                                                        <?php
                                                                        $end = new DateTime($tasks[$i]['dateecheance_task']);
                                                                        $start = new DateTime($tasks[$i]['date_task']);
                                                                        $now = new DateTime(date('Y-m-d'));

                                                                        $duree_task = $end->diff($start)->format("%a"); //3
                                                                        $duree_effectuee_task = $now->diff($start)->format("%a"); //3
                                                                        if ($tasks[$i]['status_task'] === 'Terminé') {
                                                                            $pourcentage = 100;
                                                                        } else if ($tasks[$i]['status_task'] === 'En attente') {
                                                                            $pourcentage = 0;
                                                                        } else if ($end == $start) {
                                                                            $pourcentage = 99;
                                                                        } else if ($now >= $end) {
                                                                            $pourcentage = 99;
                                                                        } else {
                                                                            $pourcentage = round($duree_effectuee_task / $duree_task, 2);
                                                                        }
                                                                        ?>
                                                                        <div class="col-6"><span>Pièces jointes</span></div>
                                                                        <div class="col-6 text-primary"><?= $task_doc_number[$i]['nb_doc'] ?></div>
                                                                        <div class="col-6"> <span>Commentaires</span></div>
                                                                        <div class="col-6 text-primary"><?= $task_comment_number[$i]['nb_comment'] ?></div>
                                                                        <div class="col-6"> <span>Date de début</span></div>
                                                                        <div class="col-6 text-primary"><?= $start->format('d-m-Y') ?></div>
                                                                        <div class="col-6"> <span>Date de fin</span></div>
                                                                        <div class="col-6 text-primary"><?= $end->format('d-m-Y') ?></div>
                                                                    </div>
                                                                    <div class="customers mx-auto">
                                                                        <ul>
                                                                            <?php
                                                                            foreach ($task_membres[$i] as  $membre) {
                                                                                $acronyme = "";
                                                                                $a = str_word_count($membre['nom'] . ' ' . $membre['prenom'], 1);
                                                                                foreach ($a as $value) {
                                                                                    $acronyme .= strtoupper(substr($value, 0, 1));
                                                                                }
                                                                            ?>
                                                                                <li class="d-inline-block">
                                                                                    <div class="badge-circle badge-circle-sm font-size-small font-weight-bold" style="background-color: <?= $membre['color'] ?>;"><?= $acronyme ?></div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            foreach ($task_teams[$i] as  $team) {
                                                                                $acronyme = "";
                                                                                $a = str_word_count($team['name_team'], 1);
                                                                                foreach ($a as $value) {
                                                                                    $acronyme .= strtoupper(substr($value, 0, 1));
                                                                                }
                                                                            ?>
                                                                                <li class="d-inline-block">
                                                                                    <div class="badge-circle badge-circle-sm font-weight-bold" style="background-color: <?= $team['color'] ?>;"><?= $acronyme ?></div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="project-status mt-4">
                                                                        <div class="media mb-0">
                                                                            <p><?= $pourcentage ?>% </p>
                                                                            <div class="media-body text-end">&nbsp;<span> effectué</span></div>
                                                                        </div>
                                                                        <div class="progress" style="height: 5px">
                                                                            <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: <?= $pourcentage ?>%" aria-valuenow="<?= $pourcentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="doing" role="tabpanel" aria-labelledby="doing-tab">
                                                <div class="row">
                                                    <?php
                                                    for ($i = 0; $i < count($tasks); $i++) {
                                                        if ($tasks[$i]['status_task'] == 'En cours') {
                                                    ?>
                                                            <div class="col-lg-4">
                                                                <div class="project-box"><span class="badge badge-primary"><?= $tasks[$i]['status_task'] ?></span>
                                                                    <h6><?= $tasks[$i]['name_task'] ?></h6>
                                                                    <p><?= $tasks[$i]['description_task'] ?></p>
                                                                    <div class="row details">
                                                                        <?php
                                                                        $end = new DateTime($tasks[$i]['dateecheance_task']);
                                                                        $start = new DateTime($tasks[$i]['date_task']);
                                                                        $now = new DateTime(date('Y-m-d'));

                                                                        $duree_task = $end->diff($start)->format("%a"); //3
                                                                        $duree_effectuee_task = $now->diff($start)->format("%a"); //3
                                                                        if ($tasks[$i]['status_task'] === 'Terminé') {
                                                                            $pourcentage = 100;
                                                                        } else if ($tasks[$i]['status_task'] === 'En attente') {
                                                                            $pourcentage = 0;
                                                                        } else if ($end == $start) {
                                                                            $pourcentage = 99;
                                                                        } else if ($now >= $end) {
                                                                            $pourcentage = 99;
                                                                        } else {
                                                                            $pourcentage = round($duree_effectuee_task / $duree_task, 2);
                                                                        }
                                                                        ?>
                                                                        <div class="col-6"><span>Pièces jointes</span></div>
                                                                        <div class="col-6 text-primary"><?= $task_doc_number[$i]['nb_doc'] ?></div>
                                                                        <div class="col-6"> <span>Commentaires</span></div>
                                                                        <div class="col-6 text-primary"><?= $task_comment_number[$i]['nb_comment'] ?></div>
                                                                        <div class="col-6"> <span>Date de début</span></div>
                                                                        <div class="col-6 text-primary"><?= $start->format('d-m-Y') ?></div>
                                                                        <div class="col-6"> <span>Date de fin</span></div>
                                                                        <div class="col-6 text-primary"><?= $end->format('d-m-Y') ?></div>
                                                                    </div>
                                                                    <div class="customers mx-auto">
                                                                        <ul>
                                                                            <?php
                                                                            foreach ($task_membres[$i] as  $membre) {
                                                                                $acronyme = "";
                                                                                $a = str_word_count($membre['nom'] . ' ' . $membre['prenom'], 1);
                                                                                foreach ($a as $value) {
                                                                                    $acronyme .= strtoupper(substr($value, 0, 1));
                                                                                }
                                                                            ?>
                                                                                <li class="d-inline-block">
                                                                                    <div class="badge-circle badge-circle-sm font-size-small font-weight-bold" style="background-color: <?= $membre['color'] ?>;"><?= $acronyme ?></div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            foreach ($task_teams[$i] as  $team) {
                                                                                $acronyme = "";
                                                                                $a = str_word_count($team['name_team'], 1);
                                                                                foreach ($a as $value) {
                                                                                    $acronyme .= strtoupper(substr($value, 0, 1));
                                                                                }
                                                                            ?>
                                                                                <li class="d-inline-block">
                                                                                    <div class="badge-circle badge-circle-sm font-weight-bold" style="background-color: <?= $team['color'] ?>;"><?= $acronyme ?></div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="project-status mt-4">
                                                                        <div class="media mb-0">
                                                                            <p><?= $pourcentage ?>% </p>
                                                                            <div class="media-body text-end">&nbsp;<span> effectué</span></div>
                                                                        </div>
                                                                        <div class="progress" style="height: 5px">
                                                                            <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: <?= $pourcentage ?>%" aria-valuenow="<?= $pourcentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                                                <div class="row">
                                                    <?php
                                                    for ($i = 0; $i < count($tasks); $i++) {
                                                        if ($tasks[$i]['status_task'] == 'Terminé') {
                                                    ?>
                                                            <div class="col-lg-4">
                                                                <div class="project-box"><span class="badge badge-primary"><?= $tasks[$i]['status_task'] ?></span>
                                                                    <h6><?= $tasks[$i]['name_task'] ?></h6>
                                                                    <p><?= $tasks[$i]['description_task'] ?></p>
                                                                    <div class="row details">
                                                                        <?php
                                                                        $end = new DateTime($tasks[$i]['dateecheance_task']);
                                                                        $start = new DateTime($tasks[$i]['date_task']);
                                                                        $now = new DateTime(date('Y-m-d'));

                                                                        $duree_task = $end->diff($start)->format("%a"); //3
                                                                        $duree_effectuee_task = $now->diff($start)->format("%a"); //3
                                                                        if ($tasks[$i]['status_task'] === 'Terminé') {
                                                                            $pourcentage = 100;
                                                                        } else if ($tasks[$i]['status_task'] === 'En attente') {
                                                                            $pourcentage = 0;
                                                                        } else if ($end == $start) {
                                                                            $pourcentage = 99;
                                                                        } else if ($now >= $end) {
                                                                            $pourcentage = 99;
                                                                        } else {
                                                                            $pourcentage = round($duree_effectuee_task / $duree_task, 2);
                                                                        }
                                                                        ?>
                                                                        <div class="col-6"><span>Pièces jointes</span></div>
                                                                        <div class="col-6 text-primary"><?= $task_doc_number[$i]['nb_doc'] ?></div>
                                                                        <div class="col-6"> <span>Commentaires</span></div>
                                                                        <div class="col-6 text-primary"><?= $task_comment_number[$i]['nb_comment'] ?></div>
                                                                        <div class="col-6"> <span>Date de début</span></div>
                                                                        <div class="col-6 text-primary"><?= $start->format('d-m-Y') ?></div>
                                                                        <div class="col-6"> <span>Date de fin</span></div>
                                                                        <div class="col-6 text-primary"><?= $end->format('d-m-Y') ?></div>
                                                                    </div>
                                                                    <div class="customers mx-auto">
                                                                        <ul>
                                                                            <?php
                                                                            foreach ($task_membres[$i] as  $membre) {
                                                                                $acronyme = "";
                                                                                $a = str_word_count($membre['nom'] . ' ' . $membre['prenom'], 1);
                                                                                foreach ($a as $value) {
                                                                                    $acronyme .= strtoupper(substr($value, 0, 1));
                                                                                }
                                                                            ?>
                                                                                <li class="d-inline-block">
                                                                                    <div class="badge-circle badge-circle-sm font-size-small font-weight-bold" style="background-color: <?= $membre['color'] ?>;"><?= $acronyme ?></div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            foreach ($task_teams[$i] as  $team) {
                                                                                $acronyme = "";
                                                                                $a = str_word_count($team['name_team'], 1);
                                                                                foreach ($a as $value) {
                                                                                    $acronyme .= strtoupper(substr($value, 0, 1));
                                                                                }
                                                                            ?>
                                                                                <li class="d-inline-block">
                                                                                    <div class="badge-circle badge-circle-sm font-weight-bold" style="background-color: <?= $team['color'] ?>;"><?= $acronyme ?></div>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="project-status mt-4">
                                                                        <div class="media mb-0">
                                                                            <p><?= $pourcentage ?>% </p>
                                                                            <div class="media-body text-end">&nbsp;<span> effectué</span></div>
                                                                        </div>
                                                                        <div class="progress" style="height: 5px">
                                                                            <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: <?= $pourcentage ?>%" aria-valuenow="<?= $pourcentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
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
    <script src="../../../app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
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
            $('#mission').on("click", function(e) {
                window.location.href = "mission.php";
            });
        });
    </script>
    <!-- latest jquery-->
    <script src="../../../cuba/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../../../cuba/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="../../../cuba/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../../../cuba/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="../../../cuba/assets/js/scrollbar/simplebar.js"></script>
    <script src="../../../cuba/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="../../../cuba/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../../../cuba/assets/js/sidebar-menu.js"></script>
    <script src="../../../cuba/assets/js/typeahead/handlebars.js"></script>
    <script src="../../../cuba/assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="../../../cuba/assets/js/typeahead/typeahead.custom.js"></script>
    <script src="../../../cuba/assets/js/typeahead-search/handlebars.js"></script>
    <script src="../../../cuba/assets/js/typeahead-search/typeahead-custom.js"></script>
    <script src="../../../cuba/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>