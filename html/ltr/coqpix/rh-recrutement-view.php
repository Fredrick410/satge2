<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoStt->bindValue(':numentreprise', $_SESSION['id_session']);
$pdoStt->execute();
$entreprise = $pdoStt->fetch();

$pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE id = :num');
$pdoStt->bindValue(':num', $_GET['num']);
$pdoStt->execute();
$candidature = $pdoStt->fetch();
$pourc = "0";

if (count($candidature) != 0) {

    $_SESSION['candidat'] = $candidature['id'];

    //progression 3 PART 33 par partie

    //profile part /4 = 8,25
    if ($candidature['nom_candidat'] !== "") {
        $pourc = $pourc + 8.333;
    }
    if ($candidature['prenom_candidat'] !== "") {
        $pourc = $pourc + 8.333;
    }
    if ($candidature['age_candidat'] !== "") {
        $pourc = $pourc + 8.333;
    }
    if ($candidature['formationetude'] !== "") {
        $pourc = $pourc + 8.333;
    }

    //Niveau /6 = 5.5556

    if ($candidature['logiciel'] !== "") {
        $pourc = $pourc + 5.556;
    }
    if ($candidature['langue'] !== "") {
        $pourc = $pourc + 5.556;
    }
    if ($candidature['formationetude'] !== "") {
        $pourc = $pourc + 5.556;
    }
    if ($candidature['interet'] !== "") {
        $pourc = $pourc + 5.556;
    }
    if ($candidature['qualite'] !== "") {
        $pourc = $pourc + 5.556;
    }
    if ($candidature['default_candi'] !== "") {
        $pourc = $pourc + 5.556;
    }

    //document /2 = 16.6667
    if ($candidature['cv_doc'] !== "") {
        $pourc = $pourc + 16.6667;
    }
    if ($candidature['lettredemotivation_doc'] !== "") {
        $pourc = $pourc + 16.6667;
    }

    if ($pourc > 100) {
        $pourc = "100";
    }

    $pourc = substr($pourc, 0, 5);



    if ($pourc > "0" && $pourc < "33.3333333333") {
        $pourc_color = "danger";
    }
    if ($pourc > "30" && $pourc < "66.6666666666") {
        $pourc_color = "warning";
    }
    if ($pourc > "66.6666666666" && $pourc <= "100") {
        $pourc_color = "success";
    }

    $pdoStt = $bdd->prepare('SELECT DISTINCT libelle, idqcm, qualitatif FROM qcm INNER JOIN reponses_qcm_candidat ON (qcm.id = reponses_qcm_candidat.idqcm ) WHERE idcandidat=:num');
    $pdoStt->bindValue(':num', $candidature['id']);
    $pdoStt->execute();
    $qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($qcms as $key => $value) {
        $pdoStt = $bdd->prepare('SELECT * FROM question WHERE idqcm = :id');
        $pdoStt->bindValue(':id', $value['idqcm']);
        $pdoStt->execute();
        $questions[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
    }

    foreach ($questions as $key => $desquestions) { // fixer la liste des questions
        foreach ($desquestions as $key => $question) { // fixe une question de la liste
            $pdoStt = $bdd->prepare('SELECT * FROM reponse WHERE idquestion = :id ORDER BY idquestion, id');
            $pdoStt->bindValue(':id', $question['id']);
            $pdoStt->execute();
            $desreponses[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
        }
        $reponses[] = $desreponses;
        unset($desreponses);

        foreach ($desquestions as $key => $question) { // fixe une question de la liste
            $pdoStt = $bdd->prepare('SELECT * FROM reponses_qcm_candidat WHERE idquestion = :idquestion and idcandidat=:idcandidat');
            $pdoStt->bindValue(':idquestion', $question['id']);
            $pdoStt->bindValue(':idcandidat', $candidature['id']);
            $pdoStt->execute();
            $desreponses[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
        }
        $reponses_candidat[] = $desreponses;
        unset($desreponses);
    }
} else {
    header('Location: rh-recrutement-list.php');
}
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
    <title>Recrutement</title>
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: JQUERY-->
    <script src="../../../cuba/assets/js/jquery-3.5.1.min.js"></script>
    <!-- END: JQUERY-->

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
                <!-- Progress Sizes start -->
                <section id="progress-sizes">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5 class="">Progression du candidat - <?= $pourc ?>%</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="progress progress-bar-<?= $pourc_color ?> mb-1 progress-sm">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="80" aria-valuemax="100" style="width:<?= $pourc ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Progress Sizes end -->
                <!-- List group navigation start -->
                <section class="list-group-navigation">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Candidature N°<?= $candidature['num_candidat'] ?> - <?php if ($candidature['sexe_candidat'] == "homme") {
                                                                                                                    echo "Mr";
                                                                                                                } else {
                                                                                                                    echo "Mme";
                                                                                                                } ?> <?= $candidature['nom_candidat'] ?> - <?= $candidature['name_annonce'] ?></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 ">
                                                <div class="list-group" role="tablist">
                                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Profiles</a>
                                                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Références</a>
                                                    <a class="list-group-item list-group-item-action" id="list-level-list" data-toggle="list" href="#list-level" role="tab">Niveaux</a>
                                                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Documents</a>
                                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Options</a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-8 mt-1">
                                                <div class="tab-content text-justify" id="nav-tabContent">
                                                    <div class="tab-pane show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group text-center">
                                                                    <label>Description</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Nom : <small><?= $candidature['nom_candidat'] ?></small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Prénom : <small><?= $candidature['prenom_candidat'] ?></small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Age : <small><?= $candidature['age_candidat'] ?> ans</small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <hr>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span>Spécialitée : <small><?= $candidature['specialite_candidat'] ?></small></span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <img src="../../../src/img/team_img.png" class="rounded" alt="Photo de profile">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                                        <div class="form-group">
                                                            <span>Logiciels : <small><?= $candidature['logiciel'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Langues : <small><?= $candidature['langue'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Formations & Diplomes : <small><?= $candidature['formationetude'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Intérets : <small><?= $candidature['interet'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Mes Qualités : <small><?= $candidature['qualite'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Mes defaults : <small><?= $candidature['default_candi'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Permis : <small><?= $candidature['permis_conduite'] ?> </small></span>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-level" role="tabpanel" aria-labelledby="list-level-list">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <?php
                                                                    for ($i = 0; $i < count($qcms); $i++) {
                                                                    ?>
                                                                        <div class="col">
                                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#qcm<?= $i ?>">
                                                                                <?= $qcms[$i]['libelle'] ?>
                                                                            </button>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                                                        <div class="row">
                                                            <div class="col text-center <?php if ($candidature['cv_doc'] == "") {
                                                                                            echo "none-validation";
                                                                                        } ?>">
                                                                <label>CV</label>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <i class='bx bxs-file-pdf'></i> <?= $candidature['cv_doc'] ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/cv/<?= $candidature['cv_doc'] ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-show-alt' style=""></i> Prévisualiser</button></a>
                                                                        </div>
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/cv/<?= $candidature['cv_doc'] ?>" target="_blank" rel="noopener noreferrer" download><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-download' style=""></i> Télécharger</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col text-center <?php if ($candidature['lettredemotivation_doc'] == "") {
                                                                                            echo "none-validation";
                                                                                        } ?>">
                                                                <label>Lettre de motivation</label>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <i class='bx bxs-file-pdf'></i> <?= $candidature['lettredemotivation_doc'] ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/lettredemotivation/<?= $candidature['lettredemotivation_doc'] ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-show-alt' style=""></i> Prévisualiser</button></a>
                                                                        </div>
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/lettredemotivation/<?= $candidature['lettredemotivation_doc'] ?>" target="_blank" rel="noopener noreferrer" download><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-download' style=""></i> Télécharger</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col text-center <?php if ($candidature['other_doc'] == "") {
                                                                                            echo "none-validation";
                                                                                        } ?>">
                                                                <label>Autre document</label>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <i class='bx bxs-file-pdf'></i> <?= $candidature['other_doc'] ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/other/<?= $candidature['other_doc'] ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-show-alt' style=""></i> Prévisualiser</button></a>
                                                                        </div>
                                                                        <div class="col">
                                                                            <a href="../../../src/recrutement/other/<?= $candidature['other_doc'] ?>" target="_blank" rel="noopener noreferrer" download><button type="button" class="btn mr-1 mb-1 btn-outline-primary btn-sm"><i class='bx bx-download' style=""></i> Télécharger</button></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                                                        <div class="form-group">
                                                            <div class="form-group text-center">
                                                                <label>Paramètres et options</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Suivi de la candidature :</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <hr>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>Suivi par mail effectué</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="suivi_mail" <?php if ($candidature['suivi_mail'] == "oui") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>>
                                                                                <label class="custom-control-label" for="suivi_mail"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>Suivi par téléphone effectué</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="suivi_tel" <?php if ($candidature['suivi_tel'] == "oui") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>>
                                                                                <label class="custom-control-label" for="suivi_tel"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>Test specifique effectué</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="suivi_test_specif" <?php if ($candidature['suivi_test_specif'] == "oui") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>>
                                                                                <label class="custom-control-label" for="suivi_test_specif"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>Entretien presentiel ou visio effectué</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="suivi_entretien" <?php if ($candidature['suivi_test_specif'] == "oui") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>>
                                                                                <label class="custom-control-label" for="suivi_entretien"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- List group navigation ends -->
                <?php
                $total = 0;
                for ($i = 0; $i < count($qcms); $i++) {
                    $score = 0;
                ?>
                    <!-- Modal -->
                    <div class="modal fade" id="qcm<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="modalQcm<?= $i ?>" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Resultats du qcm : <?= $qcms[$i]['libelle'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <?php
                                        if ($qcms[$i]['qualitatif'] == "Non") {
                                        ?>
                                            <div class="col-12">
                                                <h3 id="name-qcm" class="d-flex justify-content-center"><?= $qcms[$i]['libelle'] ?></h3>
                                                <h4 id="name-candidat" class="d-flex justify-content-center" style="color: grey;"><?= $candidature['nom_candidat'] ?> <?= $candidature['prenom_candidat'] ?></h4>
                                                <table class="table table-bordered" id="table<?= $i ?>" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Question</th>
                                                            <th>Nombre points de la question</th>
                                                            <th>Reponse</th>
                                                            <th>Choix du candidat</th>
                                                            <th>choix officiel</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        for ($j = 0; $j < count($questions[$i]); ++$j) {
                                                        ?>
                                                            <tr>
                                                                <td rowspan=<?= count($reponses[$i][$j]) ?>>
                                                                    <?= $questions[$i][$j]['libelle'] ?>
                                                                </td>

                                                                <td rowspan=<?= count($reponses[$i][$j]) ?>>
                                                                    <?= $questions[$i][$j]['points'] ?>
                                                                </td>

                                                                <td>
                                                                    <?= $reponses[$i][$j][0]['libelle'] ?>
                                                                </td>

                                                                <td>
                                                                    <?= $reponses_candidat[$i][$j][0]['vrai_ou_faux'] ?>
                                                                </td>

                                                                <td>
                                                                    <?= $reponses[$i][$j][0]['vrai_ou_faux'] ?>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                            for ($k = 1; $k < count($reponses[$i][$j]); ++$k) {
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= $reponses[$i][$j][$k]['libelle'] ?>
                                                                    </td>

                                                                    <td>
                                                                        <?= $reponses_candidat[$i][$j][$k]['vrai_ou_faux'] ?>
                                                                    </td>

                                                                    <td>
                                                                        <?= $reponses[$i][$j][$k]['vrai_ou_faux'] ?>
                                                                    </td>
                                                                </tr>

                                                        <?php
                                                            }
                                                            $officiel = 0;
                                                            for ($k = 0; $k < count($reponses[$i][$j]); ++$k) {
                                                                if ($reponses[$i][$j][$k]['vrai_ou_faux'] == 'Vrai') {
                                                                    $officiel++;
                                                                }
                                                            }
                                                            $k = 0;
                                                            $candidat = 0;
                                                            while ($k < count($reponses[$i][$j])) {
                                                                if ($reponses_candidat[$i][$j][$k]['vrai_ou_faux'] == 'Vrai' and $reponses[$i][$j][$k]['vrai_ou_faux'] == 'Vrai') {
                                                                    $candidat++;
                                                                } elseif ($reponses_candidat[$i][$j][$k]['vrai_ou_faux'] == 'Vrai' and $reponses[$i][$j][$k]['vrai_ou_faux'] == 'Faux') {
                                                                    $candidat = 0;
                                                                    break;
                                                                }
                                                                $k++;
                                                            }
                                                            $score += $candidat / $officiel * $questions[$i][$j]['points'];
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <label>Total : <?= $score ?></label>
                                                <?php
                                                $total = $total + $score;
                                                ?>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <h3 id="name-qcm"><?= $qcms[$i]['libelle'] ?></h3>
                                                    <h4 id="name-candidat" style="color: grey;"><?= $candidature['nom_candidat'] ?> <?= $candidature['prenom_candidat'] ?></h4>
                                                </div>
                                            </div>
                                            <div class="col-5 ml-auto">
                                                <canvas id="myChart<?= $i ?>" width="400" height="400"></canvas>
                                                <script src="../../../app-assets/vendors/js/charts/chart.min.js"></script>
                                                <script>
                                                    var id_candidat = <?= $candidature['id'] ?>;
                                                    var id_qcm_candidat = <?= $qcms[$i]['idqcm'] ?>;

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '../../../html/ltr/coqpix/php/rh-ajax-graph.php',
                                                        data: {
                                                            action: 'showData',
                                                            id_candidat: id_candidat,
                                                            qcm_candidat: id_qcm_candidat
                                                        },
                                                        headers: {
                                                            'X-Requested-With': 'XMLHttpRequest'
                                                        },
                                                        dataType: 'json',
                                                        success: function(response) {
                                                            var red = response['result']['parametre']['A'];
                                                            var blue = response['result']['parametre']['B'];
                                                            var yellow = response['result']['parametre']['C'];
                                                            var green = response['result']['parametre']['D'];
                                                            var purple = response['result']['parametre']['E'];
                                                            var orange = response['result']['parametre']['F'];

                                                            var ctx = document.getElementById('myChart<?= $i ?>').getContext('2d');
                                                            var myChart = new Chart(ctx, {
                                                                type: 'radar',
                                                                data: {
                                                                    labels: ['paramA', 'paramB', 'paramC', 'paramD', 'paramE', 'paramF'], // mettre les vrais nom des catégories ici aussi
                                                                    datasets: [{
                                                                        label: 'test chart',
                                                                        data: [red, blue, yellow, green, purple, orange],
                                                                        backgroundColor: [
                                                                            'rgba(255, 99, 132, 0.2)',
                                                                            'rgba(54, 162, 235, 0.2)',
                                                                            'rgba(255, 206, 86, 0.2)',
                                                                            'rgba(75, 192, 192, 0.2)',
                                                                            'rgba(153, 102, 255, 0.2)',
                                                                            'rgba(255, 159, 64, 0.2)'
                                                                        ],
                                                                        borderColor: [
                                                                            'rgba(255, 99, 132, 1)',
                                                                            'rgba(54, 162, 235, 1)',
                                                                            'rgba(255, 206, 86, 1)',
                                                                            'rgba(75, 192, 192, 1)',
                                                                            'rgba(153, 102, 255, 1)',
                                                                            'rgba(255, 159, 64, 1)'
                                                                        ],
                                                                        borderWidth: 1
                                                                    }]
                                                                },
                                                                options: {
                                                                    scales: {
                                                                        y: {
                                                                            beginAtZero: true
                                                                        }
                                                                    }
                                                                }
                                                            });
                                                        },
                                                        error: function(response) {
                                                            console.log('error');
                                                        },
                                                        complete: function(response) {
                                                            console.log('Complete !')
                                                        }
                                                    });
                                                </script>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="exportPdf<?= $i ?>">Telecharger</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- Block level buttons start -->
                <section id="block-level-buttons">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body" style="background-color: none;">
                                        <div class="row">
                                            <div class="col">
                                                <a href="php/edit_rh_statut.php?num=<?= $_GET['num'] ?>&type=success"><button type="button" class="btn mb-1 btn-outline-success btn-lg btn-block">Accepter le candidat</button></a>
                                            </div>
                                            <div class="col">
                                                <a href="php/edit_rh_statut.php?num=<?= $_GET['num'] ?>&type=failure"><button type="button" class="btn mb-1 btn-outline-danger btn-lg btn-block">Resufer le candidat</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Block level buttons end -->
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/extensions/html2canvas.min.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/purify.min.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/jspdf.umd.min.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/jspdf.plugin.autotable.js"></script>
    <script>
        $(document).ready(function() {
            /*creating a new click event for each toogle this will save to the database*/
            $('input[type="checkbox"]').change(function() {
                var type_suivi = this.id;
                if (this.checked) {
                    var suivi = "oui";
                } else {
                    var suivi = "non";
                }
                num = <?= $candidature['id'] ?>;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/maj_suivi_candidature.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        suivi: suivi,
                        type_suivi: type_suivi,
                        num: num
                    }
                });
            });

            function downloadPDFWithjsPDF(val, qualitatif) {
                if (qualitatif == "Non") {
                    var doc = new jspdf.jsPDF();
                    doc.autoTable({
                        html: '#table' + val
                    });
                    doc.save("table.pdf");
                } else {
                    var doc = new jspdf.jsPDF('l', 'pt', [400, 400]);
                    doc.addImage(document.getElementById('myChart' + val).toDataURL("image/png"), 'PNG', 0, 0, 400, 400);
                    doc.save("chart.pdf");
                }
            }

            <?php
            for ($i = 0; $i < count($qcms); $i++) {
            ?>
                id<?= $i ?> = <?= $i ?>;
                document.querySelector('#exportPdf<?= $i ?>').addEventListener('click', function() {
                    downloadPDFWithjsPDF(id<?= $i ?>, "<?= $qcms[$i]['qualitatif'] ?>");
                }, false);
            <?php
            }
            ?>
        });
    </script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>