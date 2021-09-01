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

    $pdo = $bdd->prepare('UPDATE crea_societe SET notification_admin=:notification_admin WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_GET['num']);
    $pdo->bindValue(':notification_admin', "0");   
    $pdo->execute();

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

        header('Location: creation-view-morale.php?num='.$_POST['num'].'');
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

        header('Location: creation-view-morale.php?num='.$_POST['num'].'');
        exit();
    }

    if(isset($_POST['depo_greffe'])){

        $depo_greffe = ''.$_POST['depo_greffe'].'!yes';

        $sql = $bdd->prepare('UPDATE crea_societe SET depo_greffe=:depo_greffe WHERE id=:num LIMIT 1');
        $sql->bindValue(':depo_greffe', $depo_greffe);
        $sql->bindValue(':num', $_POST['num_creation']);
        $sql->execute();

        header('Location: creation-view-morale.php?num='.$_POST['num_creation'].'');
        exit();
    }

    if(isset($_POST['depo_cfe'])){

        $depo_cfe = ''.$_POST['depo_cfe'].'!yes';

        $sql = $bdd->prepare('UPDATE crea_societe SET depo_cfe=:depo_cfe WHERE id=:num LIMIT 1');
        $sql->bindValue(':depo_cfe', $depo_cfe);
        $sql->bindValue(':num', $_POST['num_creation']);
        $sql->execute();

        header('Location: creation-view-morale.php?num='.$_POST['num_creation'].'');
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
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Création de société</title>
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
.none-validation{display: none;}

.bouge{
    overflow-y: auto;
    scrollbar-color: #e5e5e5 white;
    scrollbar-width: thin;
    border-radius: 10px;
    overflow-x:hidden;
}
    
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
                                            <input type="text" name="date_crea" class="form-control" value="<?= $crea['date_crea'] ?>" placeholder="Date de création" readonly>
                                        </div>
                                        <div class="form-group pb-50">
                                            <labelledby>Nom de la société</label>
                                            <input type="text" name="name_crea" class="form-control" value="<?= $crea['name_crea'] ?>" placeholder="Nom de la société" required>
                                        </div>
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" name="email_crea" class="form-control" value="<?= $crea['email_crea'] ?>" placeholder="E-mail de la société" required>
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
                                            <input type="text" name="tel_diri" class="form-control" value="<?= $crea['tel_diri'] ?>" placeholder="Téléphone du dirigeant" required>
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
                                                <option value="SARL">SARL</option>
                                                <option value="SAS">SAS</option>
                                                <option value="SASU">SASU</option>
                                                <option value="SCI">SCI</option>
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
            
                <div class="content-wrapper bouge" style="width: 100%;">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- fiscal app overlay -->
                        <div class="app-content-overlay"></div>
                        <div class="fiscal-app-area">
                            <!-- Detailed Fiscal View -->
                            <div class="fiscal-app-list">
                                <!-- fiscal details start -->
                                <section class="file-repository">
                                    <div class="row">
                                        <div class="col-12" style="padding: 0px;">
                                            <div class="collapsible fiscal-detail-head">
                                                <div class="card collapse-header" role="tablist">
                                                    <!---->
                                                    <div id="headingCollapse1" class="card-header d-flex justify-content-between align-items-center" 
                                                    data-toggle="collapse" role="tab" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                        <div class="media-body mt-25">
                                                            <span class="text-primary">Fichiers FEC</span>
                                                            <small class="text-muted d-block">Attestation de dépôt</small>
                                                        </div>
                                                    </div>
                                                    <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                                                        <div>
                                                            <ul>
                                                                <li class="cursor-pointer pb-25">
                                                                    <small class="text-muted ml-1 attchement-text <?php if($crea['doc_pieceid'] == ""){echo "warning";}else{echo "success";} ?>">Piece d'identitée :</small>
                                                                    <img src="../../../app-assets/images/icon/<?= $crea_pieceid ?>" height="30" alt="psd.png">
                                                                    <small class="text-muted ml-1 attchement-text"><?= $crea['doc_pieceid'] ?></small>
                                                                        <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=morale&type=pieceid">
                                                                            <div class="image-upload">
                                                                                <div class="livicon-evo" data-options=" name: <?php if($crea['doc_pieceid'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                            </div>
                                                                        </a>
                                                                    <a class="<?php if($crea['doc_pieceid'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/pieceid/<?= $crea['doc_pieceid'] ?>" target="_blank"><div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!---->
                                                    <!---->
                                                    <div id="headingCollapse2" class="card-header d-flex justify-content-between align-items-center" 
                                                    data-toggle="collapse" role="tab" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                        <div class="media-body mt-25">
                                                            <span class="text-primary">Dates RDV avec contrôleur</span>
                                                            <small class="text-muted d-block">Agenda et Commentaires de l'inspecteur</small>
                                                        </div>
                                                    </div>
                                                    <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse"></div>
                                                    <!---->
                                                    <!---->
                                                    <div id="headingCollapse3" class="card-header d-flex justify-content-between align-items-center" 
                                                    data-toggle="collapse" role="tab" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                                        <div class="media-body mt-25">
                                                            <span class="text-primary">Compte rendu de vérification</span>
                                                            <small class="text-muted d-block">Date de délai de contestation (Notification pour prolongation délai 30 jours et 60 jours)</small>
                                                        </div>
                                                    </div>
                                                    <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse"></div>
                                                    <!---->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- fiscal details end -->

                                <div class="form-group text-center">
                                    <p class="compose-btn esp">Courrier ?</p>
                                </div>

                                
                                <!-- Simple Validation start -->
                                <section class="simple-validation">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                    <h4 class="card-title">Nom de la Société</h4>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <!-- Form Validation start -->
                                                        <form action="" class="form-horizontal" method="POST">
                                                            <div class="row">
                                                                <!-- Left column -->
                                                                <div class="col" style="border-right: 1px solid #A3AFBD;">
                                                                    <div class="form-group">
                                                                        <label for="">Periode de controle :</label>
                                                                        <div>
                                                                            <label for="">Date début contrôle :</label> 
                                                                            <input type="date">
                                                                        </div>
                                                                        <div>
                                                                            <label for="">Date fin contrôle :</label> 
                                                                            <input type="date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Right column -->
                                                                <div class="col">
                                                                    <fieldset class="form-group">
                                                                        <label>Objet du contrôle</label>
                                                                        <select name="object_control" class="form-control invoice-item-select" required>
                                                                            <option value="" selected disable hidden>Choisir l'objet du contrôle</option>
                                                                            <option value="ISTVA">Impôt sur les sociétés + Taxe sur la valeur ajoutée (IS+TVA*)</option>
                                                                            <option value="IRTVA">Impôt sur le revenu + Taxe sur la valeur ajoutée (IR+TVA)</option>
                                                                            <option value="IR">Impôt sur le revenu (IR)</option>
                                                                            <option value="TVA">Taxe sur la valeur ajoutée (TVA)</option>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>  
                                                            </div>
                                                            <!-- Button Validation-->
                                                            <div>
                                                                <button type="submit" name="action1" class="btn btn-light-secondary cancel-btn mr-1">
                                                                    <i class='bx bx-send mr-25'></i>
                                                                    <span class="d-sm-inline d-none">Enregistrer les modifications</span>
                                                                </button>
                                                                <button type="submit" name="action1" class="btn-send btn btn-primary">
                                                                    <i class='bx bx-send mr-25'></i> 
                                                                    <span class="d-sm-inline d-none">Clore le dossier</span>
                                                                </button>
                                                            </div>      
                                                        </form>
                                                        <!-- Form Validation end -->
                                                        <div class="form-group">
                                                            <br>
                                                            <div class="form-group">
                                                                <a href="php/corbeille_societe.php?statut=valide&num=<?= $_GET['num'] ?>"><button type="button" class="btn mb-1 btn-outline-danger btn-lg btn-block">Suppression du dossier de création !</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Simple Validation end -->     
                                                     
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
            document.location.href="php/change_depo.php?num=<?= $_GET['num'] ?>&style=greffe&forme=morale"; 
        }

        function cfe(){
            document.location.href="php/change_depo.php?num=<?= $_GET['num'] ?>&style=cfe&forme=morale"; 
        }

        function article_three(){
            document.location.href="php/change_depo.php?num=<?= $_GET['num'] ?>&style=article&forme=morale"; 
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