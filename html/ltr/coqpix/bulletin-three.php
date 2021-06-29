<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/verif_session_connect.php';
require_once 'php/config.php';
   
    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $entreprise = $pdoStat->fetch();

    $pdoStat = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
    $pdoStat->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $membre = $pdoStat->fetchAll();

    if($_GET['secteur'] == ""){
        header("location: bulletin-view.php?req=false");
        exit();
    }

    if($_GET['member'] == ""){
        header("location: bulletin-two.php?secteur=".$_GET['secteur']."&req=false_one");
        exit();
    }

    if(empty($_GET['zone_t'])){
        header("location: bulletin-two.php?secteur=".$_GET['secteur']."&req=false_two");
        exit();
    }

    if(empty($_GET['zone_tr'])){
        header("location: bulletin-two.php?secteur=".$_GET['secteur']."&req=false_three");
        exit();
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
    <title>Bulletin de salaire</title>
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">
<style>
    .none-validation{display: none;}
    .icon_plus{cursor: pointer; font-size: 30px; color: #07ff84;}
    .icon_minius{cursor: pointer; font-size: 30px; color: #ff0000;}
    .icon_plus:hover{opacity: 0.5;}
    .icon_minius:hover{opacity: 0.5;}
    .icon_action{color: grey; cursor: pointer;}
    .icon_action:hover{color: blue; opacity: 0.9;}
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
        <div class="content-wrapper">
            <div class="content-body">
                <div class="form-group">
                    <h4>Etape 3 - Finalisation (Information sur l'employé)</h4>
                    <br>
                </div>
                <div class="form-group">
                    <label>Employé : <?= $_GET['member'] ?></label><br>
                    <label>Secteur d'activité de l'entreprise : <?= $_GET['secteur'] ?></label><br>
                    <small>Le remplissage de tous les champs n'est pas requis (Les champs vides seront remplacés par une valeur nulle)</small>
                    <hr>
                </div>
                <div class="form-group">
                    <form class="form-horizontal" method="POST" action="php/insert_bulletin_salaire.php">
                        <input type="hidden" name="name_entreprise" value="<?= $entreprise['nameentreprise'] ?>">
                        <input type="hidden" name="name_membre" value="<?= $_GET['member'] ?>">
                        <input type="hidden" name="secteur_activité" value="<?= $_GET['secteur'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Heure de base</label>
                                    <div class="controls">
                                        <input type="number" step="0.01" name="heuredebase" class="form-control" placeholder="Heures de l'employé (en heures)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Congés sans solde ( <small>Abscences, retards, etc</small> )</label>
                                    <div class="controls">
                                        <input type="number" name="congessanssolde" class="form-control" data-validation-required-message="This field is required" placeholder="Congés sans solde (en heure)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Heure supplementaire (Temps plein)</label>
                                    <div class="controls">
                                        <input type="number" name="heuresupp_tp" class="form-control" placeholder="Heure supplementaire (par mois)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Heure complémentaire (Temps partiel)</label>
                                    <div class="controls">
                                        <input type="number" name="heurecompl_tpartiel" class="form-control" placeholder="Heure complémentaire (en heure)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Heure de nuit</label>
                                    <div class="controls">
                                        <input type="number" name="heuredenuit" class="form-control" placeholder="Heure de nuit (en heure)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>(Indemnités) repas (<small>Uniquement les journées entières</small>)</label>
                                    <div class="controls">
                                        <input type="number" name="repas" class="form-control" placeholder="Nombre de repas (en jours)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Primes</label>
                                    <div class="controls">
                                        <input type="number" name="primes" class="form-control" data-validation-required-message="This field is required" placeholder="Primes (en euros)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Remboursement transport</label>
                                    <div class="controls">
                                        <input type="number" name="remboursementtransport" class="form-control" data-validation-required-message="This field is required" placeholder="Remboursement transport (en euros)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Congés payés</label>
                                    <div class="controls">
                                        <input type="number" name="congespayes" class="form-control" data-validation-required-message="This field is required" placeholder="Congés payés (en heure)">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Congés maternité</label>
                                    <div class="controls">
                                        <input type="number" name="congesmaternite" class="form-control" data-validation-required-message="This field is required" placeholder="Congés maternité (en heure)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Congés paternité</label>
                                    <div class="controls">
                                        <input type="number" name="congespaternite" class="form-control" data-validation-required-message="This field is required" placeholder="Congés parternité (en heure)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Avantages en nature</label>
                                    <div class="controls">
                                        <input type="number" name="avantagenature" class="form-control" data-validation-required-message="This field is required" placeholder="Avantages en nature (en euros)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group <?php if($_GET['secteur'] !== "BTP"){echo "none-validation";} ?>">
                            <hr>
                        </div>
                        <div class="row <?php if(empty($_GET['indemnites_t'])){echo 'none-validation';} ?> <?php if($_GET['secteur'] !== "BTP"){echo "none-validation";} ?>">
                            <div class="col-md-6">
                                <div class="form-group <?php if($_GET['zone_t'] !== "1A"){echo 'none-validation';} ?> <?php if($_GET['zone_t'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de trajet zone 1A</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdet_1A" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de trajet 1A (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_t'] !== "1B"){echo 'none-validation';} ?> <?php if($_GET['zone_t'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de trajet zone 1B</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdet_1B" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de trajet 1B (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_t'] !== "2"){echo 'none-validation';} ?> <?php if($_GET['zone_t'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de trajet zone 2</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdet_2" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de trajet 2 (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_t'] !== "3"){echo 'none-validation';} ?> <?php if($_GET['zone_t'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de trajet zone 3</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdet_3" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de trajet 3 (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_t'] !== "4"){echo 'none-validation';} ?> <?php if($_GET['zone_t'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de trajet zone 4</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdet_4" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de trajet 4 (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_t'] !== "5"){echo 'none-validation';} ?> <?php if($_GET['zone_t'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de trajet zone 5</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdet_5" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de trajet 5 (en kilometre)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group <?php if($_GET['secteur'] !== "BTP"){echo "none-validation";} ?>">
                            <hr>
                        </div>
                        <div class="row <?php if(empty($_GET['indemnites_tr'])){echo 'none-validation';} ?> <?php if($_GET['secteur'] !== "BTP"){echo "none-validation";} ?>">
                            <div class="col-md-6">
                                <div class="form-group <?php if($_GET['zone_tr'] !== "1A"){echo 'none-validation';} ?> <?php if($_GET['zone_tr'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de transport zone 1A</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdetr_1A" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de transport 1A (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_tr'] !== "1B"){echo 'none-validation';} ?> <?php if($_GET['zone_tr'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de transport zone 1B</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdetr_1B" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de transport 1B (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_tr'] !== "2"){echo 'none-validation';} ?> <?php if($_GET['zone_tr'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de transport zone 2</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdetr_2" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de transport 2 (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_tr'] !== "3"){echo 'none-validation';} ?> <?php if($_GET['zone_tr'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de transport zone 3</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdetr_3" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de transport 3 (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_tr'] !== "4"){echo 'none-validation';} ?> <?php if($_GET['zone_tr'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de transport zone 4</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdetr_4" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de transport 4 (en kilometre)">
                                    </div>
                                </div>
                                <div class="form-group <?php if($_GET['zone_tr'] !== "5"){echo 'none-validation';} ?> <?php if($_GET['zone_tr'] == "disabled"){echo "none-validation";} ?>">
                                    <label>Indemnités de transport zone 5</label>
                                    <div class="controls">
                                        <input type="number" name="indemnitesdetr_5" class="form-control" data-validation-required-message="This field is required" placeholder="Indemnités de transport 5 (en kilometre)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Continuer</button>
                    </form>
                </div>
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
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script>
    
        function no(){
            document.getElementById('bt_no').style.display = "none";
            document.getElementById('bt_oui').style.display = "none";
            document.getElementById('div_section').style.display = "block";
        }

    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>