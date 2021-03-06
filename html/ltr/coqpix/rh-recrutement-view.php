<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

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

    if (isset($questions)) {
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
    <meta name="description" content="Coqpix cr??e By audit action plus - d??velopp?? par Youness Haddou">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/calendars/app-calendar.css">
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
                                    <h5 class="">Progression du candidat - <?= $pourc ?>%</h5>
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
                                    <h4 class="card-title">Candidature N??<?= $candidature['num_candidat'] ?> - <?php if ($candidature['sexe_candidat'] == "homme") {
                                                                                                                    echo "Mr";
                                                                                                                } else {
                                                                                                                    echo "Mme";
                                                                                                                } ?> <?= $candidature['nom_candidat'] ?> - <?= $candidature['name_annonce'] ?></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-3">
                                                <div class="list-group" role="tablist">
                                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Profil</a>
                                                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">R??f??rences</a>
                                                    <a class="list-group-item list-group-item-action" id="list-level-list" data-toggle="list" href="#list-level" role="tab">R??sultats des QCMS</a>
                                                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Documents</a>
                                                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Etat du suivi</a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-9">
                                                <div class="tab-content text-justify" id="nav-tabContent">
                                                    <div class="tab-pane show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group text-center">
                                                                    <label>Description</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span id="nom">Nom : <small><?= $candidature['nom_candidat'] ?></small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span id="prenom">Pr??nom : <small><?= $candidature['prenom_candidat'] ?></small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span id="age">Age : <small><?= $candidature['age_candidat'] ?> ans</small></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <hr>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span id="specialite">Sp??cialit?? : <small><?= $candidature['specialite_candidat'] ?></small></span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-center">
                                                                    <?php
                                                                    if ($candidature['image_candidat'] != "") {
                                                                    ?>
                                                                        <img src="../../../src/img/<?= $candidature["image_candidat"] ?>" class="rounded" alt="Photo de profile" width="250px" height="300px" style="max-width: 100%; max-height: 100%; display: block;">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <img src="../../../src/img/team_img.png" class="rounded" alt="Photo de profile">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                                        <div class="form-group">
                                                            <span id="logiciels">Logiciels : <small><?= $candidature['logiciel'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span id="langues">Langues : <small><?= $candidature['langue'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span id="formation">Formations & Diplomes : <small><?= $candidature['formationetude'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span id="interets">Int??rets : <small><?= $candidature['interet'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span id="qualites">Mes Qualit??s : <small><?= $candidature['qualite'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span id="defauts">Mes d??fauts : <small><?= $candidature['default_candi'] ?> </small></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <span id="permis">Permis : <small><?= $candidature['permis_conduite'] ?> </small></span>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-level" role="tabpanel" aria-labelledby="list-level-list">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <?php
                                                                    if (isset($questions)) {
                                                                        for ($i = 0; $i < count($qcms); $i++) {
                                                                    ?>
                                                                            <div class="col">
                                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#qcm<?= $i ?>">
                                                                                    <?= $qcms[$i]['libelle'] ?>
                                                                                </button>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        QCMS non encore r??alis??s
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
                                                                            <a class="btn mr-1 mb-1 btn-outline-primary btn-sm" href="../../../src/recrutement/cv/<?= str_replace(" ", "%20", $candidature['cv_doc']) ?>" target="_blank" rel="noopener noreferrer"><i class='bx bx-show-alt' style=""></i> Pr??visualiser</a>
                                                                        </div>
                                                                        <div class="col">
                                                                            <a class="btn mr-1 mb-1 btn-outline-primary btn-sm" href="../../../src/recrutement/cv/<?= str_replace(" ", "%20", $candidature['cv_doc']) ?>" target="_blank" rel="noopener noreferrer" download><i class='bx bx-download' style=""></i> T??l??charger</a>
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
                                                                            <a class="btn mr-1 mb-1 btn-outline-primary btn-sm" href="../../../src/recrutement/lettredemotivation/<?= str_replace(" ", "%20", $candidature['lettredemotivation_doc']) ?>" target="_blank" rel="noopener noreferrer"><i class='bx bx-show-alt' style=""></i> Pr??visualiser</a>
                                                                        </div>
                                                                        <div class="col">
                                                                            <a class="btn mr-1 mb-1 btn-outline-primary btn-sm" href="../../../src/recrutement/lettredemotivation/<?= str_replace(" ", "%20", $candidature['lettredemotivation_doc']) ?>" target="_blank" rel="noopener noreferrer" download><i class='bx bx-download' style=""></i> T??l??charger</a>
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
                                                                            <a class="btn mr-1 mb-1 btn-outline-primary btn-sm" href="../../../src/recrutement/other/<?= str_replace(" ", "%20", $candidature['other_doc']) ?>" target="_blank" rel="noopener noreferrer"><i class='bx bx-show-alt' style=""></i> Pr??visualiser</a>
                                                                        </div>
                                                                        <div class="col">
                                                                            <a class="btn mr-1 mb-1 btn-outline-primary btn-sm" href="../../../src/recrutement/other/<?= str_replace(" ", "%20", $candidature['other_doc']) ?>" target="_blank" rel="noopener noreferrer" download><i class='bx bx-download' style=""></i> T??l??charger</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                                                            <div class="form-group text-center">
                                                                <label>Suivi de la candidature :</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <hr>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col text-center">
                                                                        <div class="form-group">
                                                                            <small>Suivi par mail effectu??</small>
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
                                                                            <small>Suivi par t??l??phone effectu??</small>
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
                                                                            <small>Test specifique effectu??</small>
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
                                                                            <small>Entretien presentiel ou visio effectu??</small>
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                                <input type="checkbox" class="custom-control-input" id="suivi_entretien" <?php if ($candidature['suivi_entretien'] == "oui") {
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
                if (isset($questions)) {
                    for ($i = 0; $i < count($qcms); $i++) {
                        $score = 0;
                        $total = 0;
                ?>
                        <!-- Modal -->
                        <div class="modal fade" id="qcm<?= $i ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Resultats du qcm : <?= $qcms[$i]['libelle'] ?></h5>
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
                                                    <h3 id="name-qcm<?= $i ?>" class="d-flex justify-content-center"><?= $qcms[$i]['libelle'] ?></h3>
                                                    <h4 id="name-candidat<?= $i ?>" class="d-flex justify-content-center" style="color: grey;"><?= $candidature['nom_candidat'] ?> <?= $candidature['prenom_candidat'] ?></h4>
                                                    <table class="table table-bordered" id="table<?= $i ?>" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Question</th>
                                                                <th>Nombre points de la question</th>
                                                                <th>R??ponse</th>
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
                                                                $total += $questions[$i][$j]['points'];
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <label id="total<?= $i ?>">Total : <?= $score ?>/<?= $total ?></label>
                                                    <br>
                                                    <label id="pourcentage<?= $i ?>">Pourcentage : <?= ($score / $total) * 100 ?>%</label>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-4">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <h3 id="name-qcm<?= $i ?>"><?= $qcms[$i]['libelle'] ?></h3>
                                                        <h4 id="name-candidat<?= $i ?>" style="color: grey;"><?= $candidature['nom_candidat'] ?> <?= $candidature['prenom_candidat'] ?></h4>
                                                    </div>
                                                    <div class="d-flex flex-column text-justify">
                                                        <p id="comment-red<?= $i ?>">

                                                        </p>
                                                        <br>
                                                        <p id="comment-blue<?= $i ?>">

                                                        </p>
                                                        <br>
                                                        <p id="comment-yellow<?= $i ?>">

                                                        </p>
                                                        <br>
                                                        <p id="comment-green<?= $i ?>">

                                                        </p>
                                                        <br>
                                                        <p id="comment-purple<?= $i ?>">

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-6 ml-auto">
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
                                                                max_value = response['max_value'];
                                                                tested_status = response['status'];
                                                                var red_last = null;
                                                                var blue_last = null;
                                                                var yellow_last = null;
                                                                var green_last = null;
                                                                var purple_last = null;

                                                                var red_deter = [response['result_rep']['parametre_rep']['A'] / max_value * 10, "D??termination", "red"];
                                                                var red_amb = [response['result_rep']['parametre_rep']['B'] / max_value * 10, "Ambition", "red"];
                                                                var red_gout = [response['result_rep']['parametre_rep']['C'] / max_value * 10, "Gout de l'effort", "red"];
                                                                var red_esp = [response['result_rep']['parametre_rep']['D'] / max_value * 10, "Esprit de comp??tition", "red"];

                                                                var red = [red_deter, red_amb, red_gout, red_esp];
                                                                var sum_red = summ(red, tested_status, 0);
                                                                var moy_red = sum_red[0] / sum_red[1]; // moyenne des valeurs differentes de null
                                                                var max_red = getMaxTableau(red);
                                                                var max2_red = getMaxTableau(red.filter(function(max) {
                                                                    return max != max_red;
                                                                }));

                                                                var blue_ais = [response['result_rep']['parametre_rep']['E'] / max_value * 10, "Assurance en public", "blue"];
                                                                var blue_ouv = [response['result_rep']['parametre_rep']['F'] / max_value * 10, "Ouverture aux autres", "blue"];
                                                                var blue_dip = [response['result_rep']['parametre_rep']['G'] / max_value * 10, "Diplomatie", "blue"];
                                                                var blue_pers = [response['result_rep']['parametre_rep']['H'] / max_value * 10, "Persuasion", "blue"];

                                                                var blue = [blue_ais, blue_ouv, blue_dip, blue_pers];
                                                                var sum_blue = summ(blue, tested_status, 1);
                                                                var moy_blue = sum_blue[0] / sum_blue[1]; // moyenne des valeurs differentes de null
                                                                var max_blue = getMaxTableau(blue);
                                                                var max2_blue = getMaxTableau(blue.filter(function(max) {
                                                                    return max != max_blue;
                                                                }));

                                                                var yellow_diri = [response['result_rep']['parametre_rep']['I'] / max_value * 10, "Diriger", "yellow"];
                                                                var yellow_rep = [response['result_rep']['parametre_rep']['J'] / max_value * 10, "Prise de responsabilit??s", "yellow"];
                                                                var yellow_org = [response['result_rep']['parametre_rep']['K'] / max_value * 10, "Organisation", "yellow"];
                                                                var yellow_visio = [response['result_rep']['parametre_rep']['L'] / max_value * 10, "Vision", "yellow"];

                                                                var yellow = [yellow_diri, yellow_rep, yellow_org, yellow_visio];
                                                                var sum_yellow = summ(yellow, tested_status, 2);
                                                                var moy_yellow = sum_yellow[0] / sum_yellow[1]; // moyenne des valeurs differentes de null
                                                                var max_yellow = getMaxTableau(yellow);
                                                                var max2_yellow = getMaxTableau(yellow.filter(function(max) {
                                                                    return max != max_yellow;
                                                                }));

                                                                var green_conf = [response['result_rep']['parametre_rep']['M'] / max_value * 10, "Confiance en soi", "green"];
                                                                var green_ind = [response['result_rep']['parametre_rep']['N'] / max_value * 10, "Ind??pendance d'esprit", "green"];
                                                                var green_crea = [response['result_rep']['parametre_rep']['O'] / max_value * 10, "Cr??ativit??", "green"];
                                                                var green_auto = [response['result_rep']['parametre_rep']['P'] / max_value * 10, "Autonomie", "green"];

                                                                var green = [green_conf, green_ind, green_crea, green_auto];
                                                                var sum_green = summ(green, tested_status, 3);
                                                                var moy_green = sum_green[0] / sum_green[1]; // moyenne des valeurs differentes de null
                                                                var max_green = getMaxTableau(green);
                                                                var max2_green = getMaxTableau(green.filter(function(max) {
                                                                    return max != max_green;
                                                                }));

                                                                var purple_gest = [response['result_rep']['parametre_rep']['Q'] / max_value * 10, "Gestion du stress", "purple"];
                                                                var purple_react = [response['result_rep']['parametre_rep']['R'] / max_value * 10, "R??activit??", "purple"];
                                                                var purple_pat = [response['result_rep']['parametre_rep']['S'] / max_value * 10, "Patience", "purple"];
                                                                var purple_resp = [response['result_rep']['parametre_rep']['T'] / max_value * 10, "Respect de la hi??rarchie", "purple"];

                                                                var purple = [purple_gest, purple_react, purple_pat, purple_resp];
                                                                var sum_purple = summ(purple, tested_status, 4);
                                                                var moy_purple = sum_purple[0] / sum_purple[1]; // moyenne des valeurs differentes de null
                                                                var max_purple = getMaxTableau(purple);
                                                                var max2_purple = getMaxTableau(purple.filter(function(max) {
                                                                    return max != max_purple;
                                                                }));

                                                                var tableVar = [];
                                                                red.forEach(function(element) {
                                                                    if (element[0] != null) {
                                                                        tableVar.push(element);
                                                                    }
                                                                });
                                                                blue.forEach(function(element) {
                                                                    if (element[0] != null) {
                                                                        tableVar.push(element);
                                                                    }
                                                                });
                                                                yellow.forEach(function(element) {
                                                                    if (element[0] != null) {
                                                                        tableVar.push(element);
                                                                    }
                                                                });
                                                                green.forEach(function(element) {
                                                                    if (element[0] != null) {
                                                                        tableVar.push(element);
                                                                    }
                                                                });
                                                                purple.forEach(function(element) {
                                                                    if (element[0] != null) {
                                                                        tableVar.push(element);
                                                                    }
                                                                });

                                                                var text_moy_red = "faible";
                                                                text_moy_red = moy_red > 3 && moy_red < 7 ? "moyenne" : text_moy_red;
                                                                text_moy_red = moy_red > 7 ? "??lev??e" : text_moy_red;
                                                                var text_red_deter = "faible";
                                                                text_red_deter = red_deter > 3 && red_deter < 7 ? "moyenne" : text_red_deter;
                                                                text_red_deter = red_deter > 7 ? "??lev??e" : text_red_deter;
                                                                var text_red_amb = "faible";
                                                                text_red_amb = red_amb > 3 && red_amb < 7 ? "moyenne" : text_red_amb;
                                                                text_red_amb = red_amb > 7 ? "??lev??e" : text_red_amb;
                                                                var text_red_gout = "faible";
                                                                text_red_gout = red_gout > 3 && red_gout < 7 ? "moyenne" : text_red_gout;
                                                                text_red_gout = red_gout > 7 ? "??lev??e" : text_red_gout;
                                                                var text_red_esp = "faible";
                                                                text_red_esp = red_esp > 3 && red_esp < 7 ? "moyenne" : text_red_esp;
                                                                text_red_esp = red_esp > 7 ? "??lev??e" : text_red_esp;

                                                                var text_moy_blue = "faible";
                                                                text_moy_blue = moy_blue > 3 && moy_blue < 7 ? "moyenne" : text_moy_blue;
                                                                text_moy_blue = moy_blue > 7 ? "??lev??e" : text_moy_blue;
                                                                var text_blue_ais = "faible";
                                                                text_blue_ais = blue_ais > 3 && blue_ais < 7 ? "moyenne" : text_blue_ais;
                                                                text_blue_ais = blue_ais > 7 ? "??lev??e" : text_blue_ais;
                                                                var text_blue_ouv = "faible";
                                                                text_blue_ouv = blue_ouv > 3 && blue_ouv < 7 ? "moyenne" : text_blue_ouv;
                                                                text_blue_ouv = blue_ouv > 7 ? "??lev??e" : text_blue_ouv;
                                                                var text_blue_dip = "faible";
                                                                text_blue_dip = blue_dip > 3 && blue_dip < 7 ? "moyenne" : text_blue_dip;
                                                                text_blue_dip = blue_dip > 7 ? "??lev??e" : text_blue_dip;
                                                                var text_blue_pers = "faible";
                                                                text_blue_pers = blue_pers > 3 && blue_pers < 7 ? "moyenne" : text_blue_pers;
                                                                text_blue_pers = blue_pers > 7 ? "??lev??e" : text_blue_pers;

                                                                var text_moy_yellow = "faible";
                                                                text_moy_yellow = moy_yellow > 3 && moy_yellow < 7 ? "moyenne" : text_moy_yellow;
                                                                text_moy_yellow = moy_yellow > 7 ? "??lev??e" : text_moy_yellow;
                                                                var text_yellow_diri = "faible";
                                                                text_yellow_diri = yellow_diri > 3 && yellow_diri < 7 ? "moyenne" : text_yellow_diri;
                                                                text_yellow_diri = yellow_diri > 7 ? "??lev??e" : text_yellow_diri;
                                                                var text_yellow_rep = "faible";
                                                                text_yellow_rep = yellow_rep > 3 && yellow_rep < 7 ? "moyenne" : text_yellow_rep;
                                                                text_yellow_rep = yellow_rep > 7 ? "??lev??e" : text_yellow_rep;
                                                                var text_yellow_org = "faible";
                                                                text_yellow_org = yellow_org > 3 && yellow_org < 7 ? "moyenne" : text_yellow_org;
                                                                text_yellow_org = yellow_org > 7 ? "??lev??e" : text_yellow_org;
                                                                var text_yellow_visio = "faible";
                                                                text_yellow_visio = yellow_visio > 3 && yellow_visio < 7 ? "moyenne" : text_yellow_visio;
                                                                text_yellow_visio = yellow_visio > 7 ? "??lev??e" : text_yellow_visio;

                                                                var text_moy_green = "faible";
                                                                text_moy_green = moy_green > 3 && moy_green < 7 ? "moyenne" : text_moy_green;
                                                                text_moy_green = moy_green > 7 ? "??lev??e" : text_moy_green;
                                                                var text_green_conf = "faible";
                                                                text_green_conf = green_conf > 3 && green_conf < 7 ? "moyenne" : text_green_conf;
                                                                text_green_conf = green_conf > 7 ? "??lev??e" : text_green_conf;
                                                                var text_green_ind = "faible";
                                                                text_green_ind = green_ind > 3 && green_ind < 7 ? "moyenne" : text_green_ind;
                                                                text_green_ind = green_ind > 7 ? "??lev??e" : text_green_ind;
                                                                var text_green_crea = "faible";
                                                                text_green_crea = green_crea > 3 && green_crea < 7 ? "moyenne" : text_green_crea;
                                                                text_green_crea = green_crea > 7 ? "??lev??e" : text_green_crea;
                                                                var text_green_auto = "faible";
                                                                text_green_auto = green_auto > 3 && green_auto < 7 ? "moyenne" : text_green_auto;
                                                                text_green_auto = green_auto > 7 ? "??lev??e" : text_green_auto;

                                                                var text_moy_purple = "faible";
                                                                text_moy_purple = moy_purple > 3 && moy_purple < 7 ? "moyenne" : text_moy_purple;
                                                                text_moy_purple = moy_purple > 7 ? "??lev??e" : text_moy_purple;
                                                                var text_purple_gest = "faible";
                                                                text_purple_gest = purple_gest > 3 && purple_gest < 7 ? "moyenne" : text_purple_gest;
                                                                text_purple_gest = purple_gest > 7 ? "??lev??e" : text_purple_gest;
                                                                var text_purple_react = "faible";
                                                                text_purple_react = purple_react > 3 && purple_react < 7 ? "moyenne" : text_purple_react;
                                                                text_purple_react = purple_react > 7 ? "??lev??e" : text_purple_react;
                                                                var text_purple_pat = "faible";
                                                                text_purple_pat = purple_pat > 3 && purple_pat < 7 ? "moyenne" : text_purple_pat;
                                                                text_purple_pat = purple_pat > 7 ? "??lev??e" : text_purple_pat;
                                                                var text_purple_resp = "faible";
                                                                text_purple_resp = purple_resp > 3 && purple_resp < 7 ? "moyenne" : text_purple_resp;
                                                                text_purple_resp = purple_resp > 7 ? "??lev??e" : text_purple_resp;

                                                                var max_moy = getMaxTableau([moy_red, moy_green, moy_blue, moy_purple, moy_yellow]);
                                                                if (!isNaN(moy_red)) {
                                                                    document.getElementById("comment-red<?= $i ?>").innerHTML = "Performance individuelle " + text_moy_red + "(" + (moy_red * 10) + "%).";
                                                                }
                                                                if (!isNaN(moy_blue)) {
                                                                    document.getElementById("comment-blue<?= $i ?>").innerHTML = "Capacit?? de communication interpersonnelle " + text_moy_blue + "(" + (moy_blue * 10) + "%).";
                                                                }
                                                                if (!isNaN(moy_yellow)) {
                                                                    document.getElementById("comment-yellow<?= $i ?>").innerHTML = "Capacit?? de manager " + text_moy_yellow + "(" + (moy_yellow * 10) + "%).";
                                                                }
                                                                if (!isNaN(moy_green)) {
                                                                    document.getElementById("comment-green<?= $i ?>").innerHTML = "Autonomie " + text_moy_green + "(" + (moy_green * 10) + "%).";
                                                                }
                                                                if (!isNaN(moy_purple)) {
                                                                    document.getElementById("comment-purple<?= $i ?>").innerHTML = "Ma??trise de soi " + text_moy_purple + "(" + (moy_purple * 10) + "%).";
                                                                }

                                                                // methode filter

                                                                var finalVar = [];
                                                                var finalLabel = [];
                                                                var red = [];
                                                                var blue = [];
                                                                var yellow = [];
                                                                var green = [];
                                                                var purple = [];
                                                                for (let i = 0; i < tableVar.length; i++) {
                                                                    var contains = tested_status.some(elem => {
                                                                        return JSON.stringify({
                                                                            "statu": tableVar[i][1]
                                                                        }) === JSON.stringify(elem);
                                                                    });
                                                                    if (contains) {
                                                                        finalLabel.push(tableVar[i][1]);
                                                                        if (tableVar[i][2] == "red") {
                                                                            red.push(tableVar[i][0]);
                                                                            blue.push(0);
                                                                            yellow.push(0);
                                                                            green.push(0);
                                                                            purple.push(0);
                                                                        } else if (tableVar[i][2] == "blue") {
                                                                            if (i != 0 && blue.every(item => item === 0)) {
                                                                                if (tableVar[i - 1][2] == 'red') {
                                                                                    red[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'yellow') {
                                                                                    yellow[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'green') {
                                                                                    green[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'purple') {
                                                                                    purple[i] = tableVar[i][0];
                                                                                }
                                                                            }
                                                                            blue.push(tableVar[i][0]);
                                                                            red.push(0);
                                                                            yellow.push(0);
                                                                            green.push(0);
                                                                            purple.push(0);
                                                                        } else if (tableVar[i][2] == "yellow") {
                                                                            if (i != 0 && yellow.every(item => item === 0)) {
                                                                                if (tableVar[i - 1][2] == 'red') {
                                                                                    red[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'blue') {
                                                                                    blue[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'green') {
                                                                                    green[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'purple') {
                                                                                    purple[i] = tableVar[i][0];
                                                                                }
                                                                            }
                                                                            yellow.push(tableVar[i][0]);
                                                                            blue.push(0);
                                                                            red.push(0);
                                                                            green.push(0);
                                                                            purple.push(0);
                                                                        } else if (tableVar[i][2] == "green") {
                                                                            if (i != 0 && green.every(item => item === 0)) {
                                                                                if (tableVar[i - 1][2] == 'red') {
                                                                                    red[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'blue') {
                                                                                    blue[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'yellow') {
                                                                                    yellow[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'purple') {
                                                                                    purple[i] = tableVar[i][0];
                                                                                }
                                                                            }
                                                                            green.push(tableVar[i][0]);
                                                                            blue.push(0);
                                                                            yellow.push(0);
                                                                            red.push(0);
                                                                            purple.push(0);
                                                                        } else {
                                                                            if (i != 0 && purple.every(item => item === 0)) {
                                                                                if (tableVar[i - 1][2] == 'red') {
                                                                                    red[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'blue') {
                                                                                    blue[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'yellow') {
                                                                                    yellow[i] = tableVar[i][0];
                                                                                } else if (tableVar[i - 1][2] == 'green') {
                                                                                    green[i] = tableVar[i][0];
                                                                                }
                                                                            }
                                                                            purple.push(tableVar[i][0]);
                                                                            blue.push(0);
                                                                            yellow.push(0);
                                                                            green.push(0);
                                                                            red.push(0);
                                                                        }
                                                                    }
                                                                }
                                                                if (tableVar[tableVar.length - 1][2] == 'red') {
                                                                    red[0] = tableVar[tableVar.length - 1][0];
                                                                } else if (tableVar[tableVar.length - 1][2] == 'blue') {
                                                                    blue[0] = tableVar[tableVar.length - 1][0];
                                                                } else if (tableVar[tableVar.length - 1][2] == 'yellow') {
                                                                    yellow[0] = tableVar[tableVar.length - 1][0];
                                                                } else if (tableVar[tableVar.length - 1][2] == 'green') {
                                                                    purple[0] = tableVar[tableVar.length - 1][0];
                                                                }
                                                                var ctx = document.getElementById('myChart<?= $i ?>').getContext('2d');
                                                                var myChart = new Chart(ctx, {
                                                                    type: 'radar',
                                                                    data: {
                                                                        labels: finalLabel,
                                                                        datasets: [{
                                                                                label: 'Performance individuelle',
                                                                                data: red,
                                                                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                                                borderColor: 'rgb(255, 99, 132)',
                                                                                borderWidth: 1
                                                                            },
                                                                            {
                                                                                label: 'Capacit?? de communication interpersonnelle',
                                                                                data: blue,
                                                                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                                                borderColor: 'rgb(54, 162, 235)',
                                                                                borderWidth: 1
                                                                            },
                                                                            {
                                                                                label: 'Capacit?? de manager',
                                                                                data: yellow,
                                                                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                                                                borderColor: 'rgb(255, 206, 86)',
                                                                                borderWidth: 1
                                                                            },
                                                                            {
                                                                                label: 'Autonomie',
                                                                                data: green,
                                                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                                                borderColor: 'rgb(75, 192, 192)',
                                                                                borderWidth: 1
                                                                            },
                                                                            {
                                                                                label: 'Ma??trise de soi',
                                                                                data: purple,
                                                                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                                                                borderColor: 'rgba(153, 102, 255)',
                                                                                borderWidth: 1
                                                                            }
                                                                        ]
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
                                                                console.log(response);
                                                            },
                                                            complete: function(response) {
                                                                console.log('complete');
                                                            }
                                                        });

                                                        function getMaxTableau(tableauNum??rique) {
                                                            return Math.max.apply(null, tableauNum??rique);
                                                        }

                                                        function summ(table, tested_status, id) {
                                                            var sumtable = [];
                                                            let sum = 0;
                                                            let nonvide = 0;

                                                            for (let b = 0; b < table.length; b++) {
                                                                var contains = tested_status.some(elem => {
                                                                    return JSON.stringify({
                                                                        "statu": table[b][1]
                                                                    }) === JSON.stringify(elem);
                                                                });
                                                                if (contains) {
                                                                    nonvide++;
                                                                } else {
                                                                    table[b][0] = null;
                                                                }
                                                                sum += table[b][0];
                                                            }
                                                            sumtable[0] = sum;
                                                            sumtable[1] = nonvide;
                                                            return sumtable;
                                                        }
                                                    </script>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" id="exportPdf<?= $i ?>">T??l??charger</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <?php
                if ($candidature['statut'] == "En cours" and isset($questions)) {
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
                                                    <a href="php/edit_rh_statut.php?num=<?= $_GET['num'] ?>&type=<?= htmlentities("Admis ?? entretien") ?>"><button type="button" class="btn mb-1 btn-outline-success btn-lg btn-block">Accepter le candidat</button></a>
                                                </div>
                                                <div class="col">
                                                    <a href="php/edit_rh_statut.php?num=<?= $_GET['num'] ?>&type=<?= htmlentities("Refus?? avant entretien") ?>"><button type="button" class="btn mb-1 btn-outline-danger btn-lg btn-block">Refuser le candidat</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                }
                ?>
            </div>
            <!-- Block level buttons end -->
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
    <script src="../../../cuba/assets/js/bootstrap/popper.min.js"></script>
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
                    var doc = new jspdf.jsPDF('p', 'pt', 'a4');
                    var qcm = document.querySelector('#name-qcm' + val).innerText;

                    doc.setFontSize(20);
                    doc.text('R??sultat du qcm : ' + qcm, doc.internal.pageSize.width / 2, 60, null, null, 'center');

                    doc.setFontSize(18);
                    doc.text("Informations sur le candidat", doc.internal.pageSize.width / 2, 80, null, null, 'center');
                    // Recuperation du texte a afficher
                    var text = [];
                    text.push(document.querySelector('#nom').innerText);
                    text.push(document.querySelector('#prenom').innerText);
                    text.push(document.querySelector('#age').innerText);
                    text.push(document.querySelector('#specialite').innerText);
                    text.push(document.querySelector('#logiciels').innerText);
                    text.push(document.querySelector('#langues').innerText);
                    text.push(document.querySelector('#formation').innerText);
                    text.push(document.querySelector('#interets').innerText);
                    text.push(document.querySelector('#qualites').innerText);
                    text.push(document.querySelector('#defauts').innerText);
                    text.push(document.querySelector('#permis').innerText);
                    doc.setFontSize(12);
                    doc.text(text, doc.internal.pageSize.width / 15, 98, null, null, 'left');

                    doc.setFontSize(18);
                    doc.text("R??sultats", doc.internal.pageSize.width / 2, 260, null, null, 'center');

                    doc.setFontSize(12);
                    doc.text(document.querySelector('#total' + val).innerText, doc.internal.pageSize.width - 40, 278, null, null, 'right');
                    doc.text(document.querySelector('#pourcentage' + val).innerText, doc.internal.pageSize.width - 40, 296, null, null, 'right');
                    doc.autoTable({
                        html: '#table' + val,
                        startY: 314,

                        margin: {
                            horizontal: 40
                        },
                        styles: {
                            overflow: "linebreak"
                        },
                        bodyStyles: {
                            valign: "top"
                        },
                        columnStyles: {
                            email: {
                                cellWidth: "wrap"
                            }
                        },
                        theme: "striped",
                        showHead: "everyPage",
                        didDrawPage: function(data) {
                            // Header
                            doc.addImage("../../../app-assets/images/logo/coqpix2.png", 'PNG', data.settings.margin.left, 15, 100, 20);
                            doc.setFontSize(20);
                            doc.text("<?= $entreprise['nameentreprise'] ?>", doc.internal.pageSize.width - 40, 30, null, null, "right");

                            // Footer
                            var str = "Page " + doc.internal.getNumberOfPages();

                            doc.setFontSize(8);

                            // jsPDF 1.4+ uses getWidth, <1.4 uses .width
                            var pageSize = doc.internal.pageSize;
                            var pageHeight = pageSize.height ?
                                pageSize.height :
                                pageSize.getHeight();
                            doc.text(str, doc.internal.pageSize.width - 30, pageHeight - 10);
                        }
                    });
                    doc.save("table.pdf");
                } else {
                    var doc = new jspdf.jsPDF('p', 'pt', 'a4');

                    // Header
                    doc.addImage("../../../app-assets/images/logo/coqpix2.png", 'PNG', doc.internal.pageSize.width / 15, 15, 100, 20);
                    doc.setFontSize(20);
                    doc.text("<?= $entreprise['nameentreprise'] ?>", doc.internal.pageSize.width - 40, 30, null, null, "right");

                    // Footer
                    var str = "Page " + doc.internal.getNumberOfPages();

                    doc.setFontSize(8);

                    // jsPDF 1.4+ uses getWidth, <1.4 uses .width
                    var pageSize = doc.internal.pageSize;
                    var pageHeight = pageSize.height ?
                        pageSize.height :
                        pageSize.getHeight();
                    doc.text(str, doc.internal.pageSize.width - 30, pageHeight - 10);

                    var qcm = document.querySelector('#name-qcm' + val).innerText;

                    doc.setFontSize(20);
                    doc.text('R??sultat du qcm : ' + qcm, doc.internal.pageSize.width / 2, 60, null, null, 'center');

                    doc.setFontSize(18);
                    doc.text("Informations sur le candidat", doc.internal.pageSize.width / 2, 80, null, null, 'center');
                    // Recuperation du texte a afficher
                    var text = [];
                    text.push(document.querySelector('#nom').innerText);
                    text.push(document.querySelector('#prenom').innerText);
                    text.push(document.querySelector('#age').innerText);
                    text.push(document.querySelector('#specialite').innerText);
                    text.push(document.querySelector('#logiciels').innerText);
                    text.push(document.querySelector('#langues').innerText);
                    text.push(document.querySelector('#formation').innerText);
                    text.push(document.querySelector('#interets').innerText);
                    text.push(document.querySelector('#qualites').innerText);
                    text.push(document.querySelector('#defauts').innerText);
                    text.push(document.querySelector('#permis').innerText);
                    doc.setFontSize(12);
                    doc.text(text, doc.internal.pageSize.width / 15, 98, null, null, 'left');

                    doc.setFontSize(18);
                    doc.text("R??sultats", doc.internal.pageSize.width / 2, 260, null, null, 'center');
                    text = [];
                    text.push(document.querySelector('#comment-red' + val).innerText);
                    text.push(document.querySelector('#comment-blue' + val).innerText);
                    text.push(document.querySelector('#comment-yellow' + val).innerText);
                    text.push(document.querySelector('#comment-green' + val).innerText);
                    text.push(document.querySelector('#comment-purple' + val).innerText);
                    doc.setFontSize(12);
                    doc.text(text, doc.internal.pageSize.width / 15, 278, null, null, 'left');

                    doc.addImage(document.getElementById('myChart' + val).toDataURL("image/png"), 'PNG', doc.internal.pageSize.width / 6, 340, 400, 400);
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