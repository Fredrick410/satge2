<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();

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
    <title>RH - Recrutement</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
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
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
                        </ul>
                        <script>
                            function retourn() {
                                window.history.back();
                            }
                        </script>
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
                <!-- vertical Wizard start-->
                <section id="vertical-wizard">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Votre annonce de recrutement</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="php/insert_rh_annonce.php" method="POST" class="wizard-vertical">
                                    <!-- step 1 -->
                                    <h3>
                                        <span class="fonticon-wrap mr-1">
                                            <i class="livicon-evo" data-options="name:gear.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                        </span>
                                        <span class="icon-title">
                                            <span class="d-block">Paramètre principaux</span>
                                            <small class="text-muted">Configurez les détails de votre annonce ici.</small>
                                        </span>
                                    </h3>
                                    <!-- step 1 end-->
                                    <!-- step 1 content -->
                                    <fieldset class="pt-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="firstName12">* Nom de l'annonce </label>
                                                    <input type="text" name="name_annonce" class="form-control" placeholder="Entrez le nom de votre annonce" required>
                                                    <small class="text-muted form-text">Entrez votre nom d'annonce s'il vous plait.</small>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Thème de l'annonce</label><br>
                                                    <input type="color" name="color_annonce" style="width: 100%;" required>
                                                    <small class="text-muted form-text">Selectionnez une couleur pour définir un thème à votre annonce de recrutement.</small>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="firstName12">Description de l'annonce </label>
                                                    <input type="text" name="description_annonce" class="form-control" placeholder="Description de l'annonce">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="lastName1">Code de partage</label>
                                                    <input type="text" name="code_annonce" class="form-control" placeholder="Entrez votre code de partage">
                                                    <small class="text-muted form-text">Code de partage va permettre de donner accès a l'annonce de recrutement en externe.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="emailAddress12">E-mail de contact</label>
                                                    <input type="email" name="email_annonce" class="form-control" placeholder="Entrez votre mail" required>
                                                    <small class="text-muted form-text">Veuillez saisir votre adresse e-mail.</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Téléphone de contact</label>
                                                    <input type="tel" name="tel_annonce" class="form-control" placeholder="+33600000000" required>
                                                    <small class="text-muted form-text">Veuillez entrer votre numéro de téléphone.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!-- step 1 content end-->
                                    <div class="form-group">
                                        <hr>
                                    </div>
                                    <!-- step 2 -->
                                    <h3>
                                        <span class="fonticon-wrap mr-1">
                                            <i class="livicon-evo" data-options="name:users.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                        </span>
                                        <span class="icon-title">
                                            <span class="d-block">Profile des candidats</span>
                                            <small class="text-muted">Cherche le candidat parfais.</small>
                                        </span>
                                    </h3>
                                    <!-- step 2 end-->
                                    <!-- step 2 content -->
                                    <fieldset class="pt-0">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="proposalTitle1">Age du candidat</label>
                                                    <select name="age_annonce" class="custom-select">
                                                        <option value="Pas d'age limite" selected>Selectionnez un age</option>
                                                        <optgroup></optgroup>
                                                        <option value="14 - 16">14 - 16 ans</option>
                                                        <option value="16 - 18">16 - 18 ans</option>
                                                        <option value="18 - 20">18 - 25 ans</option>
                                                        <option value="20 - +">25 ans et plus</option>
                                                        <option value="Age indéterminé">Age indéterminé</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Niveau d'étude</label>
                                                    <select name="niveau_annonce" class="form-control">
                                                        <option value="Aucun niveau">Selectionnez un niveau d'étude</option>
                                                        <option value="Niveau 1 et 2">Niveau 1 et 2</option>
                                                        <option value="Niveau 3">Niveau 3</option>
                                                        <option value="Niveau 4 (BAC +0)">Niveau 4 (BAC +0)</option>
                                                        <option value="Niveau 5 (BAC +2)">Niveau 5 (BAC +2)</option>
                                                        <option value="Niveau 6 (BAC +3)">Niveau 6 (BAC +3)</option>
                                                        <option value="Niveau 7 (BAC +5)">Niveau 7 (BAC +5)</option>
                                                        <option value="Niveau 8 (BAC +8 et plus)">Niveau 8 (BAC +8 et plus)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Poste du candidat</label>
                                                    <input type="text" name="poste_annonce" class="form-control" placeholder="exemple(Informaticien, comptable)">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pays</label>
                                                    <select class="custom-select form-control" name="pays_annonce">
                                                        <option value="France" selected>France</option>
                                                        <option value="Etranger">Etranger</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Durée d'embauche minimum</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <select name="date_y" class="form-control">
                                                                        <option value="0" selected>0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10+">10 ou plus</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col">
                                                                    <label style="position: relative; top: 10px;">Années</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input type="number" name="date_m" class="form-control" placeholder="0">
                                                                </div>
                                                                <div class="col">
                                                                    <label style="position: relative; top: 10px;">Mois</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input type="number" name="date_d" class="form-control" placeholder="0">
                                                                </div>
                                                                <div class="col">
                                                                    <label style="position: relative; top: 10px;">Jours</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!-- step 2 content end-->
                                    <div class="form-group">
                                        <hr>
                                    </div>
                                    <!-- section 3 -->
                                    <h3>
                                        <span class="fonticon-wrap mr-1">
                                            <i class="livicon-evo" data-options="name:notebook.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                        </span>
                                        <span class="icon-title">
                                            <span class="d-block">Nos qcm (Bientot disponible)</span>
                                            <small class="text-muted">Sélectionnez un ou plusieurs qcm pour tester vos candidats.</small>
                                        </span>
                                    </h3>
                                    <!-- section 3 end-->
                                    <!-- Switch Icons Starts -->
                                    <section id="switch-icons">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">NOS QCM</h4>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body text-center">
                                                            <div class="d-flex justify-content-start flex-wrap">
                                                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                    <p class="mb-0">QCM Anglais</p>
                                                                    <input type="checkbox" name="qcmanglais" class="custom-control-input" id="customSwitch1">
                                                                    <label class="custom-control-label" for="customSwitch1">
                                                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                        <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                    <p class="mb-0">QCM Confiance</p>
                                                                    <input type="checkbox" name="qcmconfiance" class="custom-control-input" id="customSwitch2">
                                                                    <label class="custom-control-label" for="customSwitch2">
                                                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                        <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                    <p class="mb-0">QCM intelligence</p>
                                                                    <input type="checkbox" name="qcmintelligence" class="custom-control-input" id="customSwitch3">
                                                                    <label class="custom-control-label" for="customSwitch3">
                                                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                        <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                    <p class="mb-0">QCM Psycologique</p>
                                                                    <input type="checkbox" name="qcmpsy" class="custom-control-input" id="customSwitch4">
                                                                    <label class="custom-control-label" for="customSwitch4">
                                                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                        <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                    <p class="mb-0">QCM Physique</p>
                                                                    <input type="checkbox" name="qcmphy" class="custom-control-input" id="customSwitch5">
                                                                    <label class="custom-control-label" for="customSwitch5">
                                                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                        <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Switch Icons Ends -->
                                    <style>
                                        .btconf{background-color: #34465b; color: white;}
                                        .btconf:hover{background-color: #3fff21; color: white;}
                                    </style>
                                    <div class="form-group">
                                        <button type="submit" class="btn col-12 btconf">Confirmation de l'annonce</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- vertical Wizard end-->

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
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>