<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

// SELECT DES FILES ! ALL ! RECENT ! PAR MOIS

//ALL

$pdoSta = $bdd->prepare('SELECT * FROM stockage WHERE id_session = :num');
$pdoSta->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSta->execute();
$stockage = $pdoSta->fetchAll();

//RECENT

$pdoSta = $bdd->prepare('SELECT * FROM stockage WHERE id_session = :num ORDER BY id DESC LIMIT 4');
$pdoSta->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSta->execute();
$recent = $pdoSta->fetchAll();

$pdoSta = $bdd->prepare('SELECT * FROM stockage WHERE id_session = :num ORDER BY id DESC LIMIT 8');
$pdoSta->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSta->execute();
$recent_min = $pdoSta->fetchAll();

//PAR MOIS

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="01"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$janvier = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="02"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$fevrier = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="03"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$mars = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="04"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$avril = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="05"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$mai = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="06"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$juin = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="07"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$juillet = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="08"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$aout = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="09"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$septembre = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="10"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$octobre = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="11"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$novembre = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage WHERE id_session=:num AND dte_m="12"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$decembre = $pdoSt->fetchAll();

$pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
$pdoStat->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoStat->execute();
$entreprise = $pdoStat->fetch();

//type d'icon pour les fichiers ! MIN ! MAX

if ($entreprise['forme_cloud'] == "max") {
    $max = "";
    $min = "none-validation";
} else {
    $max = "none-validation";
    $min = "";
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
    <title>CloudPix - Stockage</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-file-manager.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout content-left-sidebar file-manager-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="semi-dark-layout">
    <style>
        .vert {
            color: #03f322;
        }

        .red {
            color: #ff0000;
        }

        .none-validation {
            display: none;
        }

        .hovertrash:hover {
            color: red;
        }

        .scroll {
            overflow-y: scroll;
            scrollbar-color: grey;
            scrollbar-width: thin;
        }
    </style>

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="app-file-sidebar sidebar-content d-flex">
                        <!-- App File sidebar - Left section Starts -->
                        <div class="app-file-sidebar-left">
                            <!-- sidebar close icon starts -->
                            <span class="app-file-sidebar-close"><i class="bx bx-x"></i></span>
                            <!-- sidebar close icon ends -->
                            <div class="app-file-sidebar-content">
                                <!-- App File Left Sidebar - Drive Content Starts -->
                                <label class="app-file-label">Mes documents</label>
                                <div class="list-group list-group-messages my-50">
                                    <a href="file-manager.php" class="list-group-item list-group-item-action pt-0 active">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: morph-folder.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Tous les documents
                                    </a>
                                    <a href="file-manager-delete.php" class="list-group-item list-group-item-action pt-0">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Corbeille
                                    </a>
                                    <label class="app-file-label">Ventes</label>
                                    <a href="file-manager-ventes-fac.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: coins.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Factures de ventes
                                    </a>
                                    <a href="file-manager-avoir.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: box-add.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Avoirs
                                    </a>
                                    <label class="app-file-label">Achats</label>
                                    <a href="file-manager-fac-achat.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: us-dollar.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Factures d'achats
                                    </a>
                                    <a href="file-manager-note.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: shoppingcart.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Notes de frais
                                    </a>
                                    <label class="app-file-label">Trésorerie</label>
                                    <a href="file-manager-banque.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: bank.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Relevés bancaires
                                    </a>
                                    <a href="file-manager-ventes-caisse.php" class="list-group-item list-group-item-action">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: calculator.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Relevés de caisses
                                    </a>
                                </div>

                                <!-- App File Left Sidebar - Storage Content Starts -->
                                <?php

                                $pdoSta = $bdd->prepare("SELECT SUM(size_files) AS total FROM stockage WHERE id_session=:id_session");
                                $pdoSta->bindValue(':id_session', $_SESSION['id_session']);
                                $pdoSta->execute();
                                $sum = $pdoSta->fetch();
                                if ($sum['total'] == "") {
                                    $sum = "0";
                                } else {
                                    $sum = $sum['total'];
                                }

                                $sum_oct_go = $sum / 1073741824;
                                $sum_go = round('' . $sum_oct_go . '', 2);

                                $pourc_size = ($sum * 100) / 1073741824;

                                ?>
                                <label class="app-file-label mb-75">Storage Status</label>
                                <div class="d-flex mb-1">
                                    <div class="fonticon-wrap mr-1">
                                        <i class="livicon-evo cursor-pointer" data-options="name: save.svg; size: 30px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                        </i>
                                    </div>
                                    <div class="file-manager-progress">
                                        <span class="text-muted font-size-small"><?= $sum_go ?>GB utilisé sur 1GB</span>
                                        <div class="progress progress-bar-primary progress-sm mb-0">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="<?= $pourc_size ?>" aria-valuemin="0" aria-valuemax="1073741824" style="width:<?= $pourc_size ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="shop.php" class="font-weight-bold">Augmenter le stockage</a>
                                <!-- App File Left Sidebar - Storage Content Ends -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- File Manager app overlay -->

                        <div class="app-file-area">
                            <!-- File App Content Area -->
                            <!-- App File Header Starts -->
                            <div class="app-file-header">
                                <!-- Header search bar starts -->
                                <div class="app-file-header-search flex-grow-1">
                                    <div class="sidebar-toggle d-block d-lg-none">
                                        <i class="bx bx-menu"></i>
                                    </div>
                                    <fieldset class="form-group position-relative has-icon-left m-0">
                                        <input type="text" class="form-control border-0 shadow-none" id="email-search" placeholder="Rechercher un document">
                                        <div class="form-control-position">
                                            <i class="bx bx-search"></i>
                                        </div>
                                    </fieldset>
                                </div>
                                <!-- Header search bar Ends -->
                                <!-- Header Icons Starts -->
                                <div class="app-file-header-icons">
                                    <div class="fonticon-wrap d-inline mx-sm-1 align-middle">
                                        <a href="php/changforme_cloud.php?forme=<?= $entreprise['forme_cloud'] ?>"><i onclick="chang()" class="livicon-evo cursor-pointer" data-options="name: grid.svg; style: linesAlt; size: 26px; strokeColor: black; strokeColorAlt: black "></i></a>
                                    </div>
                                </div>
                                <!-- Header Icons Ends -->
                            </div>
                            <!-- App File Header Ends -->

                            <!-- App File Content Starts -->
                            <div id="div_max" class="app-file-content p-2 <?= $max ?>">
                                <h5>Tous les documents</h5>

                                <!-- App File - Recent Accessed Files Section Starts -->
                                <label class="app-file-label">Récemment téléchargé</label>
                                <div class="row app-file-recent-access">
                                    <?php foreach ($recent as $recents) : ?>
                                        <div class="col-md-3 col-6">
                                            <div class="card border shadow-none mb-1 app-file-info">
                                                <div class="card-content">
                                                    <div class="app-file-content-logo card-img-top">
                                                        <a href="php/corbeille_files.php?id=<?= $recents['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                        <a href="../../src/files/<?php if ($recents['type_files_note'] == "note") {
                                                                                        echo "note";
                                                                                    } elseif ($recents['type_files_avoir'] == "avoir") {
                                                                                        echo "avoir";
                                                                                    } elseif ($recents['type_files_fac_achat'] == "fac_achat") {
                                                                                        echo "fac_achat";
                                                                                    } elseif ($recents['type_files_fac_ventes'] == "fac_ventes") {
                                                                                        echo "fac_vente";
                                                                                    } elseif ($recents['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                        echo "caisse";
                                                                                    } elseif ($recents['banque'] == "banque") {
                                                                                        echo "banque";
                                                                                    } ?>/<?= $recents['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                        <a href="loading/button_valid.php?id=<?= $recents['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $recents['name_files'] ?>&size_files=<?= $recents['size_files'] ?>&dte_files=<?= $recents['dte_files'] ?>&dte_j=<?= $recents['dte_j'] ?>&dte_m=<?= $recents['dte_m'] ?>&dte_a=<?= $recents['dte_a'] ?>&img_files=<?= $recents['img_files'] ?>&type_files_note=<?= $recents['type_files_note'] ?>&type_files_avoir=<?= $recents['type_files_avoir'] ?>&type_files_fac_achat=<?= $recents['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $recents['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $recents['type_files_caisse_ventes'] ?>&banque=<?= $recents['banque'] ?>&send_files=<?= $recents['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $recents['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $recents['img_files'];
                                                                                                                            if ($img_files == "pdf") {
                                                                                                                                $img_files = "pdf.png";
                                                                                                                            } else {
                                                                                                                                if ($img_files == "psd") {
                                                                                                                                    $img_files = "psd.png";
                                                                                                                                } else {
                                                                                                                                    if ($img_files == "sketch") {
                                                                                                                                        $img_files = "sketch.png";
                                                                                                                                    } else {
                                                                                                                                        $img_files = "doc.png";
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body p-50">
                                                        <div class="app-file-recent-details">
                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $recents['name_files'] ?> - <small style="<?php if ($recents['send_files'] == "#03f322") {
                                                                                                                                                                            echo "color: #03f322;";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo "color: #ff0000;";
                                                                                                                                                                        } ?>"><?php if ($recents['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                if ($recents['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                    if ($recents['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                        if ($recents['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                            if ($recents['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                if ($recents['banque'] == "") {
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                            } ?></small></div>
                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $recents['size_files'] ?> octets</div>
                                                            <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                            echo strftime("%d-%m-%G", strtotime($recents['dte_files'])); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- App File - Recent Accessed Files Section Ends -->

                                <div class="form-group">
                                    <hr>
                                </div>

                                <!-- APP file - classement par date start -->

                                <div class="form-group">
                                    <div class="form-group" onclick="dte()">
                                        <h5 style="cursor: pointer;">Trier par mois &nbsp<i style="margin: 0px; padding: 0px; position: relative; top: 2px; cursor: pointer;" class='bx bx-down-arrow-alt'></i></h5>
                                    </div>
                                    <div id="div_date" class="none-validation">
                                        <div class="form-group">
                                            <label>Janvier</label>
                                            <hr>
                                            <div class="form-group">
                                                <div class="row app-file-files">
                                                    <?php foreach ($janvier as $janvierr) : ?>
                                                        <div class="col-md-3 col-6">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <a href="php/corbeille_files.php?id=<?= $janvierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                        <a href="../../src/files/<?php if ($janvierr['type_files_note'] == "note") {
                                                                                                        echo "note";
                                                                                                    } elseif ($janvierr['type_files_avoir'] == "avoir") {
                                                                                                        echo "avoir";
                                                                                                    } elseif ($janvierr['type_files_fac_achat'] == "fac_achat") {
                                                                                                        echo "fac_achat";
                                                                                                    } elseif ($janvierr['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                        echo "fac_vente";
                                                                                                    } elseif ($janvierr['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                        echo "caisse";
                                                                                                    } elseif ($janvierr['banque'] == "banque") {
                                                                                                        echo "banque";
                                                                                                    } ?>/<?= $janvierr['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                        <a href="loading/button_valid.php?id=<?= $janvierr['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $janvierr['name_files'] ?>&size_files=<?= $janvierr['size_files'] ?>&dte_files=<?= $janvierr['dte_files'] ?>&dte_j=<?= $janvierr['dte_j'] ?>&dte_m=<?= $janvierr['dte_m'] ?>&dte_a=<?= $janvierr['dte_a'] ?>&img_files=<?= $janvierr['img_files'] ?>&type_files_note=<?= $janvierr['type_files_note'] ?>&type_files_avoir=<?= $janvierr['type_files_avoir'] ?>&type_files_fac_achat=<?= $janvierr['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $janvierr['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $janvierr['type_files_caisse_ventes'] ?>&banque=<?= $janvierr['banque'] ?>&send_files=<?= $janvierr['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $janvierr['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $janvierr['img_files'];
                                                                                                                                            if ($img_files == "pdf") {
                                                                                                                                                $img_files = "pdf.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "psd") {
                                                                                                                                                    $img_files = "psd.png";
                                                                                                                                                } else {
                                                                                                                                                    if ($img_files == "sketch") {
                                                                                                                                                        $img_files = "sketch.png";
                                                                                                                                                    } else {
                                                                                                                                                        $img_files = "doc.png";
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-recent-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $janvierr['name_files'] ?> - <small style="<?php if ($janvierr['send_files'] == "#03f322") {
                                                                                                                                                                                            echo "color: #03f322;";
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo "color: #ff0000;";
                                                                                                                                                                                        } ?>"><?php if ($janvierr['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                    if ($janvierr['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                        if ($janvierr['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                            if ($janvierr['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($janvierr['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($janvierr['banque'] == "") {
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                                } ?></small></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $janvierr['size_files'] ?> octets</div>
                                                                            <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                            echo strftime("%d-%m-%G", strtotime($janvierr['dte_files'])); ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Février</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($fevrier as $fevrierr) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $fevrierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($fevrierr['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($fevrierr['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($fevrierr['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($fevrierr['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($fevrierr['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($fevrierr['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $fevrierr['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $fevrierr['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $fevrierr['name_files'] ?>&size_files=<?= $fevrierr['size_files'] ?>&dte_files=<?= $fevrierr['dte_files'] ?>&dte_j=<?= $fevrierr['dte_j'] ?>&dte_m=<?= $fevrierr['dte_m'] ?>&dte_a=<?= $fevrierr['dte_a'] ?>&img_files=<?= $fevrierr['img_files'] ?>&type_files_note=<?= $fevrierr['type_files_note'] ?>&type_files_avoir=<?= $fevrierr['type_files_avoir'] ?>&type_files_fac_achat=<?= $fevrierr['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $fevrierr['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $fevrierr['type_files_caisse_ventes'] ?>&banque=<?= $fevrierr['banque'] ?>&send_files=<?= $fevrierr['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $fevrierr['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $fevrierr['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $fevrierr['name_files'] ?> - <small style="<?php if ($fevrierr['send_files'] == "#03f322") {
                                                                                                                                                                                        echo "color: #03f322;";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "color: #ff0000;";
                                                                                                                                                                                    } ?>"><?php if ($fevrierr['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                if ($fevrierr['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                    if ($fevrierr['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                        if ($fevrierr['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                            if ($fevrierr['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($fevrierr['banque'] == "") {
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                                            } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $fevrierr['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($fevrierr['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mars</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($mars as $marss) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $marss['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($marss['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($marss['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($marss['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($marss['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($marss['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($marss['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $marss['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $marss['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $marss['name_files'] ?>&size_files=<?= $marss['size_files'] ?>&dte_files=<?= $marss['dte_files'] ?>&dte_j=<?= $marss['dte_j'] ?>&dte_m=<?= $marss['dte_m'] ?>&dte_a=<?= $marss['dte_a'] ?>&img_files=<?= $marss['img_files'] ?>&type_files_note=<?= $marss['type_files_note'] ?>&type_files_avoir=<?= $marss['type_files_avoir'] ?>&type_files_fac_achat=<?= $marss['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $marss['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $marss['type_files_caisse_ventes'] ?>&banque=<?= $marss['banque'] ?>&send_files=<?= $marss['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $marss['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $marss['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $marss['name_files'] ?> - <small style="<?php if ($marss['send_files'] == "#03f322") {
                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                } ?>"><?php if ($marss['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                        if ($marss['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                            if ($marss['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                if ($marss['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                    if ($marss['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                        if ($marss['banque'] == "") {
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Facture de vente";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Facture d'achat";
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo "Avoir";
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                        echo "Note de Frais";
                                                                                                                                                                                                                                                                                    } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $marss['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($marss['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Avril</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($avril as $avrill) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $avrill['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($avrill['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($avrill['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($avrill['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($avrill['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($avrill['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($avrill['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $avrill['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $avrill['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $avrill['name_files'] ?>&size_files=<?= $avrill['size_files'] ?>&dte_files=<?= $avrill['dte_files'] ?>&dte_j=<?= $avrill['dte_j'] ?>&dte_m=<?= $avrill['dte_m'] ?>&dte_a=<?= $avrill['dte_a'] ?>&img_files=<?= $avrill['img_files'] ?>&type_files_note=<?= $avrill['type_files_note'] ?>&type_files_avoir=<?= $avrill['type_files_avoir'] ?>&type_files_fac_achat=<?= $avrill['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $avrill['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $avrill['type_files_caisse_ventes'] ?>&banque=<?= $avrill['banque'] ?>&send_files=<?= $avrill['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $avrill['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $avrill['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $avrill['name_files'] ?> - <small style="<?php if ($avrill['send_files'] == "#03f322") {
                                                                                                                                                                                        echo "color: #03f322;";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "color: #ff0000;";
                                                                                                                                                                                    } ?>"><?php if ($avrill['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                            if ($avrill['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                if ($avrill['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                    if ($avrill['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                        if ($avrill['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                            if ($avrill['banque'] == "") {
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Facture de vente";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Avoir";
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo "Note de Frais";
                                                                                                                                                                                                                                                                                        } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $avrill['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($avrill['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mai</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($mai as $maii) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $maii['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($maii['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($maii['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($maii['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($maii['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($maii['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($maii['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $maii['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $maii['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $maii['name_files'] ?>&size_files=<?= $maii['size_files'] ?>&dte_files=<?= $maii['dte_files'] ?>&dte_j=<?= $maii['dte_j'] ?>&dte_m=<?= $maii['dte_m'] ?>&dte_a=<?= $maii['dte_a'] ?>&img_files=<?= $maii['img_files'] ?>&type_files_note=<?= $maii['type_files_note'] ?>&type_files_avoir=<?= $maii['type_files_avoir'] ?>&type_files_fac_achat=<?= $maii['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $maii['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $maii['type_files_caisse_ventes'] ?>&banque=<?= $maii['banque'] ?>&send_files=<?= $maii['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $maii['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $maii['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $maii['name_files'] ?> - <small style="<?php if ($maii['send_files'] == "#03f322") {
                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                } ?>"><?php if ($maii['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                        if ($maii['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                            if ($maii['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                if ($maii['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                    if ($maii['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                        if ($maii['banque'] == "") {
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Facture de vente";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Facture d'achat";
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo "Avoir";
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                        echo "Note de Frais";
                                                                                                                                                                                                                                                                                    } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $maii['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($maii['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Juin</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($juin as $juinn) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $juinn['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($juinn['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($juinn['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($juinn['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($juinn['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($juinn['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($juinn['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $juinn['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $juinn['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $juinn['name_files'] ?>&size_files=<?= $juinn['size_files'] ?>&dte_files=<?= $juinn['dte_files'] ?>&dte_j=<?= $juinn['dte_j'] ?>&dte_m=<?= $juinn['dte_m'] ?>&dte_a=<?= $juinn['dte_a'] ?>&img_files=<?= $juinn['img_files'] ?>&type_files_note=<?= $juinn['type_files_note'] ?>&type_files_avoir=<?= $juinn['type_files_avoir'] ?>&type_files_fac_achat=<?= $juinn['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $juinn['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $juinn['type_files_caisse_ventes'] ?>&banque=<?= $juinn['banque'] ?>&send_files=<?= $juinn['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $juinn['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $juinn['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $juinn['name_files'] ?> - <small style="<?php if ($juinn['send_files'] == "#03f322") {
                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                } ?>"><?php if ($juinn['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                        if ($juinn['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                            if ($juinn['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                if ($juinn['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                    if ($juinn['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                        if ($juinn['banque'] == "") {
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Facture de vente";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Facture d'achat";
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo "Avoir";
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                        echo "Note de Frais";
                                                                                                                                                                                                                                                                                    } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $juinn['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($juinn['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Juillet</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($juillet as $juillett) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $juillett['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($juillett['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($juillett['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($juillett['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($juillett['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($juillett['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($juillett['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $juillett['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $juillett['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $juillett['name_files'] ?>&size_files=<?= $juillett['size_files'] ?>&dte_files=<?= $juillett['dte_files'] ?>&dte_j=<?= $juillett['dte_j'] ?>&dte_m=<?= $juillett['dte_m'] ?>&dte_a=<?= $juillett['dte_a'] ?>&img_files=<?= $juillett['img_files'] ?>&type_files_note=<?= $juillett['type_files_note'] ?>&type_files_avoir=<?= $juillett['type_files_avoir'] ?>&type_files_fac_achat=<?= $juillett['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $juillett['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $juillett['type_files_caisse_ventes'] ?>&banque=<?= $juillett['banque'] ?>&send_files=<?= $juillett['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $juillett['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $juillett['name_files'] ?> - <small style="<?php if ($juillett['send_files'] == "#03f322") {
                                                                                                                                                                                        echo "color: #03f322;";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "color: #ff0000;";
                                                                                                                                                                                    } ?>"><?php if ($juillett['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                if ($juillett['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                    if ($juillett['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                        if ($juillett['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                            if ($juillett['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($juillett['banque'] == "") {
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                                            } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $juillett['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($juillett['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Aout</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($aout as $aoutt) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $aout['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($aoutt['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($aoutt['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($aoutt['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($aoutt['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($aoutt['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($aoutt['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $aoutt['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $aout['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $aout['name_files'] ?>&size_files=<?= $aout['size_files'] ?>&dte_files=<?= $aout['dte_files'] ?>&dte_j=<?= $aout['dte_j'] ?>&dte_m=<?= $aout['dte_m'] ?>&dte_a=<?= $aout['dte_a'] ?>&img_files=<?= $aout['img_files'] ?>&type_files_note=<?= $aout['type_files_note'] ?>&type_files_avoir=<?= $aout['type_files_avoir'] ?>&type_files_fac_achat=<?= $aout['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $aout['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $aout['type_files_caisse_ventes'] ?>&banque=<?= $aout['banque'] ?>&send_files=<?= $aout['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $aout['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $aoutt['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $aoutt['name_files'] ?> - <small style="<?php if ($aoutt['send_files'] == "#03f322") {
                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                } ?>"><?php if ($aoutt['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                        if ($aoutt['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                            if ($aoutt['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                if ($aoutt['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                    if ($aoutt['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                        if ($aoutt['banque'] == "") {
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Facture de vente";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Facture d'achat";
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo "Avoir";
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                        echo "Note de Frais";
                                                                                                                                                                                                                                                                                    } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $aoutt['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($aoutt['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Septembre</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($septembre as $septembree) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $septembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($septembree['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($septembree['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($septembree['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($septembree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($septembree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($septembree['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $septembree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $septembree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $septembree['name_files'] ?>&size_files=<?= $septembree['size_files'] ?>&dte_files=<?= $septembree['dte_files'] ?>&dte_j=<?= $septembree['dte_j'] ?>&dte_m=<?= $septembree['dte_m'] ?>&dte_a=<?= $septembree['dte_a'] ?>&img_files=<?= $septembree['img_files'] ?>&type_files_note=<?= $septembree['type_files_note'] ?>&type_files_avoir=<?= $septembree['type_files_avoir'] ?>&type_files_fac_achat=<?= $septembree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $septembree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $septembree['type_files_caisse_ventes'] ?>&banque=<?= $septembree['banque'] ?>&send_files=<?= $septembree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $septembree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $septembree['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $septembree['name_files'] ?> - <small style="<?php if ($septembree['send_files'] == "#03f322") {
                                                                                                                                                                                            echo "color: #03f322;";
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo "color: #ff0000;";
                                                                                                                                                                                        } ?>"><?php if ($septembree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                    if ($septembree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                        if ($septembree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                            if ($septembree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($septembree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($septembree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                                } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $septembree['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($septembree['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Octobre</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($octobre as $octobree) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $octobree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($octobree['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($octobree['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($octobree['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($octobree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($octobree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($octobree['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $octobree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $octobree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $octobree['name_files'] ?>&size_files=<?= $octobree['size_files'] ?>&dte_files=<?= $octobree['dte_files'] ?>&dte_j=<?= $octobree['dte_j'] ?>&dte_m=<?= $octobree['dte_m'] ?>&dte_a=<?= $octobree['dte_a'] ?>&img_files=<?= $octobree['img_files'] ?>&type_files_note=<?= $octobree['type_files_note'] ?>&type_files_avoir=<?= $octobree['type_files_avoir'] ?>&type_files_fac_achat=<?= $octobree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $octobree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $octobree['type_files_caisse_ventes'] ?>&banque=<?= $octobree['banque'] ?>&send_files=<?= $octobree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $octobree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $septembree['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $octobree['name_files'] ?> - <small style="<?php if ($octobree['send_files'] == "#03f322") {
                                                                                                                                                                                        echo "color: #03f322;";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "color: #ff0000;";
                                                                                                                                                                                    } ?>"><?php if ($octobree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                if ($octobree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                    if ($octobree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                        if ($octobree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                            if ($octobree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($octobree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                                            } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $octobree['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($octobree['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Novembre</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($novembre as $novembree) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $novembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($novembree['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($novembree['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($novembree['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($novembree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($novembree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($novembree['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $novembree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $novembree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $novembree['name_files'] ?>&size_files=<?= $novembree['size_files'] ?>&dte_files=<?= $novembree['dte_files'] ?>&dte_j=<?= $novembree['dte_j'] ?>&dte_m=<?= $novembree['dte_m'] ?>&dte_a=<?= $novembree['dte_a'] ?>&img_files=<?= $novembree['img_files'] ?>&type_files_note=<?= $novembree['type_files_note'] ?>&type_files_avoir=<?= $novembree['type_files_avoir'] ?>&type_files_fac_achat=<?= $novembree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $novembree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $novembree['type_files_caisse_ventes'] ?>&banque=<?= $novembree['banque'] ?>&send_files=<?= $novembree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $novembree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $novembree['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $novembree['name_files'] ?> - <small style="<?php if ($novembree['send_files'] == "#03f322") {
                                                                                                                                                                                        echo "color: #03f322;";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "color: #ff0000;";
                                                                                                                                                                                    } ?>"><?php if ($novembree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                if ($novembree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                    if ($novembree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                        if ($novembree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                            if ($novembree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($novembree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                                            } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $novembree['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($novembree['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Décembre</label>
                                            <hr>
                                            <div class="row app-file-files">
                                                <?php foreach ($decembre as $decembree) : ?>
                                                    <div class="col-md-3 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="app-file-content-logo card-img-top">
                                                                    <a href="php/corbeille_files.php?id=<?= $decembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                                    <a href="../../src/files/<?php if ($decembree['type_files_note'] == "note") {
                                                                                                    echo "note";
                                                                                                } elseif ($decembree['type_files_avoir'] == "avoir") {
                                                                                                    echo "avoir";
                                                                                                } elseif ($decembree['type_files_fac_achat'] == "fac_achat") {
                                                                                                    echo "fac_achat";
                                                                                                } elseif ($decembree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                    echo "fac_vente";
                                                                                                } elseif ($decembree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                    echo "caisse";
                                                                                                } elseif ($decembree['banque'] == "banque") {
                                                                                                    echo "banque";
                                                                                                } ?>/<?= $decembree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <a href="loading/button_valid.php?id=<?= $decembree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $decembree['name_files'] ?>&size_files=<?= $decembree['size_files'] ?>&dte_files=<?= $decembree['dte_files'] ?>&dte_j=<?= $decembree['dte_j'] ?>&dte_m=<?= $decembree['dte_m'] ?>&dte_a=<?= $decembree['dte_a'] ?>&img_files=<?= $decembree['img_files'] ?>&type_files_note=<?= $decembree['type_files_note'] ?>&type_files_avoir=<?= $decembree['type_files_avoir'] ?>&type_files_fac_achat=<?= $decembree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $decembree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $decembree['type_files_caisse_ventes'] ?>&banque=<?= $decembree['banque'] ?>&send_files=<?= $decembree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $decembree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $decembree['img_files'];
                                                                                                                                        if ($img_files == "pdf") {
                                                                                                                                            $img_files = "pdf.png";
                                                                                                                                        } else {
                                                                                                                                            if ($img_files == "psd") {
                                                                                                                                                $img_files = "psd.png";
                                                                                                                                            } else {
                                                                                                                                                if ($img_files == "sketch") {
                                                                                                                                                    $img_files = "sketch.png";
                                                                                                                                                } else {
                                                                                                                                                    $img_files = "doc.png";
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                                </div>
                                                                <div class="card-body p-50">
                                                                    <div class="app-file-recent-details">
                                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $decembree['name_files'] ?> - <small style="<?php if ($decembree['send_files'] == "#03f322") {
                                                                                                                                                                                        echo "color: #03f322;";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "color: #ff0000;";
                                                                                                                                                                                    } ?>"><?php if ($decembree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                if ($decembree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                    if ($decembree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                        if ($decembree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                            if ($decembree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($decembree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                                            } ?></small></div>
                                                                        <div class="app-file-size font-size-small text-muted mb-25"><?= $decembree['size_files'] ?> octets</div>
                                                                        <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                        echo strftime("%d-%m-%G", strtotime($decembree['dte_files'])); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- APP file - classement par date Ends -->

                                <div id="hr_none" class="form-group">
                                    <hr>
                                </div>


                                <!-- App File - Files Section Starts -->
                                <label class="app-file-label">l'ensemble de vos documents</label>
                                <div class="row app-file-files">
                                    <?php foreach ($stockage as $stockages) : ?>
                                        <div class="col-md-3 col-6">
                                            <div class="card border shadow-none mb-1 app-file-info">
                                                <div class="card-content">
                                                    <div class="app-file-content-logo card-img-top">
                                                        <a href="php/corbeille_files.php?id=<?= $stockages['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a>
                                                        <a href="../../src/files/<?php if ($stockages['type_files_note'] == "note") {
                                                                                        echo "note";
                                                                                    } elseif ($stockages['type_files_avoir'] == "avoir") {
                                                                                        echo "avoir";
                                                                                    } elseif ($stockages['type_files_fac_achat'] == "fac_achat") {
                                                                                        echo "fac_achat";
                                                                                    } elseif ($stockages['type_files_fac_ventes'] == "fac_ventes") {
                                                                                        echo "fac_vente";
                                                                                    } elseif ($stockages['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                        echo "caisse";
                                                                                    } elseif ($stockages['banque'] == "banque") {
                                                                                        echo "banque";
                                                                                    } ?>/<?= $stockages['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                        <a href="loading/button_valid.php?id=<?= $stockages['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $stockages['name_files'] ?>&size_files=<?= $stockages['size_files'] ?>&dte_files=<?= $stockages['dte_files'] ?>&dte_j=<?= $stockages['dte_j'] ?>&dte_m=<?= $stockages['dte_m'] ?>&dte_a=<?= $stockages['dte_a'] ?>&img_files=<?= $stockages['img_files'] ?>&type_files_note=<?= $stockages['type_files_note'] ?>&type_files_avoir=<?= $stockages['type_files_avoir'] ?>&type_files_fac_achat=<?= $stockages['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $stockages['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $stockages['type_files_caisse_ventes'] ?>&banque=<?= $stockages['banque'] ?>&send_files=<?= $stockages['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $stockages['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?php $img_files = $stockages['img_files'];
                                                                                                                            if ($img_files == "pdf") {
                                                                                                                                $img_files = "pdf.png";
                                                                                                                            } else {
                                                                                                                                if ($img_files == "psd") {
                                                                                                                                    $img_files = "psd.png";
                                                                                                                                } else {
                                                                                                                                    if ($img_files == "sketch") {
                                                                                                                                        $img_files = "sketch.png";
                                                                                                                                    } else {
                                                                                                                                        $img_files = "doc.png";
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            } ?><?php echo $img_files; ?>" height="38" width="30" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body p-50">
                                                        <div class="app-file-recent-details">
                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $stockages['name_files'] ?> - <small style="<?php if ($stockages['send_files'] == "#03f322") {
                                                                                                                                                                            echo "color: #03f322;";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo "color: #ff0000;";
                                                                                                                                                                        } ?>"><?php if ($stockages['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                    if ($stockages['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                        if ($stockages['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                            if ($stockages['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                if ($stockages['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                    if ($stockages['banque'] == "") {
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                } ?></small></div>
                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $stockages['size_files'] ?> octets</div>
                                                            <div class="app-file-last-access font-size-small text-muted">Date du document : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                            echo strftime("%d-%m-%G", strtotime($stockages['dte_files'])); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- App File - Files Section Ends -->
                            </div>
                            <!--PART 2-->
                            <div id="div_min" class="app-file-content p-2 scroll <?= $min ?>">
                                <h5>Tous les documents</h5>
                                <!-- App File - Folder Section Starts -->
                                <label class="app-file-label">Récemment téléchargé</label>
                                <div class="row app-file-folder">
                                    <?php foreach ($recent_min as $recents_min) : ?>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="card border shadow-none mb-1 app-file-info">
                                                <div class="card-content">
                                                    <div class="card-body px-75 py-50">
                                                        <div class="app-file-folder-content d-flex align-items-center">
                                                            <div class="app-file-folder-logo mr-75">
                                                                <i class="bx bx-folder font-medium-4"></i>
                                                            </div>
                                                            <div class="app-file-folder-details">
                                                                <div class="app-file-folder-name font-size-small font-weight-bold"><?= $recents_min['name_files'] ?> - <small style="<?php if ($recents_min['send_files'] == "#03f322") {
                                                                                                                                                                                            echo "color: #03f322;";
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo "color: #ff0000;";
                                                                                                                                                                                        } ?>"><?php if ($recents_min['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                    if ($recents_min['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                        if ($recents_min['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                            if ($recents_min['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($recents_min['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($recents_min['banque'] == "") {
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                                } ?></small></div>
                                                                <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                    echo strftime("%d-%m-%G", strtotime($recents_min['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $recents_min['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($recents_min['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($recents_min['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($recents_min['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($recents_min['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($recents_min['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($recents_min['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>/<?= $recents_min['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $recents_min['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $recents_min['name_files'] ?>&size_files=<?= $recents_min['size_files'] ?>&dte_files=<?= $recents_min['dte_files'] ?>&dte_j=<?= $recents_min['dte_j'] ?>&dte_m=<?= $recents_min['dte_m'] ?>&dte_a=<?= $recents_min['dte_a'] ?>&img_files=<?= $recents_min['img_files'] ?>&type_files_note=<?= $recents_min['type_files_note'] ?>&type_files_avoir=<?= $recents_min['type_files_avoir'] ?>&type_files_fac_achat=<?= $recents_min['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $recents_min['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $recents_min['type_files_caisse_ventes'] ?>&banque=<?= $recents_min['banque'] ?>&send_files=<?= $recents_min['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $recents_min['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- App File - Folder Section Ends -->

                                <div class="form-group">
                                    <hr>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <h5 onclick="dte_2()" style="cursor: pointer;">Trier par mois &nbsp<i style="margin: 0px; padding: 0px; position: relative; top: 2px; cursor: pointer;" class='bx bx-down-arrow-alt'></i></h5>
                                    </div>
                                    <hr id="hr_none_2">
                                    <div id="div_date_2" class="none-validation">
                                        <?php

                                        $size_janv = count($janvier);
                                        $size_fevr = count($fevrier);
                                        $size_mars = count($mars);
                                        $size_avri = count($avril);
                                        $size_mai = count($mai);
                                        $size_juin = count($juin);
                                        $size_juil = count($juillet);
                                        $size_aout = count($aout);
                                        $size_sept = count($septembre);
                                        $size_octo = count($octobre);
                                        $size_nove = count($novembre);
                                        $size_dece = count($decembre);

                                        if ($size_janv == "0") {
                                            $countjanv = "none-validation";
                                        } else {
                                            $countjanv = "";
                                        }
                                        if ($size_fevr == "0") {
                                            $countfevr = "none-validation";
                                        } else {
                                            $countfevr = "";
                                        }
                                        if ($size_mars == "0") {
                                            $countmars = "none-validation";
                                        } else {
                                            $countmars = "";
                                        }
                                        if ($size_avri == "0") {
                                            $countavri = "none-validation";
                                        } else {
                                            $countavri = "";
                                        }
                                        if ($size_mai == "0") {
                                            $countmai = "none-validation";
                                        } else {
                                            $countmai = "";
                                        }
                                        if ($size_juin == "0") {
                                            $countjuin = "none-validation";
                                        } else {
                                            $countjuin = "";
                                        }
                                        if ($size_juil == "0") {
                                            $countjuil = "none-validation";
                                        } else {
                                            $countjuil = "";
                                        }
                                        if ($size_aout == "0") {
                                            $countaout = "none-validation";
                                        } else {
                                            $countaout = "";
                                        }
                                        if ($size_sept == "0") {
                                            $countsept = "none-validation";
                                        } else {
                                            $countsept = "";
                                        }
                                        if ($size_octo == "0") {
                                            $countocto = "none-validation";
                                        } else {
                                            $countocto = "";
                                        }
                                        if ($size_sept == "0") {
                                            $countnove = "none-validation";
                                        } else {
                                            $countnove = "";
                                        }
                                        if ($size_dece == "0") {
                                            $countdece = "none-validation";
                                        } else {
                                            $countdece = "";
                                        }

                                        ?>
                                        <div class="form-group <?= $countjanv ?>">
                                            <label>Janvier <span>(<?= $size_janv ?>)</span><i id="janv_plus" onclick="janv_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="janv_moins" onclick="janv_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_janv" class="row app-file-files none-validation">
                                                <?php foreach ($janvier as $janvierr) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $janvierr['name_files'] ?> - <small style="<?php if ($janvierr['send_files'] == "#03f322") {
                                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                                } ?>"><?php if ($janvierr['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                            if ($janvierr['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                                if ($janvierr['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($janvierr['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($janvierr['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                            if ($janvierr['banque'] == "") {
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Avoir";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Note de Frais";
                                                                                                                                                                                                                                                                                                        } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($janvierr['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $janvierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($janvierr['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($janvierr['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($janvierr['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($janvierr['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($janvierr['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($janvierr['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>/<?= $janvierr['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $janvierr['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $janvierr['name_files'] ?>&size_files=<?= $janvierr['size_files'] ?>&dte_files=<?= $janvierr['dte_files'] ?>&dte_j=<?= $janvierr['dte_j'] ?>&dte_m=<?= $janvierr['dte_m'] ?>&dte_a=<?= $janvierr['dte_a'] ?>&img_files=<?= $janvierr['img_files'] ?>&type_files_note=<?= $janvierr['type_files_note'] ?>&type_files_avoir=<?= $janvierr['type_files_avoir'] ?>&type_files_fac_achat=<?= $janvierr['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $janvierr['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $janvierr['type_files_caisse_ventes'] ?>&banque=<?= $janvierr['banque'] ?>&send_files=<?= $janvierr['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $janvierr['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countfevr ?>">
                                            <label>Fevrier <span>(<?= $size_fevr ?>)</span><i id="fevr_plus" onclick="fevr_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="fevr_moins" onclick="fevr_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_fevr" class="row app-file-files none-validation">
                                                <?php foreach ($fevrier as $fevrierr) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $fevrierr['name_files'] ?> - <small style="<?php if ($fevrierr['send_files'] == "#03f322") {
                                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                                } ?>"><?php if ($fevrierr['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                            if ($fevrierr['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                                if ($fevrierr['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($fevrierr['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($fevrierr['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                            if ($fevrierr['banque'] == "") {
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Avoir";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Note de Frais";
                                                                                                                                                                                                                                                                                                        } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($fevrierr['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $fevrierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($fevrierr['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($fevrierr['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($fevrierr['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($fevrierr['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($fevrierr['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($fevrierr['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>/<?= $fevrierr['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $fevrierr['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $fevrierr['name_files'] ?>&size_files=<?= $fevrierr['size_files'] ?>&dte_files=<?= $fevrierr['dte_files'] ?>&dte_j=<?= $fevrierr['dte_j'] ?>&dte_m=<?= $fevrierr['dte_m'] ?>&dte_a=<?= $fevrierr['dte_a'] ?>&img_files=<?= $fevrierr['img_files'] ?>&type_files_note=<?= $fevrierr['type_files_note'] ?>&type_files_avoir=<?= $fevrierr['type_files_avoir'] ?>&type_files_fac_achat=<?= $fevrierr['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $fevrierr['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $fevrierr['type_files_caisse_ventes'] ?>&banque=<?= $fevrierr['banque'] ?>&send_files=<?= $fevrierr['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $fevrierr['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countmars ?>">
                                            <label>Mars <span>(<?= $size_mars ?>)</span><i id="mars_plus" onclick="mars_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="mars_moins" onclick="mars_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_mars" class="row app-file-files none-validation">
                                                <?php foreach ($mars as $marss) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $marss['name_files'] ?> - <small style="<?php if ($marss['send_files'] == "#03f322") {
                                                                                                                                                                                                echo "color: #03f322;";
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "color: #ff0000;";
                                                                                                                                                                                            } ?>"><?php if ($marss['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                    if ($marss['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                        if ($marss['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                            if ($marss['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($marss['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($marss['banque'] == "") {
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                                } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($marss['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $marss['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($marss['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($marss['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($marss['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($marss['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($marss['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($marss['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>/<?= $marss['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $marss['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $marss['name_files'] ?>&size_files=<?= $marss['size_files'] ?>&dte_files=<?= $marss['dte_files'] ?>&dte_j=<?= $marss['dte_j'] ?>&dte_m=<?= $marss['dte_m'] ?>&dte_a=<?= $marss['dte_a'] ?>&img_files=<?= $marss['img_files'] ?>&type_files_note=<?= $marss['type_files_note'] ?>&type_files_avoir=<?= $marss['type_files_avoir'] ?>&type_files_fac_achat=<?= $marss['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $marss['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $marss['type_files_caisse_ventes'] ?>&banque=<?= $marss['banque'] ?>&send_files=<?= $marss['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $marss['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countavri ?>">
                                            <label>Avril <span>(<?= $size_avri ?>)</span><i id="avri_plus" onclick="avri_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="avri_moins" onclick="avri_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_avri" class="row app-file-files none-validation">
                                                <?php foreach ($avril as $avrill) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $avrill['name_files'] ?> - <small style="<?php if ($avrill['send_files'] == "#03f322") {
                                                                                                                                                                                                echo "color: #03f322;";
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "color: #ff0000;";
                                                                                                                                                                                            } ?>"><?php if ($avrill['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                        if ($avrill['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                            if ($avrill['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                if ($avrill['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($avrill['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($avrill['banque'] == "") {
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Avoir";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Note de Frais";
                                                                                                                                                                                                                                                                                                    } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($avrill['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $avrill['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($avrill['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } elseif ($avrill['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } elseif ($avrill['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } elseif ($avrill['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } elseif ($avrill['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } elseif ($avrill['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>/<?= $avrill['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $avrill['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $avrill['name_files'] ?>&size_files=<?= $avrill['size_files'] ?>&dte_files=<?= $avrill['dte_files'] ?>&dte_j=<?= $avrill['dte_j'] ?>&dte_m=<?= $avrill['dte_m'] ?>&dte_a=<?= $avrill['dte_a'] ?>&img_files=<?= $avrill['img_files'] ?>&type_files_note=<?= $avrill['type_files_note'] ?>&type_files_avoir=<?= $avrill['type_files_avoir'] ?>&type_files_fac_achat=<?= $avrill['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $avrill['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $avrill['type_files_caisse_ventes'] ?>&banque=<?= $avrill['banque'] ?>&send_files=<?= $avrill['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $avrill['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countmai ?>">
                                            <label>Mai <span>(<?= $size_mai ?>)</span><i id="mai_plus" onclick="mai_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="mai_moins" onclick="mai_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_mai" class="row app-file-files none-validation">
                                                <?php foreach ($mai as $maii) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $maii['name_files'] ?> - <small style="<?php if ($maii['send_files'] == "#03f322") {
                                                                                                                                                                                                echo "color: #03f322;";
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "color: #ff0000;";
                                                                                                                                                                                            } ?>"><?php if ($maii['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                    if ($maii['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                        if ($maii['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                            if ($maii['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($maii['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($maii['banque'] == "") {
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                                } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($maii['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $maii['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($maii['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($maii['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($maii['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($maii['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($maii['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($maii['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>/<?= $maii['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $maii['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $maii['name_files'] ?>&size_files=<?= $maii['size_files'] ?>&dte_files=<?= $maii['dte_files'] ?>&dte_j=<?= $maii['dte_j'] ?>&dte_m=<?= $maii['dte_m'] ?>&dte_a=<?= $maii['dte_a'] ?>&img_files=<?= $maii['img_files'] ?>&type_files_note=<?= $maii['type_files_note'] ?>&type_files_avoir=<?= $maii['type_files_avoir'] ?>&type_files_fac_achat=<?= $maii['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $maii['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $maii['type_files_caisse_ventes'] ?>&banque=<?= $maii['banque'] ?>&send_files=<?= $maii['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $maii['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countjuin ?>">
                                            <label>Juin <span>(<?= $size_juin ?>)</span><i id="juin_plus" onclick="juin_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="juin_moins" onclick="juin_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_juin" class="row app-file-files none-validation">
                                                <?php foreach ($juin as $juinn) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $juinn['name_files'] ?> - <small style="<?php if ($juinn['send_files'] == "#03f322") {
                                                                                                                                                                                                echo "color: #03f322;";
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "color: #ff0000;";
                                                                                                                                                                                            } ?>"><?php if ($juinn['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                    if ($juinn['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                        if ($juinn['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                            if ($juinn['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($juinn['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($juinn['banque'] == "") {
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                                } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($juinn['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $juinn['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($juinn['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($juinn['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($juinn['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($juinn['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($juinn['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($juinn['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>/<?= $juinn['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $juinn['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $juinn['name_files'] ?>&size_files=<?= $juinn['size_files'] ?>&dte_files=<?= $juinn['dte_files'] ?>&dte_j=<?= $juinn['dte_j'] ?>&dte_m=<?= $juinn['dte_m'] ?>&dte_a=<?= $juinn['dte_a'] ?>&img_files=<?= $juinn['img_files'] ?>&type_files_note=<?= $juinn['type_files_note'] ?>&type_files_avoir=<?= $juinn['type_files_avoir'] ?>&type_files_fac_achat=<?= $juinn['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $juinn['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $juinn['type_files_caisse_ventes'] ?>&banque=<?= $juinn['banque'] ?>&send_files=<?= $juinn['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $juinn['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countjuil ?>">
                                            <label>Juillet <span>(<?= $size_juil ?>)</span><i id="juil_plus" onclick="juil_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="juil_moins" onclick="juil_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_juil" class="row app-file-files none-validation">
                                                <?php foreach ($juillet as $juillett) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $juillett['name_files'] ?> - <small style="<?php if ($juillett['send_files'] == "#03f322") {
                                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                                } ?>"><?php if ($juillett['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                            if ($juillett['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                                if ($juillett['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($juillett['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($juillett['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                            if ($juillett['banque'] == "") {
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Avoir";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Note de Frais";
                                                                                                                                                                                                                                                                                                        } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($juillett['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $juillett['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($juillett['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($juillett['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($juillett['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($juillett['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($juillett['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($juillett['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>/<?= $juillett['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $juillett['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $juillett['name_files'] ?>&size_files=<?= $juillett['size_files'] ?>&dte_files=<?= $juillett['dte_files'] ?>&dte_j=<?= $juillett['dte_j'] ?>&dte_m=<?= $juillett['dte_m'] ?>&dte_a=<?= $juillett['dte_a'] ?>&img_files=<?= $juillett['img_files'] ?>&type_files_note=<?= $juillett['type_files_note'] ?>&type_files_avoir=<?= $juillett['type_files_avoir'] ?>&type_files_fac_achat=<?= $juillett['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $juillett['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $juillett['type_files_caisse_ventes'] ?>&banque=<?= $juillett['banque'] ?>&send_files=<?= $juillett['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $juillett['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countaout ?>">
                                            <label>Aout <span>(<?= $size_aout ?>)</span><i id="aout_plus" onclick="aout_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="aout_moins" onclick="aout_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_aout" class="row app-file-files none-validation">
                                                <?php foreach ($aout as $aoutt) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $aoutt['name_files'] ?> - <small style="<?php if ($aoutt['send_files'] == "#03f322") {
                                                                                                                                                                                                echo "color: #03f322;";
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo "color: #ff0000;";
                                                                                                                                                                                            } ?>"><?php if ($aoutt['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                    if ($aoutt['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                        if ($aoutt['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                            if ($aoutt['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($aoutt['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($aoutt['banque'] == "") {
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Facture de vente";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Avoir";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Note de Frais";
                                                                                                                                                                                                                                                                                                } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($aoutt['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $aoutt['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($aoutt['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($aoutt['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($aoutt['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($aoutt['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($aoutt['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } elseif ($aoutt['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>/<?= $aoutt['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $aoutt['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $aoutt['name_files'] ?>&size_files=<?= $aoutt['size_files'] ?>&dte_files=<?= $aoutt['dte_files'] ?>&dte_j=<?= $aoutt['dte_j'] ?>&dte_m=<?= $aoutt['dte_m'] ?>&dte_a=<?= $aoutt['dte_a'] ?>&img_files=<?= $aoutt['img_files'] ?>&type_files_note=<?= $aoutt['type_files_note'] ?>&type_files_avoir=<?= $aoutt['type_files_avoir'] ?>&type_files_fac_achat=<?= $aoutt['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $aoutt['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $aoutt['type_files_caisse_ventes'] ?>&banque=<?= $aoutt['banque'] ?>&send_files=<?= $aoutt['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $aoutt['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countsept ?>">
                                            <label>Septembre <span>(<?= $size_sept ?>)</span><i id="sept_plus" onclick="sept_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="sept_moins" onclick="sept_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_sept" class="row app-file-files none-validation">
                                                <?php foreach ($septembre as $septembree) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $septembree['name_files'] ?> - <small style="<?php if ($septembree['send_files'] == "#03f322") {
                                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                                } ?>"><?php if ($septembree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                                if ($septembree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($septembree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($septembree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                            if ($septembree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                                if ($septembree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                                                            } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($septembree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $septembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($septembree['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($septembree['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($septembree['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($septembree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($septembree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($septembree['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?>/<?= $septembree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $septembree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $septembree['name_files'] ?>&size_files=<?= $septembree['size_files'] ?>&dte_files=<?= $septembree['dte_files'] ?>&dte_j=<?= $septembree['dte_j'] ?>&dte_m=<?= $septembree['dte_m'] ?>&dte_a=<?= $septembree['dte_a'] ?>&img_files=<?= $septembree['img_files'] ?>&type_files_note=<?= $septembree['type_files_note'] ?>&type_files_avoir=<?= $septembree['type_files_avoir'] ?>&type_files_fac_achat=<?= $septembree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $septembree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $septembree['type_files_caisse_ventes'] ?>&banque=<?= $septembree['banque'] ?>&send_files=<?= $septembree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $septembree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countocto ?>">
                                            <label>Octobre <span>(<?= $size_octo ?>)</span><i id="octo_plus" onclick="octo_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="octo_moins" onclick="octo_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_octo" class="row app-file-files none-validation">
                                                <?php foreach ($octobre as $octobree) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $octobree['name_files'] ?> - <small style="<?php if ($octobree['send_files'] == "#03f322") {
                                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                                } ?>"><?php if ($octobree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                            if ($octobree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                                if ($octobree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($octobree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($octobree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                            if ($octobree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Avoir";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Note de Frais";
                                                                                                                                                                                                                                                                                                        } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($octobree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $octobree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($octobree['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($octobree['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($octobree['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($octobree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($octobree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($octobree['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>/<?= $octobree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $octobree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $octobree['name_files'] ?>&size_files=<?= $octobree['size_files'] ?>&dte_files=<?= $octobree['dte_files'] ?>&dte_j=<?= $octobree['dte_j'] ?>&dte_m=<?= $octobree['dte_m'] ?>&dte_a=<?= $octobree['dte_a'] ?>&img_files=<?= $octobree['img_files'] ?>&type_files_note=<?= $octobree['type_files_note'] ?>&type_files_avoir=<?= $octobree['type_files_avoir'] ?>&type_files_fac_achat=<?= $octobree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $octobree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $octobree['type_files_caisse_ventes'] ?>&banque=<?= $octobree['banque'] ?>&send_files=<?= $octobree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $octobree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countnove ?>">
                                            <label>Novembre <span>(<?= $size_nove ?>)</span><i id="nove_plus" onclick="nove_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="nove_moins" onclick="nove_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_nove" class="row app-file-files none-validation">
                                                <?php foreach ($novembre as $novembree) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $novembree['name_files'] ?> - <small style="<?php if ($novembree['send_files'] == "#03f322") {
                                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                                } ?>"><?php if ($novembree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                            if ($novembree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                                if ($novembree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($novembree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($novembree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                            if ($novembree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Avoir";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Note de Frais";
                                                                                                                                                                                                                                                                                                        } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($novembree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $novembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($novembree['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($novembree['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($novembree['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($novembree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($novembree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($novembree['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>/<?= $novembree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $novembree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $novembree['name_files'] ?>&size_files=<?= $novembree['size_files'] ?>&dte_files=<?= $novembree['dte_files'] ?>&dte_j=<?= $novembree['dte_j'] ?>&dte_m=<?= $novembree['dte_m'] ?>&dte_a=<?= $novembree['dte_a'] ?>&img_files=<?= $novembree['img_files'] ?>&type_files_note=<?= $novembree['type_files_note'] ?>&type_files_avoir=<?= $novembree['type_files_avoir'] ?>&type_files_fac_achat=<?= $novembree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $novembree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $novembree['type_files_caisse_ventes'] ?>&banque=<?= $novembree['banque'] ?>&send_files=<?= $novembree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $novembree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="form-group <?= $countdece ?>">
                                            <label>Decembre <span>(<?= $size_dece ?>)</span><i id="dece_plus" onclick="dece_plus()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-plus'></i><i id="dece_moins" onclick="dece_moins()" style="position: relative; top: 4px; cursor: pointer;" class='bx bx-minus none-validation'></i></label>
                                            <hr>
                                            <div id="div_dece" class="row app-file-files none-validation">
                                                <?php foreach ($decembre as $decembree) : ?>
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                        <div class="card border shadow-none mb-1 app-file-info">
                                                            <div class="card-content">
                                                                <div class="card-body px-75 py-50">
                                                                    <div class="app-file-folder-content d-flex align-items-center">
                                                                        <div class="app-file-folder-logo mr-75">
                                                                            <i class="bx bx-folder font-medium-4"></i>
                                                                        </div>
                                                                        <div class="app-file-folder-details">
                                                                            <div class="app-file-folder-name font-size-small font-weight-bold"><?= $decembree['name_files'] ?> - <small style="<?php if ($decembree['send_files'] == "#03f322") {
                                                                                                                                                                                                    echo "color: #03f322;";
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "color: #ff0000;";
                                                                                                                                                                                                } ?>"><?php if ($decembree['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                            if ($decembree['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                                if ($decembree['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                                    if ($decembree['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                        if ($decembree['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                            if ($decembree['banque'] == "") {
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                                echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                            echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                        echo "Facture de vente";
                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Avoir";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Note de Frais";
                                                                                                                                                                                                                                                                                                        } ?></small></div>
                                                                            <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($decembree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $decembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($decembree['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($decembree['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($decembree['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($decembree['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($decembree['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } elseif ($decembree['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>/<?= $decembree['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $decembree['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $decembree['name_files'] ?>&size_files=<?= $decembree['size_files'] ?>&dte_files=<?= $decembree['dte_files'] ?>&dte_j=<?= $decembree['dte_j'] ?>&dte_m=<?= $decembree['dte_m'] ?>&dte_a=<?= $decembree['dte_a'] ?>&img_files=<?= $decembree['img_files'] ?>&type_files_note=<?= $decembree['type_files_note'] ?>&type_files_avoir=<?= $decembree['type_files_avoir'] ?>&type_files_fac_achat=<?= $decembree['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $decembree['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $decembree['type_files_caisse_ventes'] ?>&banque=<?= $decembree['banque'] ?>&send_files=<?= $decembree['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $decembree['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- App File - Files Section Starts -->
                                <label class="app-file-label">l'ensemble de vos documents</label>
                                <div class="row app-file-files">
                                    <?php foreach ($stockage as $stockages) : ?>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <div class="card border shadow-none mb-1 app-file-info">
                                                <div class="card-content">
                                                    <div class="card-body px-75 py-50">
                                                        <div class="app-file-folder-content d-flex align-items-center">
                                                            <div class="app-file-folder-logo mr-75">
                                                                <i class="bx bx-folder font-medium-4"></i>
                                                            </div>
                                                            <div class="app-file-folder-details">
                                                                <div class="app-file-folder-name font-size-small font-weight-bold"><?= $stockages['name_files'] ?> - <small style="<?php if ($stockages['send_files'] == "#03f322") {
                                                                                                                                                                                        echo "color: #03f322;";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo "color: #ff0000;";
                                                                                                                                                                                    } ?>"><?php if ($stockages['type_files_note'] == "") {
                                                                                                                                                                                                                                                                                                if ($stockages['type_files_avoir'] == "") {
                                                                                                                                                                                                                                                                                                    if ($stockages['type_files_fac_achat'] == "") {
                                                                                                                                                                                                                                                                                                        if ($stockages['type_files_fac_ventes'] == "") {
                                                                                                                                                                                                                                                                                                            if ($stockages['type_files_caisse_ventes'] == "") {
                                                                                                                                                                                                                                                                                                                if ($stockages['banque'] == "") {
                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                    echo "Relevés bancaires";
                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Relevés de caisse";
                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            echo "Facture de vente";
                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        echo "Facture d'achat";
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                    echo "Avoir";
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Note de Frais";
                                                                                                                                                                                                                                                                                            } ?></small></div>
                                                                <div class="app-file-folder-size font-size-small text-muted">Date : <?php setlocale(LC_TIME, "fr_FR");
                                                                                                                                    echo strftime("%d-%m-%G", strtotime($stockages['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/corbeille_files.php?id=<?= $stockages['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: trash.svg; style: lines; size: 22px; strokeColor: black; "></i></a><a href="../../src/files/<?php if ($stockages['type_files_note'] == "note") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "note";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($stockages['type_files_avoir'] == "avoir") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "avoir";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($stockages['type_files_fac_achat'] == "fac_achat") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "fac_achat";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($stockages['type_files_fac_ventes'] == "fac_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "fac_vente";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($stockages['type_files_caisse_ventes'] == "cas_ventes") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "caisse";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } elseif ($stockages['banque'] == "banque") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo "banque";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?>/<?= $stockages['name_files'] ?>" download><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: download.svg; style: lines; size: 20px; strokeColor: black; strokeColorAction: #977676; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a><a href="loading/button_valid.php?id=<?= $stockages['id'] ?>&name_entreprise=<?= $entreprise['nameentreprise'] ?>&name_files=<?= $stockages['name_files'] ?>&size_files=<?= $stockages['size_files'] ?>&dte_files=<?= $stockages['dte_files'] ?>&dte_j=<?= $stockages['dte_j'] ?>&dte_m=<?= $stockages['dte_m'] ?>&dte_a=<?= $stockages['dte_a'] ?>&img_files=<?= $stockages['img_files'] ?>&type_files_note=<?= $stockages['type_files_note'] ?>&type_files_avoir=<?= $stockages['type_files_avoir'] ?>&type_files_fac_achat=<?= $stockages['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $stockages['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $stockages['type_files_caisse_ventes'] ?>&banque=<?= $stockages['banque'] ?>&send_files=<?= $stockages['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: check-alt.svg; style: lines; size: 20px; strokeColor:<?= $stockages['send_files'] ?>; strokeColorAction: #03f322; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- App File - Files Section Ends -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        function dte() {
            document.getElementById('div_date').style.display = "block";
            document.getElementById('hr_none').style.display = "none";
        }

        function dte_2() {
            document.getElementById('div_date_2').style.display = "block";
            document.getElementById('hr_none_2').style.display = "none";
        }

        function chang() {

            var formy = "<?= $entreprise['forme_cloud'] ?>";

            if (formy == "max") {
                document.getElementById('div_max').style.display = "none";
                document.getElementById('div_min').style.display = "block";

            } else {
                document.getElementById('div_max').style.display = "block";
                document.getElementById('div_min').style.display = "none";

            }
        }
    </script>
    <script>
        function janv_plus() {
            document.getElementById('janv_plus').style.display = "none";
            document.getElementById('janv_moins').style.display = "block";
            document.getElementById('div_janv').style.display = "block";
        }

        function janv_moins() {
            document.getElementById('janv_plus').style.display = "block";
            document.getElementById('janv_moins').style.display = "none";
            document.getElementById('div_janv').style.display = "none";
        }

        function fevr_plus() {
            document.getElementById('fevr_plus').style.display = "none";
            document.getElementById('fevr_moins').style.display = "block";
            document.getElementById('div_fevr').style.display = "block";
        }

        function fevr_moins() {
            document.getElementById('fevr_plus').style.display = "block";
            document.getElementById('fevr_moins').style.display = "none";
            document.getElementById('div_fevr').style.display = "none";
        }

        function mars_plus() {
            document.getElementById('mars_plus').style.display = "none";
            document.getElementById('mars_moins').style.display = "block";
            document.getElementById('div_mars').style.display = "block";
        }

        function mars_moins() {
            document.getElementById('mars_plus').style.display = "block";
            document.getElementById('mars_moins').style.display = "none";
            document.getElementById('div_mars').style.display = "none";
        }

        function avri_plus() {
            document.getElementById('avri_plus').style.display = "none";
            document.getElementById('avri_moins').style.display = "block";
            document.getElementById('div_avri').style.display = "block";
        }

        function avri_moins() {
            document.getElementById('avri_plus').style.display = "block";
            document.getElementById('avri_moins').style.display = "none";
            document.getElementById('div_avri').style.display = "none";
        }

        function mai_plus() {
            document.getElementById('mai_plus').style.display = "none";
            document.getElementById('mai_moins').style.display = "block";
            document.getElementById('div_mai').style.display = "block";
        }

        function mai_moins() {
            document.getElementById('mai_plus').style.display = "block";
            document.getElementById('mai_moins').style.display = "none";
            document.getElementById('div_mai').style.display = "none";
        }

        function juin_plus() {
            document.getElementById('juin_plus').style.display = "none";
            document.getElementById('juin_moins').style.display = "block";
            document.getElementById('div_juin').style.display = "block";
        }

        function juin_moins() {
            document.getElementById('juin_plus').style.display = "block";
            document.getElementById('juin_moins').style.display = "none";
            document.getElementById('div_juin').style.display = "none";
        }

        function juil_plus() {
            document.getElementById('juil_plus').style.display = "none";
            document.getElementById('juil_moins').style.display = "block";
            document.getElementById('div_juil').style.display = "block";
        }

        function juil_moins() {
            document.getElementById('juil_plus').style.display = "block";
            document.getElementById('juil_moins').style.display = "none";
            document.getElementById('div_juil').style.display = "none";
        }

        function aout_plus() {
            document.getElementById('aout_plus').style.display = "none";
            document.getElementById('aout_moins').style.display = "block";
            document.getElementById('div_aout').style.display = "block";
        }

        function aout_moins() {
            document.getElementById('aout_plus').style.display = "block";
            document.getElementById('aout_moins').style.display = "none";
            document.getElementById('div_aout').style.display = "none";
        }

        function sept_plus() {
            document.getElementById('sept_plus').style.display = "none";
            document.getElementById('sept_moins').style.display = "block";
            document.getElementById('div_sept').style.display = "block";
        }

        function sept_moins() {
            document.getElementById('sept_plus').style.display = "block";
            document.getElementById('sept_moins').style.display = "none";
            document.getElementById('div_sept').style.display = "none";
        }

        function octo_plus() {
            document.getElementById('octo_plus').style.display = "none";
            document.getElementById('octo_moins').style.display = "block";
            document.getElementById('div_octo').style.display = "block";
        }

        function octo_moins() {
            document.getElementById('octo_plus').style.display = "block";
            document.getElementById('octo_moins').style.display = "none";
            document.getElementById('div_octo').style.display = "none";
        }

        function nove_plus() {
            document.getElementById('nove_plus').style.display = "none";
            document.getElementById('nove_moins').style.display = "block";
            document.getElementById('div_nove').style.display = "block";
        }

        function nove_moins() {
            document.getElementById('nove_plus').style.display = "block";
            document.getElementById('nove_moins').style.display = "none";
            document.getElementById('div_nove').style.display = "none";
        }

        function dece_plus() {
            document.getElementById('dece_plus').style.display = "none";
            document.getElementById('dece_moins').style.display = "block";
            document.getElementById('div_dece').style.display = "block";
        }

        function dece_moins() {
            document.getElementById('dece_plus').style.display = "block";
            document.getElementById('dece_moins').style.display = "none";
            document.getElementById('div_dece').style.display = "none";
        }
    </script>
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
    <script src="../../../app-assets/js/scripts/pages/app-file-manager.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>