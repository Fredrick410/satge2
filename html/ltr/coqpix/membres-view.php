<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM membres WHERE id = :num');
    $pdoSt->bindValue(':num',$_GET['nummembres']);
    $pdoSt->execute();
    $membre = $pdoSt->fetch();

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
    <title>Profile de <?= $membre['prenom'] ?></title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.gif">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">

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
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix"><div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>   <!--NOTIFICATION-->
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
                <!-- users view start -->
                <section class="users-view">
                    <!-- users view media object start -->
                    <div class="row">
                        <div class="col-12 col-sm-7">
                            <div class="media mb-2">
                                <a class="mr-1" href="#">
                                    <img src="../../../src/img/<?= $membre['img_membres'] ?>" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                </a>
                                <div class="media-body pt-25">
                                     <h4 class="media-heading"><?= $membre['nom'] ?> <?= $membre['prenom'] ?></h4>
                                    <span>ID:</span>
                                    <span>00<?= $membre['id'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                            <a href="membres-edit.php?nummembre=<?= $membre['id'] ?>" class="btn btn-sm btn-primary">Editer</a>
                        </div>
                    </div>
                    <!-- users view media object ends -->
                    <!-- users view card data start -->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Création du compte:</td>
                                                    <td><?= $membre['startdte'] ?></td>
                                                </tr>
                                                    <td>Employer :</td>
                                                    <td class="users-view-role"><?= $membre['role_membres'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status:</td>
                                                    <td><span class="badge badge-light-success users-view-status"><?= $membre['status_membres'] ?></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Module Permission</th>
                                                        <th>Ventes</th>
                                                        <th>Achats</th>
                                                        <th>Projets</th>
                                                        <th>Inventaires</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Lire (Seulememnt)</td>
                                                        <td><?php if($membre['perms_ventes'] == "view"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_achats'] == "view"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_projets'] == "view"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_inventaires'] == "view"){echo "Oui";}else{echo "Non";} ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ecrire (Ecrire = lire)</td>
                                                        <td><?php if($membre['perms_ventes'] == "write"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_achats'] == "write"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_projets'] == "write"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_inventaires'] == "write"){echo "Oui";}else{echo "Non";} ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tout (<a href="javascript:ouvre_popup('popup.html')">Voir les permissions</a>)</td>
                                                        <script type="text/javascript">
                                                            function ouvre_popup(page) {
                                                                window.open(page,"nom_popup","menubar=no, status=no, scrollbars=no, menubar=no, width=200, height=100");
                                                            }
                                                        </script>
                                                        <td><?php if($membre['perms_ventes'] == "all"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_achats'] == "all"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_projets'] == "all"){echo "Oui";}else{echo "Non";} ?></td>
                                                        <td><?php if($membre['perms_inventaires'] == "all"){echo "Oui";}else{echo "Non";} ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view card data ends -->
                    <!-- users view card details start -->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                                    <div class="col-12 col-sm-4 p-2">
                                        <h6 class="text-primary mb-0">Note de frais : <span class="font-large-1 align-middle"><?= $membre['nb_doc_note'] ?></span></h6>
                                    </div>
                                    <div class="col-12 col-sm-4 p-2">
                                        <h6 class="text-primary mb-0">Fracture de vente: <span class="font-large-1 align-middle">0</span></h6>
                                    </div>
                                    <div class="col-12 col-sm-4 p-2">
                                        <h6 class="text-primary mb-0">CoinsPix : <span class="font-large-1 align-middle">Bientot</span></h6>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Nom :</td>
                                                <td><?= $membre['nom'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Prénom :</td>
                                                <td><?= $membre['prenom'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>E-mail:</td>
                                                <td class="users-view-email"><?= $membre['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Entreprise :</td>
                                                <td><?= $membre['name_entreprise'] ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <h5 class="mb-1"><i class="bx bx-link"></i> Réseaux Sociaux (SOON)</h5>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Twitter:</td>
                                                <td><a href="#">https://www.twitter.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Facebook:</td>
                                                <td><a href="#">https://www.facebook.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Instagram:</td>
                                                <td><a href="#">https://www.instagram.com/</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h5 class="mb-1"><i class="bx bx-info-circle"></i> Information Perso</h5>
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Naissance : </td>
                                                <td> <?= $membre['dtenaissance'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Pays :</td>
                                                <td><?= $membre['pays'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Languages :</td>
                                                <td><?= $membre['langue'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Téléphone :</td>
                                                <td><?= $membre['tel'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view card details ends -->

                </section>
                <!-- users view ends -->
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
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-light.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>