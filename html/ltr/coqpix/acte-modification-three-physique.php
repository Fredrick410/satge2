<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

    $pdoSta = $bdd->prepare('SELECT * FROM acte WHERE code=:code');
    $pdoSta->bindValue(':code',$_GET['num']);
    $pdoSta->execute();
    $acte = $pdoSta->fetch();

    $pdoSta = $bdd->prepare('SELECT * FROM acte_doc WHERE code=:code');
    $pdoSta->bindValue(':code',$_GET['num']);
    $pdoSta->execute();
    $acte_doc = $pdoSta->fetch();

    //line code pour faire apparaitre les documents necessaire pour modification

    if($acte['one'] == "on"){$one = ""; $one_stat = "1";;}else{$one = "none-validation"; $one_stat = "0";}if($acte['two'] == "on"){$two = ""; $two_stat = "1";}else{$two = "none-validation"; $two_stat = "0";}if($acte['three'] == "on"){$three = ""; $three_stat = "1";}else{$three = "none-validation"; $three_stat = "0";}if($acte['four'] == "on"){$four = ""; $four_stat = "1";}else{$four = "none-validation"; $four_stat = "0";}if($acte['five'] == "on"){$five = ""; $five_stat = "1";}else{$five = "none-validation"; $five_stat = "0";}if($acte['six'] == "on"){$six = ""; $six_stat = "1";}else{$six = "none-validation"; $six_stat = "0";}if($acte['seven'] == "on"){$seven = ""; $seven_stat = "1";}else{$seven = "none-validation"; $seven_stat = "0";}
    $total_stat = ''.$one_stat.';'.$two_stat.';'.$three_stat.';'.$four_stat.';'.$five_stat.';'.$six_stat.';'.$seven_stat.'';

    //algo pourcentages

    if($acte_doc['doc_age'] !== "off"){
        $need_age = "1";
    }else{
        $need_age = "0";
    }

    if($acte_doc['doc_edit'] !== "off"){
        $need_edit = "1";
    }else{
        $need_edit = "0";
    }

    if($acte_doc['doc_acte'] !== "off"){
        $need_acte = "1";
    }else{
        $need_acte = "0";
    }

    if($acte_doc['doc_MBE'] !== "off"){
        $need_MBE = "1";
    }else{
        $need_MBE = "0";
    }

    if($acte_doc['doc_M3'] !== "off"){
        $need_M3 = "1";
    }else{
        $need_M3 = "0";
    }

    if($acte_doc['doc_jal'] !== "off"){
        $need_jal = "1";
    }else{
        $need_jal = "0";
    }

    if($acte_doc['doc_attestation'] !== "off"){
        $need_attestation = "1";
    }else{
        $need_attestation = "0";
    }

    if($acte_doc['doc_pieceid'] !== "off"){
        $need_pieceid = "1";
    }else{
        $need_pieceid = "0";
    }

    if($acte_doc['doc_justificatif'] !== "off"){
        $need_justificatif = "1";
    }else{
        $need_justificatif = "0";
    }

    if($acte_doc['doc_cerfaM2'] !== "off"){
        $need_cerfaM2 = "1";
    }else{
        $need_cerfaM2 = "0";
    }

    if($acte_doc['doc_tns'] !== "off"){
        $need_tns = "1";
    }else{
        $need_tns = "0";
    }

    if($acte_doc['doc_rcsas'] !== "off"){
        $need_rcsas = "1";
    }else{
        $need_rcsas = "0";
    }

    if($acte_doc['doc_cerfaAC'] !== "off"){
        $need_cerfaAC = "1";
    }else{
        $need_cerfaAC = "0";
    }

    $pourc_acte = $need_age + $need_edit + $need_acte + $need_MBE + $need_M3 + $need_jal + $need_attestation + $need_pieceid + $need_justificatif + $need_cerfaM2 + $need_tns + $need_rcsas + $need_cerfaAC;

    $pourc_uniq = 100/$pourc_acte;
    $pourc_final = "0";

    if($need_age == "1"){
        if($acte_doc['doc_age'] !== "on" && $acte_doc['doc_age'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_edit == "1"){
        if($acte_doc['doc_edit'] !== "on" && $acte_doc['doc_edit'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_acte == "1"){
        if($acte_doc['doc_acte'] !== "on" && $acte_doc['doc_acte'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_MBE == "1"){
        if($acte_doc['doc_MBE'] !== "on" && $acte_doc['doc_MBE'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_M3 == "1"){
        if($acte_doc['doc_M3'] !== "on" && $acte_doc['doc_M3'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_jal == "1"){
        if($acte_doc['doc_jal'] !== "on" && $acte_doc['doc_jal'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_attestation == "1"){
        if($acte_doc['doc_attestation'] !== "on" && $acte_doc['doc_attestation'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_pieceid == "1"){
        if($acte_doc['doc_pieceid'] !== "on" && $acte_doc['doc_pieceid'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_justificatif == "1"){
        if($acte_doc['doc_justificatif'] !== "on" && $acte_doc['doc_justificatif'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_cerfaM2 == "1"){
        if($acte_doc['doc_cerfaM2'] !== "on" && $acte_doc['doc_cerfaM2'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_tns == "1"){
        if($acte_doc['doc_tns'] !== "on" && $acte_doc['doc_tns'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_rcsas == "1"){
        if($acte_doc['doc_rcsas'] !== "on" && $acte_doc['doc_rcsas'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }

    if($need_cerfaAC == "1"){
        if($acte_doc['doc_cerfaAC'] !== "on" && $acte_doc['doc_cerfaAC'] !== ""){
            $pourc_final = $pourc_final + $pourc_uniq;
        }
    }


    



    //algo colors

    if($acte_doc['doc_age'] == "on" || $acte_doc['doc_age'] == "off" || $acte_doc['doc_age'] == ""){
        $color_age = "red";
    }else{
        $color_age = "green";
    }

    if($acte_doc['doc_acte'] == "on" || $acte_doc['doc_acte'] == "off" || $acte_doc['doc_acte'] == ""){
        $color_acte = "red";
    }else{
        $color_acte = "green";
    }

    if($acte_doc['doc_edit'] == "on" || $acte_doc['doc_edit'] == "off" || $acte_doc['doc_edit'] == ""){
        $color_edit = "red";
    }else{
        $color_edit = "green";
    }

    if($acte_doc['doc_MBE'] == "on" || $acte_doc['doc_MBE'] == "off" || $acte_doc['doc_MBE'] == ""){
        $color_MBE = "red";
    }else{
        $color_MBE = "green";
    }

    if($acte_doc['doc_jal'] == "on" || $acte_doc['doc_jal'] == "off" || $acte_doc['doc_jal'] == ""){
        $color_jal = "red";
    }else{
        $color_jal = "green";
    }

    if($acte_doc['doc_attestation'] == "on" || $acte_doc['doc_attestation'] == "off" || $acte_doc['doc_attestation'] == ""){
        $color_attestation = "red";
    }else{
        $color_attestation = "green";
    }

    if($acte_doc['doc_pieceid'] == "on" || $acte_doc['doc_pieceid'] == "off" || $acte_doc['doc_pieceid'] == ""){
        $color_pieceid = "red";
    }else{
        $color_pieceid = "green";
    }

    if($acte_doc['doc_justificatif'] == "on" || $acte_doc['doc_justificatif'] == "off" || $acte_doc['doc_justificatif'] == ""){
        $color_justificatif = "red";
    }else{
        $color_justificatif = "green";
    }

    if($acte_doc['doc_cerfaM2'] == "on" || $acte_doc['doc_cerfaM2'] == "off" || $acte_doc['doc_cerfaM2'] == ""){
        $color_M2 = "red";
    }else{
        $color_M2 = "green";
    }

    if($acte_doc['doc_tns'] == "on" || $acte_doc['doc_tns'] == "off" || $acte_doc['doc_tns'] == ""){
        $color_tns = "red";
    }else{
        $color_tns = "green";
    }

    if($acte_doc['doc_rcsas'] == "on" || $acte_doc['doc_rcsas'] == "off" || $acte_doc['doc_rcsas'] == ""){
        $color_rcsas = "red";
    }else{
        $color_rcsas = "green";
    }

    if($acte_doc['doc_cerfaAC'] == "on" || $acte_doc['doc_cerfaAC'] == "off" || $acte_doc['doc_cerfaAC'] == ""){
        $color_cerfaAC = "red";
    }else{
        $color_cerfaAC = "green";
    }

    if($acte_doc['doc_M3'] == "on" || $acte_doc['doc_M3'] == "off" || $acte_doc['doc_M3'] == ""){
        $color_M3 = "red";
    }else{
        $color_M3 = "green";
    }

    $pdo = $bdd->prepare('UPDATE acte SET progression=:progression WHERE code=:code'); 
    $pdo->bindValue(':progression', $pourc_final);
    $pdo->bindValue(':code', $_GET['num']); 
    $pdo->execute();
    

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
    <title>Acte - Etape 3</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .none-validation{display: none;};
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-info navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_backend.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="form-group">
                    <h4>Etape 3 : Déposez les documents</h4>
                    <span class="<?= $one ?>">- Session Parts / Actions <br></span>
                    <span class="<?= $two ?>">- Changement Gérant / Président <br></span>
                    <span class="<?= $three ?>">- Changement siège social <br></span>
                    <span class="<?= $four ?>">- Changement objet social <br></span>
                    <span class="<?= $five ?>">- Changement forme juridique <br></span>
                    <span class="<?= $six ?>">- Changement dénomination <br></span>
                    <span class="<?= $seven ?>">- Changement capital social</span>
                </div>
                <div class="form-group">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="progress progress-bar-info mb-2 ">
                                <div class="progress-bar progress-label" role="progressbar" aria-valuenow="<?= $pourc_final ?>" aria-valuemin="<?= $pourc_final ?>" aria-valuemax="100" style="width:<?= substr($pourc_final, 0, 5) ?>%"></div>
                            </div>
                            <small>PS : Les changement concernant l'avancement de la barre de progression, s'applique lors de l'enregistrement ! 💜</small>
                        </div>
                    </div>
                <div> 
                <div class="form-group">
                    <hr>
                </div>  
                <div class="form-group <?= $one ?>">
                    <div class="form-group">
                        <h6>Document pour Session Parts / Actions :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">Age de session &nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_acte ?>;">Acte de session &nbsp&nbsp<a class="<?php if($acte_doc['doc_acte'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_acte'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span class="<?php if($_GET['verif_one'] == "off"){echo "none-validation";} ?>" style="color: <?= $color_M2 ?>;">CerfaM2 &nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_MBE ?>;">CerfaMBE &nbsp&nbsp<a class="<?php if($acte_doc['doc_MBE'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_MBE'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés &nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div> 
                <div class="form-group <?= $two ?>">
                    <div class="form-group">
                        <h6>Document pour changement Gérant / Président :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">Age Nomination Président&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M3 ?>;">CerfaMBE&nbsp&nbsp<a class="<?php if($acte_doc['doc_M3'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_M3'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_attestation ?>;">Attestation de non condamnation&nbsp&nbsp<a class="<?php if($acte_doc['doc_attestation'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_attestation'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_pieceid ?>;"> Piece id nouveau gérant / Président &nbsp&nbsp<a class="<?php if($acte_doc['doc_pieceid'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_pieceid'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $three ?>">
                    <div class="form-group">
                        <h6>Document pour Changement siège social :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">Age de domiciliation&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;">CerfaM2&nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_justificatif ?>;">Justificatif de domiciliation &nbsp&nbsp<a class="<?php if($acte_doc['doc_justificatif'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_justificatif'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $four ?>">
                    <div class="form-group">
                        <h6>Document pour changement objet social :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">Age d'objet social&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;">CerfaM2&nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                    </div>
                </div>
                <div class="form-group <?= $five ?>">
                    <div class="form-group">
                        <h6>Document pour changement forme juridique :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">Age forme juridique&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;"> CerfaM2&nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_tns ?>;">Formulaire TNS&nbsp&nbsp<a class="<?php if($acte_doc['doc_tns'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_tns'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_rcsas ?>;">Rapport commissaire &nbsp&nbsp<a class="<?php if($acte_doc['doc_rcsas'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_rcsas'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $six ?>">
                    <div class="form-group">
                        <h6>Document pour changement domination :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">Age de dénomination&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;">CerfaM2 &nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $seven ?>">
                    <div class="form-group">
                        <h6>Document pour augmentation du capital social :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">Age du capital social&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_cerfaAC ?>;">Certification d'augmentation de capital &nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaAC'] !== "on"){}else{echo "none-validation";} ?>" href="../../../src/acte/<?= $acte_doc['doc_cerfaAC'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div> 
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <h5>Téléchargement des documents :</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 <?php if($acte_doc['doc_age'] == "off" || $acte_doc['doc_age'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>AGE</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_age&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_age'] !== "on"){echo $acte_doc['doc_age'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_age'] == "on"){echo "none-validation";} ?>">Document déja deposé 💙!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_edit'] == "off" || $acte_doc['doc_edit'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Statuts modifiés</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_edit&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                                   
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_edit'] !== "on"){echo $acte_doc['doc_edit'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_edit'] == "on"){echo "none-validation";} ?>">Document déja deposé 💚!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_acte'] == "off" || $acte_doc['doc_acte'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Acte de session</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_acte&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                                   
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_acte'] !== "on"){echo $acte_doc['doc_acte'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_acte'] == "on"){echo "none-validation";} ?>">Document déja deposé 💛!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_MBE'] == "off" || $acte_doc['doc_MBE'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>CerfaMBE</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_MBE&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                             
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_MBE'] !== "on"){echo $acte_doc['doc_MBE'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_MBE'] == "on"){echo "none-validation";} ?>">Document déja deposé 🧡!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_M3'] == "off" || $acte_doc['doc_M3'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>CerfaM3</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_M3&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                         
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_M3'] !== "on"){echo $acte_doc['doc_M3'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_M3'] == "on"){echo "none-validation";} ?>">Document déja deposé 💜!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_jal'] == "off" || $acte_doc['doc_jal'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Publication JAL</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_jal&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">   
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_jal'] !== "on"){echo $acte_doc['doc_jal'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_jal'] == "on"){echo "none-validation";} ?>">Document déja deposé 🤎!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_attestation'] == "off" || $acte_doc['doc_attestation'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Attestation de non condamnation</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_attestation&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                  
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_attestation'] !== "on"){echo $acte_doc['doc_attestation'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_attestation'] == "on"){echo "none-validation";} ?>">Document déja deposé 🖤!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_pieceid'] == "off" || $acte_doc['doc_pieceid'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Piece identitée (Nouveau gérant)</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_pieceid&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                            
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_pieceid'] !== "on"){echo $acte_doc['doc_pieceid'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_pieceid'] == "on"){echo "none-validation";} ?>">Document déja deposé 💙!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($_GET['verif_one'] == "off"){echo "none-validation";} ?> <?php if($acte_doc['doc_cerfaM2'] == "off" || $acte_doc['doc_cerfaM2'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>CerfaM2</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_cerfaM2&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                             
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_cerfaM2'] !== "on"){echo $acte_doc['doc_cerfaM2'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_CerfaM2'] == "on"){echo "none-validation";} ?>">Document déja deposé 🤍!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_tns'] == "off" || $acte_doc['doc_tns'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Formulaire TNS</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_tns&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                           
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_tns'] !== "on"){echo $acte_doc['doc_tns'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_tns'] == "on"){echo "none-validation";} ?>">Document déja deposé 💚!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_rcsas'] == "off" || $acte_doc['doc_rcsas'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Rapport commissaire</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_rcsas&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                        
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_rcsas'] !== "on"){echo $acte_doc['doc_rcsas'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_rcsas'] == "on"){echo "none-validation";} ?>">Document déja deposé 💛!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_cerfaAC'] == "off" || $acte_doc['doc_cerfaAC'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Certification augmentation capital</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_cerfaAC&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                  
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_cerfaAC'] !== "on"){echo $acte_doc['doc_cerfaAC'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_cerfaAC'] == "on"){echo "none-validation";} ?>">Document déja deposé 🧡!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_justificatif'] == "off" || $acte_doc['doc_justificatif'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Justificatif de domiciliation</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_justificatif&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">          
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_justificatif'] !== "on"){echo $acte_doc['doc_justificatif'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_justificatif'] == "on"){echo "none-validation";} ?>">Document déja deposé 🤎!</small>
                            </div>
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
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/modal/components-modal.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>

</body>
<!-- END: Body-->

</html>