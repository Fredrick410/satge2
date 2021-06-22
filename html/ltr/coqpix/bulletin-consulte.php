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

    $pdoStat = $bdd->prepare('SELECT * FROM bulletin_salaire WHERE id_session = :num AND statut_bulletin="En cours"');
    $pdoStat->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $bulletin_wait = $pdoStat->fetchAll();
    $count_wait = count($bulletin_wait);

    $pdoStat = $bdd->prepare('SELECT * FROM bulletin_salaire WHERE id_session = :num AND statut_bulletin="Terminée"');
    $pdoStat->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $bulletin_finish = $pdoStat->fetchAll();
    $count_finish = count($bulletin_finish);

    //désactivation des notifications
    $pdoSta = $bdd->prepare('DELETE FROM notif_front WHERE type_demande="bulletin_salaire" AND id_session=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_session']);
    $pdoSta->execute();

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
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body"> 
                <div class="form-group">
                    <h5>Mes demandes de bulletins</h5>
                    <hr>
                    <div class="form-group <?php if($count_wait == 0){}else{echo 'none-validation';} ?>">
                        <p>Aucune demande de bulletins de salaire ...</p>
                    </div>
                    <div class="form-group">
                        <?php foreach($bulletin_wait as $bulletin_waits): ?>
                            <div class="card bg-transparent col-6" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid <?php if($bulletin_waits['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_waits['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;" >
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5>Mon bulletin (<?= $bulletin_waits['name_membre'] ?>)</h5>
                                            <p>Demander le <?= $bulletin_waits['date_demande'] ?></p>
                                            <p class="<?php if($bulletin_waits['statut_bulletin'] == "En cours"){echo "none-validation";} ?>">Donner le <?= $bulletin_waits['date_demande'] ?></p>
                                            <label>Statut de votre demande : </label>&nbsp<p style="display: inline; color: <?php if($bulletin_waits['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_waits['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;"><?= $bulletin_waits['statut_bulletin'] ?></p>
                                        </div>
                                        <div class="row <?php if($bulletin_waits['statut_bulletin'] == "En cours"){echo "none-validation";} ?>">
                                            <div class="col">
                                                <a href="../../../src/bulletin_salaire/<?= $bulletin_waits['files_bulletin'] ?>" target='_blank' style="display: inline;"><i class='bx bx-show-alt icon_action'></i></a>&nbsp&nbsp&nbsp<a href="../../../src/bulletin_salaire/<?= $bulletin_waits['files_bulletin'] ?>" download style="display: inline;"><i class='bx bxs-download icon_action'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;  ?>
                    </div>
                </div>
                <div class="form-group">
                    <br>
                </div>
                <div class="form-group">
                    <h5>Mes bulletins de salaire</h5>
                    <hr>
                    <div class="form-group <?php if($count_finish == 0){}else{echo 'none-validation';} ?>">
                        <p>Aucun bulletins de salaire ...</p>                   
                    </div>
                    <div class="form-group">
                        <?php foreach($bulletin_finish as $bulletin_finished): ?>
                            <div class="card bg-transparent col-6" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid <?php if($bulletin_finished['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_finished['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;" >
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5>Mon bulletin (<?= $bulletin_finished['name_membre'] ?>)</h5>
                                            <p>Demander le <?= $bulletin_finished['date_demande'] ?></p>
                                            <p class="<?php if($bulletin_finished['statut_bulletin'] == "En cours"){echo "none-validation";} ?>">Donner le <?= $bulletin_finished['date_demande'] ?></p>
                                            <label>Statut de votre demande : </label>&nbsp<p style="display: inline; color: <?php if($bulletin_finished['statut_bulletin'] == "En cours"){echo "orange";}elseif($bulletin_finished['statut_bulletin'] == "Terminée"){echo "#07ff84";} ?>;"><?= $bulletin_finished['statut_bulletin'] ?></p>
                                        </div>
                                        <div class="row <?php if($bulletin_finished['statut_bulletin'] == "En cours"){echo "none-validation";} ?>">
                                            <div class="col">
                                                <a href="../../../src/bulletin_salaire/<?= $bulletin_finished['files_bulletin'] ?>" target='_blank' style="display: inline;"><i class='bx bx-show-alt icon_action'></i></a>&nbsp&nbsp&nbsp<a href="../../../src/bulletin_salaire/<?= $bulletin_finished['files_bulletin'] ?>" download style="display: inline;"><i class='bx bxs-download icon_action'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;  ?>
                    </div>
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
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>