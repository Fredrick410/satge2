<?php
error_reporting(E_ALL);
session_start();
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$explode = explode(';', $_GET['key']);

$num = $explode[2];

$pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
$pdoSta->bindValue(':num', $num);
$pdoSta->execute();
$annonce = $pdoSta->fetch();

$pdoSta = $bdd->prepare("SELECT COUNT(*) AS nb FROM reponses_qcm_candidat INNER JOIN rh_candidature ON (rh_candidature.id = reponses_qcm_candidat.idcandidat) WHERE key_candidat=:key_candidat");
$pdoSta->bindValue(':key_candidat', $_GET['key']);
$pdoSta->execute();
$reponses_candidat = $pdoSta->fetch(PDO::FETCH_ASSOC);
if($reponses_candidat['nb'] != 0){
    $_SESSION['message'] = 'Vous avez déjà passé cette étape';
    header("Location: candidature-recrutement.php?num=$num");
}

if(!isset($_SESSION['key_candidat'])){
    $_SESSION['key_candidat'] = $_GET['key'];
}

if (isset($_POST['code_annonce'])) {

    $code = $_POST['code_annonce'];
    $name = $_GET['annonce'];

    $query = $bdd->prepare("SELECT * FROM rh_annonce WHERE code_annonce = :code");
    $query->bindValue(':code', $code);
    $query->execute();
    $count = $query->rowCount();

    if ($count >= 1) {
        $_SESSION['invite'] = $_GET['num'];

        header('Location: candidature-recrutement.php?' . $annonce['link'] . '$req=true');
        exit();
    } else {

        header('Location: candidature-recrutement.php?' . $annonce['link'] . '&req=false');
        exit();
    }
}

if ($annonce['code_annonce'] == "") {
    $locked = "red";
    $none_bts = "";
    $none_btd = "none-validation";
} else {
    if (empty($_SESSION['invite'])) {
        $locked = "red";
        $none_bts = "";
        $none_btd = "none-validation";
    } else {
        $locked = "green";
        $none_bts = "none-validation";
        $none_btd = "";
    }
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
    <title>Annonce de recrutement</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    <style>
        .none-validation {
            display: none;
        }

        .text_a {
            color: grey;
            cursor: pointer;
        }

        .text_a:hover {
            color: orange;
        }
    </style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: <?= $annonce['color_annonce'] ?>;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="#">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding: 0px; margin: 0px;">
            <div class="content-body">
                <div class="form-group">
                    <div class="form-group text-center">
                        <h4>Etape 3 - Téléchargement des fichiers</h4>
                    </div>
                    <div class="form-group">
                        <h5 style='padding-left: 20px;'>Annonce N°<?= $annonce['id'] ?> - <?= $annonce['name_annonce'] ?> - <?php if ($candidat['sexe_candidat'] == "femme") {
                                                                                                                                echo "Mme " . $candidat['nom_candidat'] . "";
                                                                                                                            } else {
                                                                                                                                echo 'Mr ' . $candidat['nom_candidat'] . '';
                                                                                                                            } ?> <p style="display: inline; color: <?php if ($annonce['statut'] == "actif") {
                                                                                                                                                                        echo "green";
                                                                                                                                                                    } else {
                                                                                                                                                                        echo 'red';
                                                                                                                                                                    } ?>;">(<?php if ($annonce['statut'] == "actif") {
                                                                                                                                                                                echo "Actif";
                                                                                                                                                                            } else {
                                                                                                                                                                                echo 'En pause';
                                                                                                                                                                            } ?>)</p>
                        </h5>
                    </div>
                    <div class="form-group" style='padding-left: 20px;'>
                        <div class="form-group line">
                            <h4>CONDITIONS D'ACCEPTATIONS</h4>
                        </div>
                        <div class="form-group">
                            <p>Les documents demandés devront respecter l'intégralité des conditions sous peine d'un refus de candidature.</p>
                            <div class="form-group">
                                <p>Les documents devront :</p>
                                <label> - Être fournis sous un format numérique de préférence en PDF. (PNG, JPG, JPEG)</label><br>
                                <label> - Être fournis en intégralité (Tous les bords visibles)</label><br>
                                <label> - Être fournis en couleur de préférence.</label><br>
                                <label> - Être parfaitement nets et visibles</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col border <?php if ($candidat['cv_doc'] !== "") {
                                                    echo "none-validation";
                                                } ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Dépot de votre CV</label>
                            </div>
                            <div class="form-group">
                                <a href="https://www.cidj.com/emploi-jobs-stages/nos-conseils-pour-trouver-un-job-ou-un-emploi/comment-rediger-son-cv-pour-trouver-un-emploi" target="_blank"><small class="text_a">Comment bien réaliser son cv ?</small></a>
                            </div>
                            <div class="form-group">
                                <label>Mon cv</label>
                                <a href="candidature-recrutement-files-two.php?key=<?= $_GET['key'] ?>&document=cv">
                                    <div class="custom-file" style="cursor: pointer;">
                                        <input class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col border <?php if ($candidat['cv_doc'] == "") {
                                                    echo "none-validation";
                                                } ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Cv déja deposé !</label>
                            </div>
                            <div class="form-group">
                                <hr>
                            </div>
                            <div class="form-group">
                                <p><?= $candidat['cv_doc'] ?> <a id="cv" href="../../../src/recrutement/cv/<?= $candidat['cv_doc'] ?>" download><i class="bx bx-download"></i></a><a href="#" id="delete-cv" class="bx bx-trash"></a></p>
                            </div>
                        </div>
                        <div class="col border <?php if ($candidat['lettredemotivation_doc'] !== "") {
                                                    echo "none-validation";
                                                } ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Dépot de la lettre de motivation</label>
                            </div>
                            <div class="form-group">
                                <a href="https://www.jobup.ch/fr/job-coach/conseils-checklistes/comment-rediger-une-bonne-lettre-de-motivation/" target="_blank"><small class="text_a">Comment bien écrire ma lettre de motivation ?</small></a>
                            </div>
                            <div class="form-group">
                                <label>Ma lettre de motivation</label>
                                <a href="candidature-recrutement-files-two.php?key=<?= $_GET['key'] ?>&document=lettredemotivation">
                                    <div class="custom-file" style="cursor: pointer;">
                                        <input class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col border <?php if ($candidat['lettredemotivation_doc'] == "") {
                                                    echo "none-validation";
                                                } ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Lettre de motivation déja deposé !</label>
                            </div>
                            <div class="form-group">
                                <hr>
                            </div>
                            <div class="form-group">
                                <p><?= $candidat['lettredemotivation_doc'] ?> <a id="lettredemotivation" href="../../../src/recrutement/lettredemotivation/<?= $candidat['lettredemotivation_doc'] ?>" download><i class="bx bx-download"></i></a><a href="#" id="delete-lettredemotivation" class="bx bx-trash"></a></p>
                            </div>
                        </div>
                        <div class="col border <?php if ($candidat['other_doc'] !== "") {
                                                    echo "none-validation";
                                                } ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Dépot de documents supplementaires</label>
                            </div>
                            <div class="form-group">
                                <br>
                            </div>
                            <div class="form-group">
                                <label>Autres documents</label>
                                <a href="candidature-recrutement-files-two.php?key=<?= $_GET['key'] ?>&document=other">
                                    <div class="custom-file" style="cursor: pointer;">
                                        <input class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col border <?php if ($candidat['other_doc'] == "") {
                                                    echo "none-validation";
                                                } ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Autre document déja deposé !</label>
                            </div>
                            <div class="form-group">
                                <hr>
                            </div>
                            <div class="form-group">
                                <p><?= $candidat['other_doc'] ?> <a id="other" href="../../../src/recrutement/other/<?= $candidat['other_doc'] ?>" download><i class="bx bx-download"></i></a><a href="#" id="delete-other" class="bx bx-trash"></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="message">
                </div>
                <form action="php/valider_documents.php" method="post">
                    <div class="form-group text-center">
                        <!-- Button trigger for default modal -->
                        <button type="submit" class="btn btn-outline-success" name="confirm" value="confirm">
                            Validation de vos documents
                        </button>
                        <input type="hidden" name="key" value="<?= htmlspecialchars($_GET['key']) ?>">
                    </div>
                </form>
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
    <script src="../../../cuba/assets/js/jquery-3.5.1.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/modal/components-modal.js"></script>
    <script>
        function addAlert(message, type) {
            if (type == "success") {
                $('#message').html(
                    '<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>' + message + '</div>');
            } else {
                $('#message').html(
                    '<div class="alert alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>' + message + '</div>');
            }
        }

        $(document).ready(function() {
            $('#delete-cv').click(function() {
                key = '<?= htmlspecialchars($_GET['key']) ?>';
                cv = document.getElementById('cv').href;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/delete-file.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        filepath: cv,
                        key: key
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            window.location.reload();
                        } else {
                            addAlert(data.message);
                        }
                    }
                });
            });

            $('#delete-lettredemotivation').click(function() {
                key = '<?= htmlspecialchars($_GET['key']) ?>';
                cv = document.getElementById('lettredemotivation').href;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/delete-file.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        filepath: cv,
                        key: key
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            window.location.reload();
                        } else {
                            addAlert(data.message);
                        }
                    }
                });
            });

            $('#delete-other').click(function() {
                key = '<?= htmlspecialchars($_GET['key']) ?>';
                cv = document.getElementById('other').href;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/delete-file.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        filepath: cv,
                        key: key
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            window.location.reload();
                        } else {
                            addAlert(data.message);
                        }
                    }
                });
            });
        });
    </script>
    <!-- END: Page JS-->
</body>
<!-- END: Body-->

</html>