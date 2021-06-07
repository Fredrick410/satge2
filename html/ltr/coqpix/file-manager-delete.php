<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

// SELECT DES FILES ! ALL ! RECENT ! PAR MOIS

//ALL

$pdoSta = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session = :num');
$pdoSta->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSta->execute();
$stockage = $pdoSta->fetchAll();

//RECENT

$pdoSta = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session = :num ORDER BY id DESC LIMIT 4');
$pdoSta->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSta->execute();
$recent = $pdoSta->fetchAll();

$pdoSta = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session = :num ORDER BY id DESC LIMIT 8');
$pdoSta->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSta->execute();
$recent_min = $pdoSta->fetchAll();

//PAR MOIS

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="01"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$janvier = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="02"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$fevrier = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="03"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$mars = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="04"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$avril = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="05"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$mai = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="06"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$juin = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="07"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$juillet = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="08"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$aout = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="09"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$septembre = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="10"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$octobre = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="11"');
$pdoSt->bindValue(':num', $_SESSION['id'], PDO::PARAM_INT);
$pdoSt->execute();
$novembre = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM stockage_delete WHERE id_session=:num AND dte_m="12"');
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
                                    <a href="file-manager.php" class="list-group-item list-group-item-action pt-0">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: morph-folder.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;"></i>
                                        </div>
                                        Tous les documents
                                    </a>
                                    <a href="file-manager-delete.php" class="list-group-item list-group-item-action pt-0 active">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent; duration:0.85;"></i>
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
                                <!-- App File Left Sidebar - Drive Content Ends -->
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
                                                        <a href="php/delete_files.php?id=<?= $recents['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                        <a href="php/reset_files.php?id=<?= $recents['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                        <a href="php/delete_files.php?id=<?= $janvierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                        <a href="php/reset_files.php?id=<?= $janvierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $fevrierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $fevrierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $marss['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $marss['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $avrill['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $avrill['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $maii['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $maii['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $juinn['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $juinn['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $juillett['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $juillett['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $aoutt['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $aoutt['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $septembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $septembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $octobree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $octobree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $novembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $novembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                    <a href="php/delete_files.php?id=<?= $decembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                                    <a href="php/reset_files.php?id=<?= $decembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                        <a href="php/delete_files.php?id=<?= $stockages['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a>
                                                        <a href="php/reset_files.php?id=<?= $stockages['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a>
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
                                                                                                                                    echo strftime("%d-%m-%G", strtotime($recents_min['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $recents_min['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $recents_min['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
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
                                        <div class="form-group">
                                            <label>Janvier</label>
                                            <hr>
                                            <div class="form-group">
                                                <div class="row app-file-files">
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
                                                                                                                                                    echo strftime("%d-%m-%G", strtotime($janvierr['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $janvierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $janvierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
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
                                        <div class="form-group">
                                            <label>Février</label>
                                            <hr>
                                            <div class="row app-file-files">
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($fevrierr['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $fevrierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $fevrierr['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($marss['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $marss['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $marss['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($avrill['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $avrill['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $avrill['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($maii['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $maii['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $maii['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($juinn['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $juinn['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $juinn['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($juillett['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $juillett['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $juillett['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($aoutt['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $aoutt['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $aoutt['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($septembree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $septembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $septembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($octobree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $octobree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $octobree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($novembree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $novembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $novembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
                                                                        </div>
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
                                                                                                                                                echo strftime("%d-%m-%G", strtotime($decembree['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $decembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $decembree['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
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
                                                                                                                                    echo strftime("%d-%m-%G", strtotime($stockages['dte_files'])); ?>&nbsp&nbsp&nbsp&nbsp<a href="php/delete_files.php?id=<?= $stockages['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: remove.svg; style: lines; size: 18px; strokeColor: grey;"></i></a><a href="php/reset_files.php?id=<?= $stockages['id'] ?>"><i class="livicon-evo app-file-edit-icon d-block float-right" data-options=" name: rotate-right.svg; style: lines; size: 20px; strokeColor: grey; strokeColorAction: red; colorsOnHover: custom; colorsHoverTime: 0.1 "></i></a></div>
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