<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'rh');
require_once 'php/verif_session_connect_admin.php';

if (!isset($_GET['id'])) {
    if (!isset($_GET['idqcm'])) {
        header('Location: recrutement-list.php');
    } elseif (empty($_GET['idqcm'])) {
        header('Location: recrutement-list.php');
    }
    $pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = :id');
    $pdoStt->bindValue(':id', htmlspecialchars($_GET['idqcm']));
    $pdoStt->execute();
    $qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

    if (count($qcms) != 1) {
        header('Location: recrutement-list.php');
    }
    $idqcm = $qcms[0]['id'];
    header("Location: recrutement-list-question.php?id=$idqcm");
} elseif (empty($_GET['id'])) {
    if (!isset($_GET['idqcm'])) {
        header('Location: recrutement-list.php');
    } elseif (empty($_GET['idqcm'])) {
        header('Location: recrutement-list.php');
    }
    $pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = :id');
    $pdoStt->bindValue(':id', htmlspecialchars($_GET['idqcm']));
    $pdoStt->execute();
    $qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

    if (count($qcms) != 1) {
        header('Location: recrutement-list.php');
    }
    $idqcm = $qcms[0]['id'];
    header("Location: recrutement-list-question.php?id=$idqcm");
}

$pdoSta = $bdd->prepare('SELECT * FROM question WHERE id = :id');
$pdoSta->bindValue(':id', htmlspecialchars($_GET['id']), PDO::PARAM_INT);
$pdoSta->execute();
$question = $pdoSta->fetch();

try {
    if (count($question) != 5) {
        if (!isset($_GET['idqcm'])) {
            header('Location: recrutement-list.php.php');
        } elseif (empty($_GET['idqcm'])) {
            header('Location: recrutement-list.php.php');
        }
        $pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = :id');
        $pdoStt->bindValue(':id', htmlspecialchars($_GET['idqcm']));
        $pdoStt->execute();
        $qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

        if (count($qcms) != 1) {
            header('Location: recrutement-list.php.php');
        }
        $idqcm = $qcms[0]['id'];
        header("Location: recrutement-list-question.php?id=$idqcm");
    }
} catch (\Throwable $th) {
    if (!isset($_GET['idqcm'])) {
        header('Location: recrutement-list.php.php');
    } elseif (empty($_GET['idqcm'])) {
        header('Location: recrutement-list.php.php');
    }
    $pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = :id');
    $pdoStt->bindValue(':id', htmlspecialchars($_GET['idqcm']));
    $pdoStt->execute();
    $qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

    if (count($qcms) != 1) {
        header('Location: recrutement-list.php.php');
    }
    $idqcm = $qcms[0]['id'];
    header("Location: recrutement-list-question.php?id=$idqcm");
}

$pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = (SELECT idqcm FROM question WHERE id = :id)');
$pdoStt->bindValue(':id', htmlspecialchars($_GET['id']));
$pdoStt->execute();
$qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

$pdoSta = $bdd->prepare('SELECT * FROM reponse WHERE idquestion = :id');
$pdoSta->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$pdoSta->execute();
$reponses = $pdoSta->fetchAll(PDO::FETCH_ASSOC);

$pdoSta = $bdd->prepare('SELECT * FROM admin WHERE id = :num');
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
    <title>Modifier une question - <?= $question['libelle'] ?></title>
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
                                    <h4 class="card-title">Modifier une question - <?= $qcms[0]['libelle'] ?></h4>
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
                                                        <input class="form-control" type="text" name="libelle" id="libelle" value="<?= $question['libelle'] ?>" placeholder="Qui êtes vous?">
                                                    </div>

                                                    <?php
                                                    if ($qcms[0]['qualitatif'] == "Oui") {
                                                    ?>

                                                        <div class="form-group">
                                                            <label for="critere" class="col-form-label">Critère evalué</label>
                                                            <select class="form-control" name="critere" id="critere">
                                                                <option value="">Selectionner un critère d'évaluation</option>
                                                                <option value="paramA" <?php if ($question['statu'] == "paramA") {
                                                                                            echo "selected";
                                                                                        } ?>>Performance individuelle</option>
                                                                <option value="paramB" <?php if ($question['statu'] == "paramB") {
                                                                                            echo "selected";
                                                                                        } ?>>Capacité de communication interpersonnelle</option>
                                                                <option value="paramC" <?php if ($question['statu'] == "paramC") {
                                                                                            echo "selected";
                                                                                        } ?>>Capacité de manager</option>
                                                                <option value="paramD" <?php if ($question['statu'] == "paramD") {
                                                                                            echo "selected";
                                                                                        } ?>>Autonomie</option>
                                                                <option value="paramE" <?php if ($question['statu'] == "paramE") {
                                                                                            echo "selected";
                                                                                        } ?>>Maîtrise de soi</option>
                                                            </select>
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="form-group">
                                                        <label for="points" class="col-form-label">Points</label>
                                                        <input class="form-control" type="number" value="<?= $question['points'] ?>" step="1" name="points" <?php if ($qcms[0]['qualitatif'] == "Oui") {
                                                                                                                                                                echo "disabled";
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
                                                                <?php
                                                                for ($i = 1; $i <= count($reponses); $i++) {
                                                                ?>
                                                                    <tr valign="top" id="<?= $i ?>">
                                                                        <td id="reponse<?= $i ?>"><?= $reponses[$i - 1]['libelle'] ?></td>
                                                                        <?php
                                                                        if ($qcms[0]['qualitatif'] == "Non") {
                                                                        ?>
                                                                            <td id="vraioufaux<?= $i ?>" class="line"><?= $reponses[$i - 1]['vrai_ou_faux'] ?></td>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <td id="critere_reponse<?= $i ?>" class="line"><?= $reponses[$i - 1]['statu'] ?></td>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <td>
                                                                            <a href="javascript:void(0);" class="remCF">
                                                                                <i class='bx bx-x red'></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
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
                                                                <input name="insert" id="button_update" type="button" value="Modifier" class="btn btn-primary btn-block subtotal-preview-btn" />
                                                                <input type="hidden" id="idquestion" value="<?= $question['id'] ?>">
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
                        addAlert("Réponse ajoutée", "success");
                    } else {
                        addAlert("Champs réponse et vrai ou faux vides.", "error");
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
                        addAlert("Réponse ajoutée", "success");
                    } else {
                        addAlert("Champs réponse et sous critère vides.", "error");
                    }
                <?php
                }
                ?>
            });

            // function to remove article if u don't want it
            $("#table").on('click', '.remCF', function() {
                $(this).parent().parent().remove();
                addAlert("Réponse supprimée", "success");
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

            /*crating new click event for update button this will update the database*/
            $("#button_update").click(function() {
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

                var idquestion = document.getElementById("idquestion").value;
                var libelle = document.getElementById("libelle").value;
                var points = document.getElementById("points").value;
                if (document.getElementById("critere") != null)
                    var critere = document.getElementById("critere").value;

                $.ajax({
                    url: "../../../html/ltr/coqpix/php/edit_question_admin.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        reponses: reponses,
                        vraioufaux: vraioufaux,
                        idquestion: idquestion,
                        libelle: libelle,
                        points: points,
                        critere: critere,
                        critere_reponse: critere_reponse
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status == "success") {
                            addAlert("Question mise a jour", "success");
                            window.setTimeout(function() {
                                window.location.href = data.link;
                            }, 1000);
                        } else {
                            addAlert(data.message, "error");
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