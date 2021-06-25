<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

if (!isset($_GET['id']))
    header('Location: rh-recrutement-entretien.php');
elseif (empty($_GET['id'])) {
    header('Location: rh-recrutement-entretien.php');
}

$pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = :id');
$pdoStt->bindValue(':id', htmlspecialchars($_GET['id']));
$pdoStt->execute();
$qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

if (count($qcms) != 1) {
    header('Location: rh-recrutement-entretient.php');
}

$pdoStt = $bdd->prepare('SELECT * FROM question WHERE idqcm = :id');
$pdoStt->bindValue(':id', htmlspecialchars($qcms[0]['id']));
$pdoStt->execute();
$questions = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $key => $value) {
    $pdoStt = $bdd->prepare('SELECT id, libelle, vrai_ou_faux FROM reponse WHERE id = :id');
    $pdoStt->bindValue(':id', $value['id']);
    $pdoStt->execute();
    $reponses[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Liste QCMs</title>
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
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour">
                                    <div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div>
                                </a></li>
                        </ul>
                        <script>
                            function retourn() {
                                window.history.back();
                            }
                        </script>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>
                            <!--NOTIFICATION-->
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">0 Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <!-- CONTENUE ONE -->
                                    </a>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> création du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php') ?>
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

                        <div class="col-12">
                            <div class="h3">
                                <?= $qcms[0]['libelle'] ?>
                            </div>
                        </div>

                        <div class="col">
                            <div class="invoice-create-btn mb-1">
                                <a href="qcm-add.php?id=<?= $qcms[0]['id'] ?>" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true"><i class="bx bx-plus"></i>Ajouter une question</a>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="qcmList" class="table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        Référence question
                                    </th>
                                    <th>Libellé</th>
                                    <th>Points</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($questions); ++$i) {
                                ?>
                                    <tr>
                                        <td>
                                            <?= $i + 1 ?>
                                        </td>
                                        <td>
                                            <?= $questions[$i]['libelle'] ?>
                                        </td>
                                        <td>
                                            <?= $questions[$i]['points'] ?>
                                        </td>
                                        <td>
                                            <div class="invoice-action"><br>
                                                <a href="#modal<?= $questions[$i]['id'] ?>" class="invoice-action-view mr-1" data-toggle="modal">
                                                    <i class="bx bx-show-alt"></i>
                                                </a>

                                                <div class="modal fade" id="modal<?= $questions[$i]['id'] ?>" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <i class="bx bx-x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul>
                                                                    <?= $questions[$i]['libelle'] ?>
                                                                    <?php
                                                                    var_dump($reponses);
                                                                    foreach ($reponses as $key => $value) {
                                                                        if ($value[0]['idquestion'] === $questions[$i]['id']) {
                                                                            foreach ($value as $key => $val) {
                                                                    ?>
                                                                                <li><?= $val['libelle'] ?> : <?= $val['vrai_ou_faux'] ?></li>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="qcm-edit.php?id=<?= $questions[$i]['id'] ?>&idqcm=<?= $qcms[0]['id'] ?>"" class=" invoice-action-edit cursor-pointer">
                                                    <i class="bx bx-edit"></i>
                                                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="php/delete_question.php?id=<?= $questions[$i]['id'] ?>&idqcm=<?= $questions[$i]['idqcm'] ?>" class="invoice-action-view mr-1">
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
        $(document).ready(function() {
            $('#qcmList').DataTable();
        });
    </script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>

</body>
<!-- END: Body-->

</html>