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

    $pdoStat = $bdd->prepare('SELECT * FROM attestation_fiscale WHERE id_session = :num ORDER BY id DESC');
    $pdoStat->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $attestation = $pdoStat->fetchAll();
    $count_attestation = count($attestation);

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
    <title>Mon espace - Fiscal</title>
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

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">
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
    <?php $btnreturn = true;
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
                    <h4>Attestation fiscale</h4>
                    <br>
                </div>
                <div class="form-group <?php if(empty($_GET['h6W83pUU2b'])){echo "none-validation";} ?>">

                    <div class="alert border-success alert-dismissible mb-2 col-6 <?php if($_GET['h6W83pUU2b'] !== "L6jH744fmT"){echo "none-validation";} ?>" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="d-flex align-items-center">
                            <i class="bx bx-like"></i>
                            <span>
                                Votre demande a bien était prit en compte !
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group text-center">
                    <h6>Faire une demande d'attestation fiscale</h6>
                    <i onclick="bt_plus()" id="bt_plus" class='bx bxs-plus-square icon_plus'></i>
                    <i onclick="bt_minius()" id="bt_minius" class='bx bxs-minus-square icon_minius none-validation'></i>
                </div>
                <div id="div_add" class="none-validation">
                    <form action="php/insert_attestation.php?type=fiscal" method="POST">
                        <input type="hidden" name="num" value="<?= $entreprise['id'] ?>">
                        <input type="hidden" name="name_entreprise" value="<?= $entreprise['nameentreprise'] ?>">
                        <div class="form-group text-center">
                            <p>Demander une attestation fiscale à votre comptable, il traitera la demande le plus rapidement possible !</p>
                            <button class="btn btn-outline-success col-12" type="submit">Faire ma demande d'attestation</button>
                        </div>
                    </form>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <h5>Mes attestations</h5>
                </div>
                <div class="form-group <?php if($count_attestation > 0){echo "none-validation";} ?>">
                    <p>Aucune déclaration ...</p>
                </div>
                <div class="form-group <?php if($count_attestation > 0){}else{echo "none-validation";} ?>">
                    <?php foreach($attestation as $attestation_fiscales): ?>
                        <div class="card bg-transparent col-12" style="border-right: none; border-bottom: none; border-top: none; border-left: 5px solid <?php if($attestation_fiscales['statut_attestation'] == "En cours"){echo "orange";}elseif($attestation_fiscales['statut_attestation'] == "Terminée"){echo "#07ff84";} ?>;" >
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <h5>Mon attestation</h5>
                                                <p>Demander le <?= $attestation_fiscales['date_demande'] ?></p>
                                                <p class="<?php if($attestation_fiscales['statut_attestation'] == "En cours"){echo "none-validation";} ?>">Donner le <?= $attestation_fiscales['date_demande'] ?></p>
                                            </div>
                                            <div class="col text-right">
                                                <label>Statut de votre demande : </label>&nbsp<p style="display: inline; color: <?php if($attestation_fiscales['statut_attestation'] == "En cours"){echo "orange";}elseif($attestation_fiscales['statut_attestation'] == "Terminée"){echo "#07ff84";} ?>;"><?= $attestation_fiscales['statut_attestation'] ?></p>
                                                <div class="row <?php if($attestation_fiscales['statut_attestation'] == "En cours"){echo "none-validation";} ?>">
                                                    <div class="col">
                                                        <a href="../../../src/attestation_fiscale/<?= $attestation_fiscales['files_attestation'] ?>" target='_blank' style="display: inline;"><i class='bx bx-show-alt icon_action'></i></a>&nbsp&nbsp&nbsp<a href="../../../src/attestation_fiscale/<?= $attestation_fiscales['files_attestation'] ?>" download style="display: inline;"><i class='bx bxs-download icon_action'></i></a>
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
    
        function bt_plus(){
            document.getElementById('div_add').style.display = "block";
            document.getElementById('bt_minius').style.display = "block";
            document.getElementById('bt_plus').style.display = "none";
        }

        function bt_minius(){
            document.getElementById('div_add').style.display = "none";
            document.getElementById('bt_minius').style.display = "none";
            document.getElementById('bt_plus').style.display = "block";
        }

    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>
