<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

$pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE auteur=(SELECT nameentreprise from entreprise WHERE id = :id)');
$pdoStt->bindValue(':id', $_SESSION['id_session']);
$pdoStt->execute();
$qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

foreach ($qcms as $key => $value) {
    $pdoStt = $bdd->prepare('SELECT COUNT(*) AS nbquestion FROM question WHERE idqcm = :id');
    $pdoStt->bindValue(':id', $value['id']);
    $pdoStt->execute();
    $nbquestion[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
}

$pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoStt->bindValue(':numentreprise', $_SESSION['id_session']);
$pdoStt->execute();
$entreprise = $pdoStt->fetch();

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
    <title>Liste des QCMs</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
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
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="rh-recrutement.php" data-toggle="tooltip" data-placement="top" title="Retour">
                                    <div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div>
                                </a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix">
                                    <div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div>
                                </a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Chat">
                                    <div class="livicon-evo" data-options=" name: comments.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div>
                                </a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <?php include('php/notifs_frontend.php'); ?>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php')  ?>
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
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- qcm list -->
                <section class="invoice-list-wrapper">
                    <!-- create qcm button-->
                    <div class="row">
                        <?php
                        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";
                        else $url = "http://";
                        $url .= $_SERVER['HTTP_HOST'];
                        $url .= $_SERVER['REQUEST_URI'];
                        ?>
                        <div class="form-group text-center col-12">
                            <hr>
                            <h4>Liste des QCM</h4>
                            <hr>
                        </div>
                        <div class="col">
                            <div class="invoice-create-btn mb-1">
                                <button class="btn btn-primary glow invoice-create" type="button" data-toggle="modal" data-target="#addquiz" aria-pressed="true"><i class="bx bx-plus"></i>Créer un QCM</button>
                            </div>
                        </div>

                        <div class="modal fade" id="addquiz" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Créer un QCM</h5>
                                        <button type="button" class="close cancel" data-dismiss="modal" aria-label="Close">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="create_form">
                                            <div class="form-group">
                                                <label for="libelle" class="col-form-label">Libellé:</label>
                                                <input type="text" class="form-control" id="libelle">
                                            </div>
                                            <div class="form-group">
                                                <label for="qualitatif" class="col-form-label">Qualitatif ?</label>
                                                <select class="form-control" name="qualitatif" id="qualitatif">
                                                    <option value="">Selectionner oui ou non</option>
                                                    <option>Oui</option>
                                                    <option>Non</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="create">Créer</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block cancel">Annuler</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="qcmList" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        References QCM
                                    </th>
                                    <th>Libellé</th>
                                    <th>Nombre de questions</th>
                                    <th>Auteur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($qcms); ++$i) {
                                ?>
                                    <tr>
                                        <td>
                                            <?= $i + 1 ?>
                                        </td>
                                        <td>
                                            <?= $qcms[$i]['libelle'] ?>
                                        </td>
                                        <td>
                                            <?= $nbquestion[$i][0]['nbquestion'] ?>
                                        </td>
                                        <td>
                                            <?= $qcms[$i]['auteur'] ?>
                                        </td>
                                        <td>
                                            <div class="invoice-action">
                                                <a href="#edit<?= $qcms[$i]['id'] ?>" class="invoice-action-view mr-1" data-toggle="modal">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <div class="modal fade" id="edit<?= $qcms[$i]['id'] ?>" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modifier un QCM</h5>
                                                                <button type="button" class="close cancel" data-dismiss="modal" aria-label="Close">
                                                                    <i class="bx bx-x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="update_form">
                                                                    <div class="form-group">
                                                                        <label for="libelle<?= $qcms[$i]['id'] ?>" class="col-form-label">Libellé:</label>
                                                                        <input type="text" class="form-control" value="<?= $qcms[$i]['libelle'] ?>" id="libelle<?= $qcms[$i]['id'] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="qualitatif<?= $qcms[$i]['id'] ?>" class="col-form-label">Qualitatif ?</label>
                                                                        <select class="form-control" name="qualitatif<?= $qcms[$i]['id'] ?>" id="qualitatif<?= $qcms[$i]['id'] ?>">
                                                                            <option value="">Selectionner oui ou non</option>
                                                                            <option <?php if ($qcms[$i]['qualitatif'] == "Oui") {
                                                                                        echo "selected";
                                                                                    } ?>>Oui</option>
                                                                            <option <?php if ($qcms[$i]['qualitatif'] == "Non") {
                                                                                        echo "selected";
                                                                                    } ?>>Non</option>
                                                                        </select>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" value="<?= $qcms[$i]['id'] ?>" onclick="update(this.value)">Sauvegarder</button>
                                                                <a href="rh-recrutement-entretient-question.php?id=<?= $qcms[$i]['id'] ?>" class="btn btn-success">Modifier les questions</a>
                                                                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Annuler</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($nbquestion[$i][0]['nbquestion'] > 0) {
                                                    if ($qcms[$i]['publiee'] == "non") {
                                                ?>
                                                        <a href="php/publier_qcm.php?id=<?= $qcms[$i]['id'] ?>" class="invoice-action-view mr-1">
                                                            <i class="bx bxs-send"></i>
                                                        </a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="php/retirer_publication_qcm.php?id=<?= $qcms[$i]['id'] ?>" class="invoice-action-view mr-1">
                                                            <i class="bx bxs-send" style="color: purple;"></i>
                                                        </a>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <a href="php/delete_qcm.php?id=<?= $qcms[$i]['id'] ?>" class="invoice-action-view mr-1">
                                                    <i class="bx bxs-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
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
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <script>
        function addAlert(message, type) {
            if(type == "create"){
                $('#create_form').append(
                    '<div class="alert alert-danger">' +
                        '<button type="button" class="close" data-dismiss="alert">' +
                        '&times;</button>' + message + '</div>');
            }
            else{
                $('#update_form').append(
                    '<div class="alert alert-danger">' +
                        '<button type="button" class="close" data-dismiss="alert">' +
                        '&times;</button>' + message + '</div>');
            }
        }
        $(document).ready(function() {
            $('#qcmList').DataTable();

            /*Ajout du QCM*/
            $("#create").click(function() {
                var libelle = $('#libelle').val(); // get qcm name
                var qualitatif = $('#qualitatif').val(); // get qcm type
                if (libelle != "" && qualitatif != "") {
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/insert_qcm.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            libelle: libelle,
                            qualitatif: qualitatif
                        },
                        success: function(data) {
                            window.location.reload();
                        }
                    });
                } else if (libelle == "") {
                    addAlert("Merci de nommer le qcm.", "create");
                } else {
                    addAlert("Merci de qualifier le qcm.", "create");
                }
            });

            $(".cancel").click(function() {
                window.location.reload();
            });
        });

        /*Misa a jour du libelle du QCM*/
        function update(id) {
            var libelle = $('#libelle' + id).val();
            var qualitatif = $('#qualitatif' + id).val(); // get qcm type
            if (libelle != "" && qualitatif != "") {
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/edit_qcm.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        libelle: libelle,
                        qualitatif: qualitatif,
                        id: id
                    },
                    success: function(data) {
                        //if(data.include("qcm")){
                            //$('#libelle' + id).val(data);
                        //}
                        //else{
                            window.location.reload();
                        //}
                    }
                });
            } else if (libelle == "") {
                addAlert("Merci de nommer le qcm.", "update");
            } else {
                addAlert("Merci de qualifier le qcm.", "update");
            }
        }
    </script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>

</body>
<!-- END: Body-->

</html>