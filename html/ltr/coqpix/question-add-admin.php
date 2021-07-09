<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

if (!isset($_GET['id']))
    header('Location: rh-recrutement-entretient.php');
elseif (empty($_GET['id'])) {
    header('Location: rh-recrutement-entretient.php');
}

$pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = :id');
$pdoStt->bindValue(':id', htmlspecialchars($_GET['id']));
$pdoStt->execute();
$qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

if (count($qcms) != 1) {
    header('Location: rh-recrutement-entretient.php');
}

$pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
$pdoSta->bindValue(':num', $_SESSION['id_admin'], PDO::PARAM_INT); //$_SESSION
$pdoSta->execute();
$entreprise = $pdoSta->fetch();

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Ajouter une question - <?= $qcms[0]['libelle'] ?></title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/dragula.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-analytics.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

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
                <ul class="nav navbar-nav">
                    <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav bookmark-icons">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour">
                            <div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div>
                        </a></li>
                </ul>
                <script>
                    function retourn() {
                        window.history.back();
                    }
                </script>
                <!-- app qcm View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- qcm view page -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Ajouter une question - <?= $qcms[0]['libelle'] ?></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                        <form autocomplete="off">
                                            <div class="card-body pt-50">
                                                <!-- product details table-->
                                                <div class="invoice-product-details ">
                                                    <div class="form-group">
                                                        <label for="libelle" class="col-form-label">Libellé</label>
                                                        <input class="form-control" type="text" name="libelle" id="libelle" placeholder="Qui êtes vous?">
                                                    </div>

                                                    <?php
                                                    if ($qcms[0]['qualitatif'] == "Oui") {
                                                    ?>

                                                        <div class="form-group">
                                                            <label for="critere" class="col-form-label">Critère evalué</label>
                                                            <select class="form-control" name="critere" id="critere">
                                                                <option value="">Sélectionner un critère d'évaluation</option>
                                                                <option>paramA</option>
                                                                <option>paramB</option>
                                                                <option>paramC</option>
                                                                <option>paramD</option>
                                                                <option>paramE</option>
                                                            </select>
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="points" class="col-form-label">Points</label>
                                                        <input class="form-control" type="number" step="1" name="points" <?php if ($qcms[0]['qualitatif'] == "Oui") {
                                                                                                                                echo "value=\"1\" disabled";
                                                                                                                            } ?> id="points" placeholder="1">
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="border rounded mb-1">
                                                            <div class="col-12 form-group">
                                                                <label for="reponse">Réponse</label>
                                                                <input name="reponse" id="reponse" type="text" class="form-control" placeholder="Je suis ... ">
                                                            </div>
                                                            <?php
                                                            if ($qcms[0]['qualitatif'] == "Non") {
                                                            ?>
                                                                <div class="col-12 form-group">
                                                                    <label for="vraioufaux">Vrai ou faux :</label>
                                                                    <select name="vraioufaux" id="vraioufaux" class="form-control">
                                                                        <option value="">Choisissez Vrai ou Faux</option>
                                                                        <option>Vrai</option>
                                                                        <option>Faux</option>
                                                                    </select>
                                                                </div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="col-12 form-group">
                                                                    <label for="critere_reponse" class="col-form-label">Sous critère evalué</label>
                                                                    <select class="form-control" name="critere_reponse" id="critere_reponse">
                                                                        <option value="">Sélectionner un sous critère</option>
                                                                    </select>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <div class="col-12 form-group">
                                                                <div class="col p-0">
                                                                    <button class="btn btn-light-primary btn-sm" type="button">
                                                                        <i class="bx bx-plus"></i>
                                                                        <span id="button_send" class="invoice-repeat-btn">Ajouter la réponse</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Liste des réponses</label>
                                                        <table id="table" name="table" class="table table-bordered">
                                                            <style>
                                                                .red {
                                                                    color: red;
                                                                }

                                                                .line {
                                                                    text-decoration: underline;
                                                                }
                                                            </style>
                                                            <thead>
                                                                <tr>
                                                                    <th>Libellé de la réponse</th>
                                                                    <?php
                                                                    if ($qcms[0]['qualitatif'] == "Non") {
                                                                    ?>
                                                                        <th>Vrai ou faux :</th>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <th>Sous critère evalué</th>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="col-lg-12 col-12">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item border-0 pb-0">
                                                                <style>
                                                                    .green {
                                                                        background: #43b546;
                                                                        color: white;
                                                                    }

                                                                    .green:hover {
                                                                        background: #3fff45;
                                                                        color: white;
                                                                    }
                                                                </style>
                                                                <input name="insert" id="button_save" type="button" value="Ajouter" class="btn btn-primary btn-block subtotal-preview-btn" />
                                                                <input type="hidden" id="idqcm" value="<?= $qcms[0]['id'] ?>">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- invoice action  -->
                        </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->

    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- END Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script>
        function htmlEntities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        $(document).ready(function() {
            if ($('#table tr:last').attr("id") === undefined)
                var id = 1;
            else {
                var id = $('#table tr:last').attr("id");
                id++;
            }
            /*Assigning id and class for tr and td tags for separation.*/
            $("#button_send").click(function() {
                <?php
                if ($qcms[0]['qualitatif'] == "Non") {
                ?>
                    if (htmlEntities($("#reponse").val()) != '' && $("#vraioufaux").val() != '') {
                        var newid = id++;
                        $("#table tbody").append(`<tr valign="top" id="${newid}">
            <td id="reponse${newid}">${htmlEntities($("#reponse").val())}</td>
            <td id="vraioufaux${newid}" class="line">${$("#vraioufaux").val()}</td>
            <td><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);

                        document.getElementById("reponse").value = "";
                        document.getElementById("vraioufaux").value = "";
                    }
                <?php
                } else {
                ?>
                    if (htmlEntities($("#reponse").val()) != '' && $("#critere_reponse").val() != '') {
                        var newid = id++;
                        $("#table tbody").append(`<tr valign="top" id="${newid}">
            <td id="reponse${newid}">${htmlEntities($("#reponse").val())}</td>
            <td id="critere_reponse${newid}" class="line">${$("#critere_reponse").val()}</td>
            <td><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);

                        document.getElementById("reponse").value = "";
                        document.getElementById("critere_reponse").value = "";
                    }
                <?php
                }
                ?>
            });

            // function to remove article if u don't want it
            $("#table").on('click', '.remCF', function() {
                $(this).parent().parent().remove();
            });

            $("#critere").change(function() {
                critere = document.getElementById("critere").value;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/get_sous_groupe.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        critere: critere,
                    },
                    success: function(data) {
                        document.getElementById("critere_reponse").innerHTML = data;
                        $("#table tbody").empty();
                    }
                });
            });

            /*crating new click event for save button this will save to the database*/
            $("#button_save").click(function() {

                var lastRowId = $('#table tr:last').attr("id"); /*finds id of the last row inside table*/
                var reponses = new Array();
                var vraioufaux = new Array();
                var critere_reponse = new Array();
                <?php
                if ($qcms[0]['qualitatif'] == "Non") {
                ?>
                    for (var i = 1; i <= lastRowId; i++) {
                        if ($("#" + "reponse" + i).html() !== undefined)
                            reponses.push($("#" + "reponse" + i).html());
                        if ($("#" + "vraioufaux" + i).html() !== undefined)
                            vraioufaux.push($("#" + "vraioufaux" + i).html());
                    }
                <?php
                } else {
                ?>
                    for (var i = 1; i <= lastRowId; i++) {
                        if ($("#" + "reponse" + i).html() !== undefined)
                            reponses.push($("#" + "reponse" + i).html());
                        if ($("#" + "critere_reponse" + i).html() !== undefined)
                            critere_reponse.push($("#" + "critere_reponse" + i).html());
                    }
                <?php
                }
                ?>

                var idqcm = document.getElementById("idqcm").value;
                var libelle = document.getElementById("libelle").value;
                var points = document.getElementById("points").value;
                if (document.getElementById("critere") != null)
                    var critere = document.getElementById("critere").value;

                $.ajax({
                    url: "../../../html/ltr/coqpix/php/insert_question_admin.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        reponses: reponses,
                        vraioufaux: vraioufaux,
                        idqcm: idqcm,
                        libelle: libelle,
                        points: points,
                        critere: critere,
                        critere_reponse: critere_reponse
                    },
                    success: function(data) {
                        window.location.href = data;
                    }
                });
            });
        });
    </script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>