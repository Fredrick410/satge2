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

    //chang paiement et depot

    if(isset($_POST['num_acte'])){
        $frais_av = explode('!',$acte['frais']);
        $honoraire_av = explode('!', $acte['honoraire']);
        $frais = ''.$_POST['frais'].'!'.$frais_av[1].'';
        $honoraire = ''.$_POST['honoraire'].'!'.$honoraire_av[1].'';

        $sql = $bdd->prepare('UPDATE acte SET frais=:frais, honoraire=:honoraire WHERE code=:num LIMIT 1');
        $sql->bindValue(':frais', $frais);
        $sql->bindValue(':honoraire', $honoraire);
        $sql->bindValue(':num', $_GET['num']);
        $sql->execute();

        header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$_GET['verif_one'].'');
        exit();
    }

    //depo greffe etc

    if(isset($_POST['depo_greffe'])){

        $depo_greffe = ''.$_POST['depo_greffe'].'!yes';

        $sql = $bdd->prepare('UPDATE acte SET depo_greffe=:depo_greffe WHERE code=:num LIMIT 1');
        $sql->bindValue(':depo_greffe', $depo_greffe);
        $sql->bindValue(':num', $_GET['num']);
        $sql->execute();

        header('Location: ');
        exit();
    }

    if(isset($_POST['depo_cfe'])){

        $depo_cfe = ''.$_POST['depo_cfe'].'!yes';

        $sql = $bdd->prepare('UPDATE acte SET depo_cfe=:depo_cfe WHERE code=:num LIMIT 1');
        $sql->bindValue(':depo_cfe', $depo_cfe);
        $sql->bindValue(':num', $_GET['num']);
        $sql->execute();

        header('Location: ');
        exit();
    }

    $datee = substr($acte['depo_cfe'], 0, 10);
    $dateee = substr($acte['depo_greffe'], 0, 10);

    //line code pour faire apparaitre les documents necessaire pour modification

    if($acte['one'] == "on"){$one = ""; $one_stat = "1";;}else{$one = "none-validation"; $one_stat = "0";}if($acte['two'] == "on"){$two = ""; $two_stat = "1";}else{$two = "none-validation"; $two_stat = "0";}if($acte['three'] == "on"){$three = ""; $three_stat = "1";}else{$three = "none-validation"; $three_stat = "0";}if($acte['four'] == "on"){$four = ""; $four_stat = "1";}else{$four = "none-validation"; $four_stat = "0";}if($acte['five'] == "on"){$five = ""; $five_stat = "1";}else{$five = "none-validation"; $five_stat = "0";}if($acte['six'] == "on"){$six = ""; $six_stat = "1";}else{$six = "none-validation"; $six_stat = "0";}if($acte['seven'] == "on"){$seven = ""; $seven_stat = "1";}else{$seven = "none-validation"; $seven_stat = "0";}if($acte['eight'] == "on"){$eight = ""; $eight_stat = "1";}else{$eight = "none-validation"; $eight_stat = "0";}
    $total_stat = ''.$one_stat.';'.$two_stat.';'.$three_stat.';'.$four_stat.';'.$five_stat.';'.$six_stat.';'.$seven_stat.';'.$eight_stat.'';

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

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
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

    <!--BEGIN: Main Menu-->
    <?php include('php/menu_backend.php'); ?>
    <!--END: Main Menu -->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="form-group">
                    <h4>Etape 3 : Déposez les documents</h4>
                    <span class="<?= $one ?>">- Cession Parts / Actions <br></span>
                    <span class="<?= $two ?>">- Changement Gérant / Président <br></span>
                    <span class="<?= $three ?>">- Changement siège social <br></span>
                    <span class="<?= $four ?>">- Changement objet social <br></span>
                    <span class="<?= $five ?>">- Changement forme juridique <br></span>
                    <span class="<?= $six ?>">- Changement dénomination <br></span>
                    <span class="<?= $seven ?>">- Changement capital social</span>
                    <span class="<?= $eight ?>">- Veille</span>
                </div>
                <div class="form-group">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="progress progress-bar-info mb-2 ">
                                <div class="progress-bar progress-label" role="progressbar" aria-valuenow="<?= $pourc_final ?>" aria-valuemin="<?= $pourc_final ?>" aria-valuemax="100" style="width:<?= substr($pourc_final, 0, 5) ?>%"></div>
                            </div>
                            <small>PS : Les changements concernant l'avancement de la barre de progression, s'appliquent lors de l'enregistrement ! 💜</small>
                        </div>
                    </div>
                <div> 
                <div class="form-group">
                    <hr>
                </div>  
                <div class="form-group <?= $one ?>">
                    <div class="form-group">
                        <h6>Document pour Cession Parts / Actions :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">A.G.E de cession &nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_acte ?>;">Acte de cession &nbsp&nbsp<a class="<?php if($acte_doc['doc_acte'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_acte'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span class="<?php if($_GET['verif_one'] == "off"){echo "none-validation";} ?>" style="color: <?= $color_M2 ?>;">Cerfa M2 &nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_MBE ?>;">Cerfa MBE &nbsp&nbsp<a class="<?php if($acte_doc['doc_MBE'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_MBE'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés &nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div> 
                <div class="form-group <?= $two ?>">
                    <div class="form-group">
                        <h6>Document pour changement Gérant / Président :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">A.G.E Nomination Président&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M3 ?>;">Cerfa MBE&nbsp&nbsp<a class="<?php if($acte_doc['doc_M3'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_M3'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_attestation ?>;">Attestation de non condamnation&nbsp&nbsp<a class="<?php if($acte_doc['doc_attestation'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_attestation'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_pieceid ?>;"> Piece ID nouveau gérant / Président &nbsp&nbsp<a class="<?php if($acte_doc['doc_pieceid'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_pieceid'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $three ?>">
                    <div class="form-group">
                        <h6>Document pour Changement siège social :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">A.G.E de domiciliation&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;">Cerfa M2&nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_justificatif ?>;">Justificatif de domiciliation &nbsp&nbsp<a class="<?php if($acte_doc['doc_justificatif'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_justificatif'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $four ?>">
                    <div class="form-group">
                        <h6>Document pour changement objet social :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">A.G.E d'objet social&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;">Cerfa M2&nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                    </div>
                </div>
                <div class="form-group <?= $five ?>">
                    <div class="form-group">
                        <h6>Document pour changement forme juridique :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">A.G.E forme juridique&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;"> Cerfa M2&nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_tns ?>;">Formulaire TNS&nbsp&nbsp<a class="<?php if($acte_doc['doc_tns'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_tns'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_rcsas ?>;">Rapport commissaire &nbsp&nbsp<a class="<?php if($acte_doc['doc_rcsas'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_rcsas'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $six ?>">
                    <div class="form-group">
                        <h6>Document pour changement domination :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">A.G.E de dénomination&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;">Cerfa M2 &nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div>
                </div>
                <div class="form-group <?= $seven ?>">
                    <div class="form-group">
                        <h6>Document pour augmentation du capital social :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_age ?>;">A.G.E du capital social&nbsp&nbsp<a class="<?php if($acte_doc['doc_age'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_age'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_edit ?>;">Statuts modifiés&nbsp&nbsp<a class="<?php if($acte_doc['doc_edit'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_edit'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_jal ?>;">Publication JAL&nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_cerfaAC ?>;">Certification d'augmentation de capital &nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaAC'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_cerfaAC'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a></span>
                    </div> 
                </div>
                <div class="form-group <?= $eight ?>">
                    <div class="form-group">
                        <h6>Document Veille :</h6>
                    </div>
                    <div class="form-group">
                        <span style="color: <?= $color_jal ?>;">Publication JAL &nbsp&nbsp<a class="<?php if($acte_doc['doc_jal'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_jal'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
                        <span style="color: <?= $color_M2 ?>;">Cerfa M2 &nbsp&nbsp<a class="<?php if($acte_doc['doc_cerfaM2'] !== "on"){}else{echo "none-validation";} ?>" target="_blank" href="../../../src/acte/<?= $acte_doc['doc_cerfaM2'] ?>"><i class='bx bx-show-alt' style="cursor: pointer; color: black;"></i></a><br></span>
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
                                <label>A.G.E</label>
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
                                <label>Acte de cession</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_acte&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                                   
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_acte'] !== "on"){echo $acte_doc['doc_acte'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_acte'] == "on"){echo "none-validation";} ?>">Document déja deposé 💛!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_MBE'] == "off" || $acte_doc['doc_MBE'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Cerfa MBE</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_MBE&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                             
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_MBE'] !== "on"){echo $acte_doc['doc_MBE'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_MBE'] == "on"){echo "none-validation";} ?>">Document déja deposé 🧡!</small>
                            </div>
                        </div>
                        <div class="col-sm-3 <?php if($acte_doc['doc_M3'] == "off" || $acte_doc['doc_M3'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Cerfa M3</label>
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
                        <div class="col-sm-3 <?php if($_GET['verif_one'] == "off" && $one == ""){echo "none-validation";} ?> <?php if($acte_doc['doc_cerfaM2'] == "off" || $acte_doc['doc_cerfaM2'] == ""){echo "none-validation";} ?>">
                            <div class="form-group">
                                <label>Cerfa M2</label>
                                <a style="cursor: pointer;" href="acte-modification-three-upload.php?document=doc_cerfaM2&num=<?= $_GET['num'] ?>&verif_one=<?= $_GET['verif_one'] ?>"><div class="custom-file">                             
                                    <label class="custom-file-label" for="inputGroupFile01"><?php if($acte_doc['doc_cerfaM2'] !== "on"){echo $acte_doc['doc_cerfaM2'];}else{echo "Choisir le fichier";} ?></label>
                                </div></a>
                                <small class="<?php if($acte_doc['doc_cerfaM2'] == "on"){echo "none-validation";} ?>">Document déja deposé 🤍!</small>
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
                <div class="form-group">
                    <hr>
                </div>
                <div class="<?php if($pourc_final >= 100){}else{echo "none-validation";} ?>">
                <!-- Simple Validation start -->
                    <section class="simple-validation">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h4 class="card-title">Paiement & Dépot</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col" style="border-right: 1px solid #A3AFBD;">
                                                    <form action="" class="form-horizontal" method="POST">
                                                        <input type="hidden" name="num_acte" id="num_crea" value="<?= $_GET['num'] ?>">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col">
                                                                <?php $value_frais = explode('!',$acte['frais']); ?>
                                                                <label for="valid-state">Frais</label>
                                                                    <input type="number" min="0" name="frais" class="form-control <?php if($acte['frais'] == "" || $value_frais[1] == "no"){echo "is-invalid";}else{echo "is-valid";} ?>" id="valid-state" placeholder="Frais en €" value="<?php $value_frais = explode('!',$acte['frais']); echo $value_frais[0]; ?>" required>
                                                                    <div class="valid-feedback">
                                                                        <i class="bx bx-radio-circle"></i>
                                                                    Frais de paiement enregisté <?= $value_frais[0]; ?> € 
                                                                    </div>
                                                                </div>
                                                                <div class="col col-lg-2">
                                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center" style="position: relative; top: 20%;">
                                                                        <p class="mb-0">Payé</p>
                                                                        <input onchange="paiement_frais_check()" name="frais_check" type="checkbox" class="custom-control-input" id="customSwitch1" <?php if(substr($acte['frais'], -3) == "yes"){echo "checked";} ?>>
                                                                        <label class="custom-control-label" for="customSwitch1">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col">
                                                                <?php $value_honoraire = explode('!',$acte['honoraire']);  ?>
                                                                <label for="valid-state">Honoraire</label>
                                                                    <input type="number" min="0" name="honoraire" class="form-control <?php if($acte['honoraire'] == "" || $value_honoraire[1] == "no"){echo "is-invalid";}else{echo "is-valid";} ?>" id="valid-state" placeholder="Honoraire en €" value="<?php $value_honoraire = explode('!',$acte['honoraire']); echo $value_honoraire[0]; ?>" required>
                                                                    <div class="valid-feedback">
                                                                        <i class="bx bx-radio-circle"></i>
                                                                    Honoraire de paiement enregisté <?= $value_honoraire[0]; ?> € 
                                                                    </div>
                                                                </div>
                                                                <div class="col col-lg-2">
                                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center" style="position: relative; top: 20%;">
                                                                        <p class="mb-0">Payé</p>
                                                                        <input onchange="paiement_honoraire_check()" name="honoraire_check"  type="checkbox" class="custom-control-input" id="customSwitch11" <?php if(substr($acte['honoraire'], -3) == "yes"){echo "checked";} ?>>
                                                                        <label class="custom-control-label" for="customSwitch11">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-outline-<?php if($acte['frais'] == "" || $acte['honoraire']){echo "secondary";}else{echo "success";} ?> col-12"><i class="bx bx-check"></i><span class="align-middle ml-25"><?php if($acte['frais'] == "" && $acte['honoraire'] == ""){echo "Enregister les montants";}else{echo "Modifier les montants";} ?></span></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <div class="form-group text-center">
                                                            <span>Greffe & CFE</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <hr>
                                                        </div>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="num_creation" value="<?= $_GET['num'] ?>">
                                                            <div class="d-flex align-items-center">
                                                                <small class="text-muted mr-75 <?php if($acte['depo_greffe'] !== ""){echo "none-validation";} ?>">
                                                                    Dépot au Greffe : 
                                                                </small>
                                                                <small class="text-muted mr-75 <?php if($acte['depo_greffe'] == ""){echo "none-validation";} ?>">
                                                                    Dépot au greffe le <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($dateee)); ?>
                                                                </small>
                                                                <fieldset class="d-flex justify-content-end">
                                                                    <input name="depo_greffe" type="date" class="form-control mb-50 mb-sm-0 <?php if($acte['depo_greffe'] !== ""){echo "none-validation";} ?>" placeholder="jj-mm-aa" style="margin: 5px; position: relative;">
                                                                    <button type="submit" class="btn btn-icon btn-light-success <?php if($acte['depo_greffe'] !== ""){echo "none-validation";} ?>" style="position: relative; top: 3px;"><i class="bx bx-like"></i></button>

                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center <?php if($acte['depo_greffe'] == ""){echo "none-validation";} ?>" style="position: relative; top: 20%;">
                                                                        <p class="mb-0">Déposé</p>
                                                                        <input onchange="greffe_depo()" name="greffe_check"  type="checkbox" class="custom-control-input" id="customSwitch98" checked>
                                                                        <label class="custom-control-label" for="customSwitch98">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </form>
                                                        <div class="form-group">
                                                            <br>
                                                        </div>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="num_creation" value="<?= $_GET['num'] ?>">
                                                            <div class="d-flex align-items-center">
                                                                <small class="text-muted mr-75 <?php if($acte['depo_cfe'] !== ""){echo "none-validation";} ?>">
                                                                    Dépot au CFE : 
                                                                </small>
                                                                <small class="text-muted mr-75 <?php if($acte['depo_cfe'] == ""){echo "none-validation";} ?>">
                                                                    Dépot au CFE le <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($datee)); ?>
                                                                </small>
                                                                <fieldset class="d-flex justify-content-end">
                                                                    <input name="depo_cfe" type="date" class="form-control mb-50 mb-sm-0 <?php if($acte['depo_cfe'] !== ""){echo "none-validation";} ?>" placeholder="jj-mm-aa" style="margin: 5px; position: relative;">
                                                                    <button type="submit" class="btn btn-icon btn-light-success <?php if($acte['depo_cfe'] !== ""){echo "none-validation";} ?>" style="position: relative; top: 3px;"><i class="bx bx-like"></i></button>

                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center <?php if($acte['depo_cfe'] == ""){echo "none-validation";} ?>" style="position: relative; top: 20%;">
                                                                        <p class="mb-0">Déposé</p>
                                                                        <input onchange="cfe()" name="cfe_check"  type="checkbox" class="custom-control-input" id="customSwitch99" checked>
                                                                        <label class="custom-control-label" for="customSwitch99">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </fieldset>

                                                                <fieldset class="d-flex justify-content-end">
                                                                    <div class="custom-control custom-switch custom-switch-info mr-2 mb-1 text-center <?php if(substr($acte['depo_cfe'], -3) !== "yes"){echo "none-validation";} ?>" style="position: relative; top: 20%;">
                                                                        <label>Article 3</label><br>
                                                                        <input onchange="article_three()" type="checkbox" class="custom-control-input" id="customSwitch32" <?php if($acte['article_three'] == "yes"){echo "checked";} ?>>
                                                                        <label class="custom-control-label" for="customSwitch32">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </form>  
                                                    </div>               
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Input Validation end -->     
                </div> 
                <div class="form-group <?php if($pourc_final >= 100){}else{echo "none-validation";} ?>">
                    <div class="form-group">
                        <hr>
                    </div>
                    <div class="form-group">
                        <small>(SOON) Télécharger le dossier complet sous format .zip</small>&nbsp&nbsp&nbsp&nbsp
                        <button styLe="position: relative; top: 6px;" class="btn btn-icon btn-light-info mr-1 mb-1" type="button">
                            <i class="bx bx-download"></i>
                        </button>
                    </div>
                </div>           
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        function paiement_frais_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_frais_acte.php?num=<?= $_GET['num'] ?>&result=<?= $acte['frais'] ?>');
            requeteAjax.send(notification_crea);
        }
        function paiement_honoraire_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_honoraire_acte.php?num=<?= $_GET['num'] ?>&result=<?= $acte['honoraire'] ?>');
            requeteAjax.send(notification_crea);
        }

        function greffe_depo(){
            document.location.href="php/change_depo_acte.php?num=<?= $_GET['num'] ?>&style=greffe&forme=morale&verif_one=<?= $_GET['verif_one'] ?>"; 
        }

        function cfe(){
            document.location.href="php/change_depo_acte.php?num=<?= $_GET['num'] ?>&style=cfe&forme=morale&verif_one=<?= $_GET['verif_one'] ?>"; 
        }

        function article_three(){
            document.location.href="php/change_depo_acte.php?num=<?= $_GET['num'] ?>&style=article&forme=morale&verif_one=<?= $_GET['verif_one'] ?>"; 
        }

    </script>

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