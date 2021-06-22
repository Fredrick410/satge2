<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/verif_session_connect.php';
require_once 'php/config.php';

$pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoStat->bindValue(':numentreprise', $_SESSION['id_session']); //$_SESSION 
$pdoStat->execute();
$entreprise = $pdoStat->fetch();

$pdoStat = $bdd->prepare('SELECT * FROM bilan WHERE id_session = :num AND date_a=:date_a');
$pdoStat->bindValue(':num', $_SESSION['id_session']); 
$pdoStat->bindValue(':date_a', $_GET['5PAx4zf27P']); 
$pdoStat->execute();
$bilan = $pdoStat->fetchAll();
$count_bilan = count($bilan);

//désactivation des notifications
$pdoSta = $bdd->prepare('DELETE FROM notif_front WHERE id_session=:num');
$pdoSta->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
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
    <title>Bilan - <?= $_GET['5PAx4zf27P'] ?></title>
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
    .none-validation{
        display: none;
    }
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
                    <h4>Vos Bilans</h4>
                </div>
                <div class="form-group">
                    <p>L'upload de votre liasse fiscale, varie en fonction de la cloture d'exercice.</p>
                </div>
                <div class="row" style="margin-top: 100px;">
                    <div class="col text-center" style="padding-top: 140px;">
                        <div class="form-group">
                            <p class="lead" style="margin-left: 20px;">
                                Selectionner une année 😜
                            </p>
                        </div>
                        <div class="form-group">
                            <fieldset class="form-group col">
                                <select id="select_annee" onchange="select_annee()" class="custom-select">
                                    <option selected value="<?= $_GET['5PAx4zf27P'] ?>"><?= $_GET['5PAx4zf27P'] ?> <?php if($_GET['5PAx4zf27P'] == date('Y')){echo "(Année actuelle)";} ?></option>
                                    <optgroup></optgroup>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <hr>
                        </div>
                        <div class="form-group <?php if($count_bilan > 0){echo "none-validation";} ?>">
                            <p class="text-muted">Aucun bilan pour l'année <?= $_GET['5PAx4zf27P'] ?> ...</p>
                        </div>
                        <div class="form-group <?php if($count_bilan <= 0){echo "none-validation";} ?>">
                                <?php foreach($bilan as $bilans): ?>
                                    <div class="card bg-transparent col-12" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid green;" >
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col" style="position: relative; top: 15px;">
                                                            <h5>Mon bilan <?= $bilans['date_a'] ?></h5>
                                                        </div>
                                                        <div class="col text-right" style="position: relative; top: 15px;">
                                                            <div class="row">
                                                                <div class="col <?php if($entreprise['statut_dette'] == "no"){echo "none-validation";} ?>">
                                                                    <a href="../../../src/bilan/<?= $bilans['files_bilan'] ?>" target='_blank' style="display: inline;"><i class='bx bx-show-alt icon_action'></i></a>&nbsp&nbsp&nbsp<a href="../../../src/bilan/<?= $bilans['files_bilan'] ?>" download style="display: inline;"><i class='bx bxs-download icon_action'></i></a>
                                                                </div>
                                                                <div class="col <?php if($entreprise['statut_dette'] == "yes"){echo "none-validation";} ?>">
                                                                    <p>Pix ne vous autorise pas télécharger votre bilan, régularisez vous auprès de votre cabinet comptable.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;  ?>
                            </div>
                        </div>
                        <div class="col">
                            <img src="../../../src/img/bilan-bg.jpg" alt="error img">
                        </div>
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

    <script>
        function select_annee() {
            let x = document.getElementById("select_annee").value;
            document.location.href="bilan.php?5PAx4zf27P="+x+"&S3q4EvFDk4QZ95b4v3gz"; 
        }
    </script>

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>
