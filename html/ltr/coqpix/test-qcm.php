<?php
error_reporting(E_ALL);
session_start();
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$explode = explode(';', htmlspecialchars($_GET['key']));

$num = $explode[2];

$pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
$pdoSta->bindValue(':num', htmlspecialchars($num));
$pdoSta->execute();
$annonce = $pdoSta->fetch();

$pdoStt = $bdd->prepare('SELECT * FROM qcm INNER JOIN rh_annonce_qcm ON (qcm.id = rh_annonce_qcm.idqcm) WHERE idannonce = :num');
$pdoStt->bindValue(':num', $annonce['id']);
$pdoStt->execute();
$qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

foreach ($qcms as $key => $value) {
    $pdoStt = $bdd->prepare('SELECT * FROM question WHERE idqcm = :id');
    $pdoStt->bindValue(':id', htmlspecialchars($value['id']));
    $pdoStt->execute();
    $questions[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
}

foreach ($questions as $key => $desquestions) {
    foreach ($desquestions as $key => $question) {
        $pdoStt = $bdd->prepare('SELECT * FROM reponse WHERE idquestion = :id ORDER BY idquestion, id');
        $pdoStt->bindValue(':id', htmlspecialchars($question['id']));
        $pdoStt->execute();
        $desreponses[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
    }
    $reponses[] = $desreponses;
    unset($desreponses);
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

        ;
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
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding: 0px; margin: 0px;">
            <div class="content-body">
                <div id="validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h4 class="card-title">TESTS</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="#" class="wizard-horizontal" role="application" id="qcm-form">
                                            <?php
                                            for ($i = 0; $i < count($qcms); $i++) {
                                            ?>
                                                <!-- Step 1 -->
                                                <h6 tabindex="-1" class="title current">
                                                    <i class="step-icon bx bx-time-five"></i>
                                                    <span><?= $qcms[$i]['libelle'] ?></span>
                                                </h6>
                                                <!-- Step 1 -->
                                                <!-- body content of step 1 -->
                                                <fieldset role="tabpanel" class="body current" aria-hidden="false">
                                                    <?php
                                                    for ($j = 0; $j < count($questions[$i]); ++$j) {
                                                    ?>
                                                        <div class="border rounded mb-1">
                                                            <div class="col-12">
                                                                <legend>
                                                                    <?= $questions[$i][$j]['libelle'] ?>
                                                                </legend>
                                                            </div>
                                                            <?php
                                                            foreach ($reponses[$i][$j] as $key => $val) {
                                                            ?>
                                                                <div class='form-group col-12'>
                                                                    <input type='checkbox' id="reponse<?= $val['id'] ?>" name='reponses<?= $val['idquestion'] ?>[]' value='<?= $val['id'] ?>'>
                                                                    <label for='reponse<?= $val['id'] ?>'><?= $val['libelle'] ?></label>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </fieldset>
                                                <!-- body content of step 1 end -->
                                            <?php
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <div id="insertHere">
    </div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">2020 &copy; PIXINVENT</span><span class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
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
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script>
        function addAlert(message, type) {
            if (type == "create") {
                $('#create_form').append(
                    '<div class="alert alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>' + message + '</div>');
            } else {
                $('#update_form').append(
                    '<div class="alert alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>' + message + '</div>');
            }
        }

        //    Wizard tabs with icons setup
        // ------------------------------
        $(".wizard-horizontal").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: 'Submit'
            },
            onFinished: function(event, currentIndex) {
                var valid = 0;
                var total = 0;
                <?php
                for ($i = 0; $i < count($qcms); $i++) {
                    for ($j = 0; $j < count($questions[$i]); ++$j) {
                ?>
                        var question<?= $questions[$i][$j]['id'] ?> = [];
                    <?php
                    }
                }
                for ($i = 0; $i < count($qcms); $i++) {
                    for ($j = 0; $j < count($questions[$i]); ++$j) {
                    ?>
                        if ($(this).find('input[name="reponses<?= $reponses[$i][$j][0]['idquestion'] ?>[]"]:checked').length > 0) {
                            valid++;
                            $('input[name="reponses<?= $reponses[$i][$j][0]['idquestion'] ?>[]"]:checked').each(function() {
                                question<?= $reponses[$i][$j][0]['idquestion'] ?>.push($(this).val());
                            });
                        }
                        total++;
                <?php
                    }
                }
                ?>
                if (valid != total)
                    addAlert("Merci de selectionner au moins une reponse par question", 'error');
                else {
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/insert_resultat_test_qcm_candidature.php", //new path, save your work first before u try
                        type: "POST",
                        dataType: 'json',
                        data: {
                            <?php
                            for ($i = 0; $i < count($qcms); $i++) {
                                for ($j = 0; $j < count($questions[$i]); ++$j) {
                            ?>
                                    question<?= $questions[$i][$j]['id'] ?>: question<?= $questions[$i][$j]['id'] ?>,
                            <?php
                                }
                            }
                            ?>
                            key: '<?= htmlspecialchars($_GET['key']) ?>'
                        },
                        success: function(data) {
                            if (data.status == "success") {
                                addAlert("Candidature finalisée", "success");
                                window.setTimeout(function() {
                                    window.location.href = data.link;
                                }, 2000);
                            } else {
                                addAlert(data.message, "error");
                            }
                        }
                    });
                }
            }
        });
    </script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>