<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'juriste');
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    //edit part

    if(isset($_POST['edit_form'])){

        $sql = $bdd->prepare('UPDATE crea_societe SET name_crea=:name_crea, email_crea=:email_crea, password_crea=:password_crea, date_crea=:date_crea, nom_diri=:nom_diri, prenom_diri=:prenom_diri, tel_diri=:tel_diri, email_diri=:email_diri, status_crea=:status_crea WHERE id=:num LIMIT 1');
        $sql->bindValue(':name_crea', $_POST['name_crea']);
        $sql->bindValue(':email_crea', $_POST['email_crea']);
        $sql->bindValue(':password_crea', $_POST['password_crea']);
        $sql->bindValue(':date_crea', $_POST['date_crea']);
        $sql->bindValue(':nom_diri', $_POST['nom_diri']);
        $sql->bindValue(':prenom_diri', $_POST['prenom_diri']);
        $sql->bindValue(':tel_diri', $_POST['tel_diri']);
        $sql->bindValue(':email_diri', $_POST['email_diri']);
        $sql->bindValue(':status_crea', $_POST['status_crea']);
        $sql->bindValue(':num', $_POST['num']);
        $sql->execute();

        header('Location: creation-view-physique.php?num='.$_POST['num'].'');
        exit();
    }

    if(isset($_POST['num'])){

        if(!empty($_POST['frais_check'])){
            if($_POST['frais_check'] == "on"){
                $frais = ''.$_POST['frais'].'!yes';
            }else{
                $frais = ''.$_POST['frais'].'!no';
            }
        }else{
            $frais = ''.$_POST['frais'].'!no';
        }

        if(!empty($_POST['honoraire_check'])){
            if($_POST['honoraire_check'] == "on"){
                $honoraire = ''.$_POST['honoraire'].'!yes';
            }else{
                $honoraire = ''.$_POST['honoraire'].'!no';
            }
        }else{
            $honoraire = ''.$_POST['honoraire'].'!no';
        }

        $sql = $bdd->prepare('UPDATE crea_societe SET frais=:frais, honoraire=:honoraire WHERE id=:num LIMIT 1');
        $sql->bindValue(':frais', $frais);
        $sql->bindValue(':honoraire', $honoraire);
        $sql->bindValue(':num', $_POST['num']);
        $sql->execute();

        header('Location: creation-view-physique.php?num='.$_POST['num'].'');
        exit();
    }

    if(isset($_POST['depo_greffe'])){

        $depo_greffe = ''.$_POST['depo_greffe'].'!yes';

        $sql = $bdd->prepare('UPDATE crea_societe SET depo_greffe=:depo_greffe WHERE id=:num LIMIT 1');
        $sql->bindValue(':depo_greffe', $depo_greffe);
        $sql->bindValue(':num', $_POST['num_creation']);
        $sql->execute();

        header('Location: creation-view-physique.php?num='.$_POST['num_creation'].'');
        exit();
    }

    if(isset($_POST['depo_cfe'])){

        $depo_cfe = ''.$_POST['depo_cfe'].'!yes';

        $sql = $bdd->prepare('UPDATE crea_societe SET depo_cfe=:depo_cfe WHERE id=:num LIMIT 1');
        $sql->bindValue(':depo_cfe', $depo_cfe);
        $sql->bindValue(':num', $_POST['num_creation']);
        $sql->execute();

        header('Location: creation-view-physique.php?num='.$_POST['num_creation'].'');
        exit();
    }

    $datee = substr($crea['depo_cfe'], 0, 10);
    $dateee = substr($crea['depo_greffe'], 0, 10);


?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix cr??e By audit action plus - d??velopp?? par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Cr??ation de soci??t??</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-email.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">
<style>

.nofavo{text-decoration: none; color : #c7cfd6;}
.nofavoh:hover{text-decoration: none; color : #ffcd02;}
.favo{text-decoration: none; color : #ffcd02;}
.favoh:hover{text-decoration: none; color : #c7cfd6;}
.line{text-decoration: underline;}
.sizeright{font-size: 12px;}
.nonedoc {display : none;}
.esp{color: #828D99; text-decoration: underline;}
.esp:hover{color: #34465b; text-decoration: underline;}
.bouge{
    overflow-y: auto;
    scrollbar-color: #e5e5e5 white;
    scrollbar-width: thin;
    border-radius: 10px;
    overflow-x:hidden;
}
.none-validation{display: none;}
    
</style>


    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-secondary navbar-brand-center">
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
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se d??connecter</a>
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
        <div class="content-area-wrapper">
            <div class="form-group">
                <style>
                    .backk{font-size: 30px; color: black;}
                    .backk:hover{color: #727E8C;}
                </style>
                <a href="creation-list.php"><i class='bx bx-arrow-back backk'></i></a>
            </div>
            <div class="sidebar-left">
                <div class="sidebar">
                    <!-- User new mail right area -->
                    <div class="compose-new-mail-sidebar">
                        <div class="card shadow-none quill-wrapper p-0">
                            <div class="card-header">
                                <h3 class="card-title" id="emailCompose"><?= $crea['name_crea'] ?></h3>
                                <button type="button" class="close close-icon">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <!-- form start -->
                            <form action="" method="POST">
                            <input type="hidden" value="<?= $_GET['num']; ?>" name="num">
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <div class="form-group">
                                            <label>Date d'ouverture du dossier</label>
                                            <input type="text" name="date_crea" class="form-control" value="<?= $crea['date_crea'] ?>" placeholder="Date de cr??ation" readonly>
                                        </div>
                                        <div class="form-group pb-50">
                                            <labelledby>Nom de la soci??t??</label>
                                            <input type="text" name="name_crea" class="form-control" value="<?= $crea['name_crea'] ?>" placeholder="Nom de la soci??t??" required>
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" name="email_crea" class="form-control" value="<?= $crea['email_crea'] ?>" placeholder="E-mail de la soci??t??" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Mot de passe (Mot de passe du compte)</label>
                                            <input type="password" name="password_crea" class="form-control" value="<?= $crea['password_crea'] ?>" placeholder="Mot de passe" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Information dirigeant</label>
                                            <input type="text" name="nom_diri" class="form-control" value="<?= $crea['nom_diri'] ?>" placeholder="Nom du dirigeant" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="prenom_diri" class="form-control" value="<?= $crea['prenom_diri'] ?>" placeholder="Prenom du dirigeant" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="tel_diri" class="form-control" value="<?= $crea['tel_diri'] ?>" placeholder="T??l??phone du dirigeant" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="email_diri" class="form-control" value="<?= $crea['email_diri'] ?>" placeholder="E-mail du dirigeant" required>
                                        </div>
                                        <div class="form-group">
                                        <label>Forme juridique :</label>
                                            <select name="status_crea" class="form-control">
                                                <option value="<?= $crea['status_crea'] ?>"><?= $crea['status_crea'] ?></option>
                                                <optgroup label="----------------------">
                                                </optgroup>
                                                <option value="EIRL">EIRL</option>
                                                <option value="EI">EI</option>
                                                <option value="MIcro-entreprise">Micro-entreprise</option>
                                            </select>
                                        </div>
                                        <!-- Compose mail Quill editor -->
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end pt-0">
                                    <button type="reset" class="btn btn-light-secondary cancel-btn mr-1">
                                        <i class='bx bx-x mr-25'></i>
                                        <span class="d-sm-inline d-none">Annuler</span>
                                    </button>
                                    <button type="submit" name="edit_form" class="btn-send btn btn-primary">
                                        <i class='bx bx-send mr-25'></i> <span class="d-sm-inline d-none">Enregister</span>
                                    </button>
                                </div>
                            </form>
                            <!-- form start end-->
                        </div>
                    </div>
                    <!--/ User Chat profile right area -->
                </div>
            </div>

                <div class="content-wrapper bouge" style="width:100%;">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- email app overlay -->
                        <div class="app-content-overlay"></div>
                        <div class="email-app-area">
                            <!-- Detailed Email View -->
                            <div class="email-app-list">
                                    <!-- email details  -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="collapsible email-detail-head">
                                                <div class="card collapse-header" role="tablist">
                                                    <div id="headingCollapse5" class="card-header d-flex justify-content-between align-items-center" data-toggle="collapse" role="tab" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                                        <div class="collapse-title media">
                                                            <div class="pr-1">
                                                                <div class="avatar mr-75">                                                                   
                                                                    <div class="livicon-evo" data-options=" name: briefcase.svg; size: 40px "></div>
                                                                </div>
                                                            </div>
                                                            <div class="media-body mt-25">
                                                            <?php 
                                                            
                                                                //administration

                                                                if($crea['doc_pieceid'] == ""){
                                                                    $t_doc_pieceid = "0";
                                                                }else{
                                                                    $t_doc_pieceid = "1";
                                                                }
                                                                if($crea['doc_cerfaM0'] == ""){
                                                                    $t_doc_cerfaM0 = "0";
                                                                }else{
                                                                    $t_doc_cerfaM0 = "1";
                                                                }
                                                                if($crea['doc_xp'] == ""){
                                                                    $t_doc_xp = "0";
                                                                }else{
                                                                    $t_doc_xp = "1";
                                                                }
                                                                if($crea['doc_justificatifd'] == ""){
                                                                    $t_doc_justificatifd= "0";
                                                                }else{
                                                                    $t_doc_justificatifd = "1";
                                                                }
                                                                if($crea['doc_peirl'] == ""){
                                                                    $t_doc_peirl = "0";
                                                                }else{
                                                                    $t_doc_peirl = "1";
                                                                }

                                                                $t_administration = '' . ($t_doc_pieceid + $t_doc_cerfaM0 + $t_doc_xp + $t_doc_justificatifd + $t_doc_peirl) . '/5';

                                                                //redaction

                                                                if($crea['doc_affectation'] !== "" ){
                                                                    $t_doc_affectation = "1";
                                                                }else{
                                                                    $t_doc_affectation = "0";
                                                                }
                                                                if($crea['doc_pouvoir'] !== "" ){
                                                                    $t_doc_pouvoir = "1";
                                                                }else{
                                                                    $t_doc_pouvoir = "0";
                                                                } 
                                                                if($crea['doc_attestation'] !== "" ){
                                                                    $t_doc_attestation = "1";
                                                                }else{
                                                                    $t_doc_attestation = "0";
                                                                }

                                                                $t_redaction = ''.($t_doc_affectation + $t_doc_pouvoir + $t_doc_attestation).'/3';

                                                                // 

                                                                if($crea['doc_depot'] !== "" ){
                                                                    $t_doc_depot = "1";
                                                                }else{
                                                                    $t_doc_depot = "0";
                                                                } 
                                                                if($crea['doc_annonce'] !== "" ){
                                                                    $t_doc_annonce = "1";
                                                                }else{
                                                                    $t_doc_annonce = "0";
                                                                }

                                                                $t_banque = ''.($t_doc_depot + $t_doc_annonce).'/2';


                                                            ?>
                                                                <span class="text-primary">Administation</span>
                                                                <small class="text-muted d-block">Pi??ce d'identite, Cerfa M0, Exp professionnel, Justificatif de domicile, Peirl.</small>
                                                            </div>
                                                        </div>
                                                        <div class="information d-sm-flex d-none align-items-center">
                                                            
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>   
                                                            </div>
                                                            <p class="sizeright <?php if($t_administration == "5/5"){echo "success";}else{echo "warning";} ?>"><?= $t_administration ?></p>
                                                        </div>
                                                    </div>
                                                    <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="collapse">
                                                    <?php 

                                                        if($crea['doc_pieceid'] !== ""){
                                                        if(substr($crea['doc_pieceid'], -3) == "pdf"){
                                                            $crea_pieceid = "pdf.png";
                                                        }else{
                                                            $crea_pieceid = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_pieceid = "doc.png";
                                                        }

                                                        //cerfaM0

                                                        if($crea['doc_cerfaM0'] !== ""){
                                                        if(substr($crea['doc_cerfaM0'], -3) == "pdf"){
                                                            $crea_cerfaM0 = "pdf.png";
                                                        }else{
                                                            $crea_cerfaM0 = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_cerfaM0 = "doc.png";
                                                        }

                                                        //xp

                                                        if($crea['doc_xp'] !== ""){
                                                        if(substr($crea['doc_xp'], -3) == "pdf"){
                                                            $crea_xp = "pdf.png";
                                                        }else{
                                                            $crea_xp = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_xp = "doc.png";
                                                        }

                                                        //justificatif ss

                                                        if($crea['doc_justificatifd'] !== ""){
                                                        if(substr($crea['doc_justificatifd'], -3) == "pdf"){
                                                            $crea_justificatifd = "pdf.png";
                                                        }else{
                                                            $crea_justificatifd = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_justificatifd = "doc.png";
                                                        }

                                                        //statuts

                                                        if($crea['doc_statuts'] !== ""){
                                                        if(substr($crea['doc_statuts'], -3) == "pdf"){
                                                            $crea_statuts = "pdf.png";
                                                        }else{
                                                            $crea_statuts = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_statuts = "doc.png";
                                                        }

                                                        //affectation

                                                        if($crea['doc_affectation'] !== ""){
                                                        if(substr($crea['doc_affectation'], -3) == "pdf"){
                                                            $crea_affectation = "pdf.png";
                                                        }else{
                                                            $crea_affectation = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_affectation = "doc.png";
                                                        }

                                                        //pouvoir

                                                        if($crea['doc_pouvoir'] !== ""){
                                                        if(substr($crea['doc_pouvoir'], -3) == "pdf"){
                                                            $crea_pouvoir = "pdf.png";
                                                        }else{
                                                            $crea_pouvoir = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_pouvoir = "doc.png";
                                                        }

                                                        //attestation

                                                        if($crea['doc_attestation'] !== ""){
                                                        if(substr($crea['doc_attestation'], -3) == "pdf"){
                                                            $crea_attestation = "pdf.png";
                                                        }else{
                                                            $crea_attestation = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_attestation = "doc.png";
                                                        }

                                                        //depot

                                                        if($crea['doc_depot'] !== ""){
                                                        if(substr($crea['doc_depot'], -3) == "pdf"){
                                                            $crea_depot = "pdf.png";
                                                        }else{
                                                            $crea_depot = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_depot = "doc.png";
                                                        }

                                                        //annonce

                                                        if($crea['doc_annonce'] !== ""){
                                                        if(substr($crea['doc_annonce'], -3) == "pdf"){
                                                            $crea_annonce = "pdf.png";
                                                        }else{
                                                            $crea_annonce = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_annonce = "doc.png";
                                                        }

                                                        //peirl

                                                        if($crea['doc_peirl'] !== ""){
                                                        if(substr($crea['doc_peirl'], -3) == "pdf"){
                                                            $crea_peirl = "pdf.png";
                                                        }else{
                                                            $crea_peirl = "doc.png";
                                                        }
                                                        }else{
                                                            $crea_peirl = "doc.png";
                                                        }
                                                    
                                                    ?>
                                                        <style>
                                                        .image-upload > input {
                                                            display: none;
                                                        }

                                                        .image-upload img {
                                                            width: 80px;
                                                            cursor: pointer;
                                                        }
                                                        </style>
                                                        <div class="card-content">
                                                            <div class="card-footer pt-0 border-top">
                                                                <label class="sidebar-label">Document d'administration :</label>
                                                                <ul class="list-unstyled mb-0">
                                                                    <li class="cursor-pointer pb-25">
                                                                        <small class="text-muted ml-1 attchement-text <?php if($crea['doc_pieceid'] == ""){echo "warning";}else{echo "success";} ?>">Piece d'identit??e :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_pieceid ?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_pieceid'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=pieceid"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_pieceid'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>

                                                                        <a class="<?php if($crea['doc_pieceid'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/pieceid/<?= $crea['doc_pieceid'] ?>" target="_blank"><div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div></a>
                                                                    </li>
                                                                   
                                                                    <li class="cursor-pointer pb-25">
                                                                        <small class="text-muted ml-1 attchement-text <?php if($crea['doc_cerfaM0'] == ""){echo "warning";}else{echo "success";} ?>">Cerfa M0 :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_cerfaM0?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_cerfaM0'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=cerfaM0"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_cerfaM0'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>

                                                                        <a class="<?php if($crea['doc_cerfaM0'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/cerfaM0/<?= $crea['doc_cerfaM0'] ?>" target="_blank"><div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div></a>
                                                                    </li>
                                                                   
                                                                  
                                                                    <li class="cursor-pointer pb-25">
                                                                        <small class="text-muted ml-1 attchement-text <?php if($crea['doc_xp'] == ""){echo "warning";}else{echo "success";} ?>">Experience professionnel :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_xp ?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_xp'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=xp"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_xp'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>

                                                                        <a class="<?php if($crea['doc_xp'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/xpprofessionnel/<?= $crea['doc_xp'] ?>" target="_blank"><div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div></a>
                                                                    </li>
                                                                    <li class="cursor-pointer pb-25">
                                                                        <small class="text-muted ml-1 attchement-text <?php if($crea['doc_justificatifd'] == ""){echo "warning";}else{echo "success";} ?>">Justificatif de domicile :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_justificatifd ?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_justificatifd'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=justificatifd"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_justificatifd'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>

                                                                        <a class="<?php if($crea['doc_justificatifd'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/justificatifd/<?= $crea['doc_justificatifd'] ?>" target="_blank"><label class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></label></a>
                                                                    </li>
                                                                    <li class="cursor-pointer pb-25">
                                                                        <small class="text-muted ml-1 attchement-text <?php if($crea['doc_peirl'] == ""){echo "warning";}else{echo "success";} ?>">PEIRL :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_peirl ?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_peirl'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=peirl"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_peirl'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>
                                                                        <a class="<?php if($crea['doc_peirl'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/peirl/<?= $crea['doc_peirl'] ?>" target="_blank"><label class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></label></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card collapse-header" role="tablist">
                                                    <div class="form-group">
                                                    </div>
                                                    <div id="headingCollapse6" class="card-header d-flex justify-content-between align-items-center" data-toggle="collapse" role="tab" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                                        <div class="collapse-title media">
                                                            <div class="pr-1">
                                                                <div class="avatar mr-75">
                                                                    <div class="livicon-evo" data-options=" name: pen.svg; size: 40px "></div>
                                                                </div>
                                                            </div>
                                                            <div class="media-body mt-25">
                                                                <span class="text-primary">R??daction </span>
                                                                <small class="text-muted d-block">Affectation patrimoine, Pouvoir, attestation de non condamnation .</small>
                                                            </div>
                                                        </div>
                                                        <div class="information d-sm-flex d-none align-items-center">
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle" id="second-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                            </div>
                                                            <p class="sizeright <?php if($t_redaction == "3/3"){echo "success";}else{echo "warning";} ?>"><?= $t_redaction ?></p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div id="collapse6" role="tabpanel" aria-labelledby="headingCollapse7" class="collapse">
                                                        <div class="card-content">
                                                            <div class="card-footer pt-0 border-top">
                                                                <label class="sidebar-label">Document ?? r??diger :</label>
                                                                <ul class="list-unstyled mb-0">
                                                                    <li class="cursor-pointer">
                                                                       <small class="text-muted ml-1 attchement-text <?php if($crea['doc_affectation'] == ""){echo "warning";}else{echo "success";} ?>">Affectation pateimoine :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_affectation ?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_affectation'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=affectation"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_affectation'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>
                                                                        <a class="<?php if($crea['doc_affectation'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/affectation/<?= $crea['doc_affectation'] ?>" target="_blank"><label class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></label></a>
                                                                    </li>
                                                                    <li class="cursor-pointer pb-25">
                                                                        <small class="text-muted ml-1 attchement-text <?php if($crea['doc_pouvoir'] == ""){echo "warning";}else{echo "success";} ?>">Pouvoir :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_pouvoir ?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_pouvoir'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=pouvoir"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_pouvoir'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>
                                                                        <a class="<?php if($crea['doc_pouvoir'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/pouvoir/<?= $crea['doc_pouvoir'] ?>" target="_blank"><label class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></label></a>
                                                                    </li>
                                                                    <li class="cursor-pointer pb-25">
                                                                        <small class="text-muted ml-1 attchement-text <?php if($crea['doc_attestation'] == ""){echo "warning";}else{echo "success";} ?>">attestation de non condamnation :</small>
                                                                        <img src="../../../app-assets/images/icon/<?= $crea_attestation ?>" height="30" alt="psd.png">
                                                                        <small class="text-muted ml-1 attchement-text"><?= $crea['doc_attestation'] ?></small>

                                                                            <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=physique&type=attestation"><div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_attestation'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div></a>
                                                                        <a class="<?php if($crea['doc_attestation'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/attestation/<?= $crea['doc_attestation'] ?>" target="_blank"><label class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></label></a>                                                               
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- email details  end-->
                                    <div class="form-group text-center">
                                        <p class="compose-btn esp">En savoir plus</p>
                                    </div>       
                                        <!-- Input Validation end -->    

                                    <div class="">
                                    <!-- Simple Validation start -->
                                        <section class="simple-validation">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header text-center">
                                                            <h4 class="card-title">Paiement & D??pot</h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col" style="border-right: 1px solid #A3AFBD;">
                                                                        <form action="" class="form-horizontal" method="POST">
                                                                            <input type="hidden" name="num" id="num_crea" value="<?= $_GET['num'] ?>">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                    <label for="valid-state">Frais</label>
                                                                                        <input type="number" min="0" name="frais" class="form-control <?php if($crea['frais'] == ""){echo "is-invalid";}else{echo "is-valid";} ?>" id="valid-state" placeholder="Frais en ???" value="<?php $value_frais = explode('!',$crea['frais']); echo $value_frais[0]; ?>" required>
                                                                                        <div class="valid-feedback">
                                                                                            <i class="bx bx-radio-circle"></i>
                                                                                        Frais de paiement enregist?? <?php $value_frais = explode('!',$crea['frais']); echo $value_frais[0]; ?> ??? 
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col col-lg-2">
                                                                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center" style="position: relative; top: 20%;">
                                                                                            <p class="mb-0">Pay??</p>
                                                                                            <input onchange="paiement_frais_check()" name="frais_check" type="checkbox" class="custom-control-input" id="customSwitch1" <?php if(substr($crea['frais'], -3) == "yes"){echo "checked";} ?>>
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
                                                                                    <label for="valid-state">Honoraire</label>
                                                                                        <input type="number" min="0" name="honoraire" class="form-control <?php if($crea['honoraire'] == ""){echo "is-invalid";}else{echo "is-valid";} ?>" id="valid-state" placeholder="Honoraire en ???" value="<?php $value_honoraire = explode('!',$crea['honoraire']); echo $value_honoraire[0]; ?>" required>
                                                                                        <div class="valid-feedback">
                                                                                            <i class="bx bx-radio-circle"></i>
                                                                                        Honoraire de paiement enregist?? <?php $value_honoraire = explode('!',$crea['honoraire']); echo $value_honoraire[0]; ?> ??? 
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col col-lg-2">
                                                                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center" style="position: relative; top: 20%;">
                                                                                            <p class="mb-0">Pay??</p>
                                                                                            <input onchange="paiement_honoraire_check()" name="honoraire_check"  type="checkbox" class="custom-control-input" id="customSwitch11" <?php if(substr($crea['honoraire'], -3) == "yes"){echo "checked";} ?>>
                                                                                            <label class="custom-control-label" for="customSwitch11">
                                                                                                <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                                                <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button type="submit" class="btn btn-outline-<?php if($crea['frais'] == "" || $crea['honoraire']){echo "secondary";}else{echo "success";} ?> col-12"><i class="bx bx-check"></i><span class="align-middle ml-25"><?php if($crea['frais'] == "" && $crea['honoraire'] == ""){echo "Enregister les montants";}else{echo "Modifier les montants";} ?></span></button>
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
                                                                                    <small class="text-muted mr-75 <?php if($crea['depo_greffe'] !== ""){echo "none-validation";} ?>">
                                                                                        D??pot au Greffe : 
                                                                                    </small>
                                                                                    <small class="text-muted mr-75 <?php if($crea['depo_greffe'] == ""){echo "none-validation";} ?>">
                                                                                        D??pot au greffe le <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($dateee)); ?>
                                                                                    </small>
                                                                                    <fieldset class="d-flex justify-content-end">
                                                                                        <input name="depo_greffe" type="date" class="form-control mb-50 mb-sm-0 <?php if($crea['depo_greffe'] !== ""){echo "none-validation";} ?>" placeholder="jj-mm-aa" style="margin: 5px; position: relative;">
                                                                                        <button type="submit" class="btn btn-icon btn-light-success <?php if($crea['depo_greffe'] !== ""){echo "none-validation";} ?>" style="position: relative; top: 3px;"><i class="bx bx-like"></i></button>

                                                                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center <?php if($crea['depo_greffe'] == ""){echo "none-validation";} ?>" style="position: relative; top: 20%;">
                                                                                            <p class="mb-0">D??pos??</p>
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
                                                                                    <small class="text-muted mr-75 <?php if($crea['depo_cfe'] !== ""){echo "none-validation";} ?>">
                                                                                        D??pot au CFE : 
                                                                                    </small>
                                                                                    <small class="text-muted mr-75 <?php if($crea['depo_cfe'] == ""){echo "none-validation";} ?>">
                                                                                        D??pot au CFE le <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($datee)); ?>
                                                                                    </small>
                                                                                    <fieldset class="d-flex justify-content-end">
                                                                                        <input name="depo_cfe" type="date" class="form-control mb-50 mb-sm-0 <?php if($crea['depo_cfe'] !== ""){echo "none-validation";} ?>" placeholder="jj-mm-aa" style="margin: 5px; position: relative;">
                                                                                        <button type="submit" class="btn btn-icon btn-light-success <?php if($crea['depo_cfe'] !== ""){echo "none-validation";} ?>" style="position: relative; top: 3px;"><i class="bx bx-like"></i></button>

                                                                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center <?php if($crea['depo_cfe'] == ""){echo "none-validation";} ?>" style="position: relative; top: 20%;">
                                                                                            <p class="mb-0">D??pos??</p>
                                                                                            <input onchange="cfe()" name="cfe_check"  type="checkbox" class="custom-control-input" id="customSwitch99" checked>
                                                                                            <label class="custom-control-label" for="customSwitch99">
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
                                                                <div class="form-group">
                                                                    <br>
                                                                    <div class="form-group">
                                                                        <a href="php/corbeille_societe.php?statut=validenum=<?= $_GET['num'] ?>"><button type="button" class="btn mb-1 btn-outline-danger btn-lg btn-block">Suppression du dossier de cr??ation !</button></a>
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

                                </div>  
                            </div>
                            <!--/ Detailed Email View -->
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->
    <div class="widget-chat-demo">
        <!-- widget chat demo footer button start -->
        <button class="btn btn-<?php if($crea['notification_admin'] > "0"){echo "danger";}else{echo "secondary";} ?> chat-demo-button glow px-1"><i class="livicon-evo" data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i></button>
        <!-- widget chat demo footer button ends -->
        <!-- widget chat demo start -->
        <div class="widget-chat widget-chat-demo d-none">
            <div class="card mb-0">
                <div class="card-header border-bottom p-0">
                    <div class="media m-75">
                        <a href="JavaScript:void(0);">
                            <div class="avatar mr-75">
                                <img src="../../../app-assets/images/ico/<?= $crea['img_crea'] ?>" alt="avtar images" width="32" height="32">
                                <span class="avatar-status-online"></span>
                            </div>
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);"><?= $crea['name_crea'] ?></a></h6>
                            <span class="text-muted font-small-3">Active</span>
                        </div>
                        <i class="bx bx-x widget-chat-close float-right my-auto cursor-pointer"></i>
                    </div>
                </div>
                <div class="card-body widget-chat-container widget-chat-demo-scroll">
                    <div class="chat-content" id="chat-content">
                        <!-- CLASSEMENT PAR JOURS  -->
                        <!-- <div class="badge badge-pill badge-light-secondary my-1">Aujourd'hui</div> -->
                        
                    </div>
                </div>
                <div class="card-footer border-top p-1">
                    <div class="d-flex">
                        <input type="hidden" name="id" id="id_client" value="<?= $_GET['num'] ?>">
                        <input type="hidden" name="author" id="author" value="<?= $crea['name_crea'] ?>">
                        <input type="text" name="content" id="content" class="form-control chat-message-demo mr-75" placeholder="Tappez votre message...">
                        <button id="btn_submit" type="button" class="btn btn-primary glow px-1"><i class="bx bx-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- widget chat demo ends -->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php

    $pdo = $bdd->prepare('UPDATE crea_societe SET notification_admin=:notification_admin, message_crea=:message_crea WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_GET['num']);
    $pdo->bindValue(':notification_admin', "0");   
    $pdo->bindValue(':message_crea', "Dossier en cours de traitement ...");
    $pdo->execute();                                                    

    ?>

    <script>
        function paiement_frais_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_frais.php?num=<?= $_GET['num'] ?>&result=<?= $crea['frais'] ?>');
            requeteAjax.send(notification_crea);
        }
        function paiement_honoraire_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_honoraire.php?num=<?= $_GET['num'] ?>&result=<?= $crea['honoraire'] ?>');
            requeteAjax.send(notification_crea);
        }

        function greffe_depo(){
            document.location.href="php/change_depo.php?num=<?= $_GET['num'] ?>&style=greffe&forme=physique"; 
        }

        function cfe(){
            document.location.href="php/change_depo.php?num=<?= $_GET['num'] ?>&style=cfe&forme=physique"; 
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
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-email.js"></script>
    <script src="../../../app-assets/js/scripts/pages/chat_crea.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?> 
</body>
<!-- END: Body-->

</html>