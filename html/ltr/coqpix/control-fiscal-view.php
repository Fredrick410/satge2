<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'gestionnaire fiscal');
require_once 'php/verif_session_connect_admin.php';

    $pdoSta = $bdd->prepare('SELECT * FROM fiscal WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $societe = $pdoSta->fetch();

// Update POST Value
    function updateValue($pdo, $arg, $col){        
        $sql = $pdo->prepare('UPDATE fiscal SET '.$col.'=:'.$col.' WHERE id=:num LIMIT 1');
        $sql->bindValue(':'.$col.'', $arg);
        $sql->bindValue(':num', $_GET['num']);
        $sql->execute();
        header('Location: control-fiscal-view.php?num='.$_GET['num'].'');
        exit();
    }

// Check the presence of the file
    function presentDoc($sql,$arg){
        if($sql[$arg] !== "" AND is_null($sql[$arg])==false ){
            $nbDoc = "1";
        }else{
            $nbDoc = "0";
        }
        return $nbDoc;
    }

// Display document acronym
    function acronymDoc($sql,$arg){
        if($sql[$arg] !== "" AND is_null($sql[$arg])==false ){
            if(substr($sql[$arg], -3) == "pdf"){
                $acronDoc = "pdf.png";
            }
            else{
                $acronDoc = "doc.png";
            }
        }
        else{
            $acronDoc = "doc.png";
        }
        return $acronDoc; 
    }

    // Se déclenche quand  on fait une requête POST sur le formulaire du Frais
    if(isset($_POST['frais'])){

        if(!empty($_POST['frais_check'])){
            if($_POST['frais_check'] == "on"){
                $frais = ''.$_POST['frais'].'!yes';
            }else{
                $frais = ''.$_POST['frais'].'!no';
            }
        }else{
            $frais = ''.$_POST['frais'].'!no';
        }
        //dd($frais);
        //var_dump($frais);
        //var_dump($_GET['num']);
        $sql = $bdd->prepare('UPDATE fiscal SET frais=:frais WHERE id=:num LIMIT 1');
        $sql->bindValue(':frais', $frais);
        $sql->bindValue(':num', $_GET['num']);
        $sql->execute();

        // Retourner sur la page ou rafraichir la page actuelle
        header('Location: control-fiscal-view.php?num='.$_GET['num'].'');
        exit();
    }

    if(isset($_POST['date_begin'])){
        $date_control_begin = htmlspecialchars($_POST['date_begin']);
        
        if($date_control_begin !== ""){
            updateValue($bdd,$date_control_begin,'date_control_begin');
        }else{
            $date_control_begin2 = substr($societe['date_control_begin'], 0, -5);
            updateValue($bdd,$date_control_begin2,'date_control_begin');
        }
    }

    if(isset($_POST['date_end'])){
        $date_control_end = htmlspecialchars($_POST['date_end']);

        if($date_control_end !== ""){
            updateValue($bdd,$date_control_end,'date_control_end');
        }else{
            $date_control_end2 = substr($societe['date_control_end'], 0, -5);        
            updateValue($bdd,$date_control_end2,'date_control_end');
        }
    }

    if(isset($_POST['control_obj'])){
        $object_control = htmlspecialchars($_POST['control_obj']);

        if($object_control !== ""){        
            updateValue($bdd,$object_control,'object_control');
        }else{
            $object_control2 = substr($societe['object_control'], 0, -5);        
            updateValue($bdd,$object_control2,'object_control');
        }
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
    <title>Controle fiscal</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
<!-- encadrement voir app-email.css ligne 3-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .icon{color: #727E8C;}
    .icon:hover{color: #00fbff; opacity: 0.5; cursor: pointer;}
    .none-validation{display: none;}
    .nonedoc {display : none;}
    .sizeright{font-size: 12px;}

    .sizebar{margin: 10px auto; width: 500px; }

    .bouge{
        overflow-y: auto;
        scrollbar-color: #e5e5e5 white;
        scrollbar-width: thin;
        border-radius: 10px;
        overflow-x:hidden;
    }

    .image-upload > input {
        display: none;
    }
    
    .image-upload img {
        width: 80px;
        cursor: pointer;
    }

</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #e72424;">
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
                            <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span></a>
                            <div class="dropdown-menu dropdown-menu pb-0">
                                <a class="dropdown-item" href="#"><i class="bx bx-user mr-50"></i> Editer Profile (SOON)</a>
                                <a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Déconnexion</a>
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
                <a href="<?php if($societe['trash_statut'] != ""){echo "control-fiscal-corbeille.php";}else{echo "control-fiscal.php";} ?>" ><i class='bx bx-arrow-back backk'></i></a>
            </div>
           
            <div class="content-wrapper bouge" style="width: 100%;">
                <div class="content-body">
                    <!-- fiscal app overlay -->
                    <div class="fiscal-app-area">
                        <!-- Detailed Fiscal View -->
                        <div class="fiscal-app-list">
                            <!-- fiscal details start -->
                            <section class="file-repository">
                                <div class="row">
                                    <div class="col-12" style="padding: 0px;">
                                        <div class="collapsible fiscal-detail-head">
                                            <!--First Phase start-->
                                            <?php
                                                //Nombre fichier phase1
                                                
                                                $t_doc_mandat = presentDoc($societe,'doc_mandat');

                                                $t_doc_cerfa27 = presentDoc($societe,'doc_cerfa27');

                                                $t_doc_cour = presentDoc($societe,'doc_cour');

                                                $t_doc_fec = presentDoc($societe,'doc_fec');

                                                $t_doc_rdv = presentDoc($societe,'doc_rdv');

                                                $t_phase1 = '' . ($t_doc_mandat + $t_doc_cerfa27 + $t_doc_cour + $t_doc_fec + $t_doc_rdv) . '/5';
/*
                                                if ($t_phase1=="5/5") {
                                                    $notif = $bdd->prepare('INSERT INTO notif_back (name_entreprise, date_demande, type_demande, id_session) VALUES(?,?,?,?)');
                                                    $notif->execute(array(
                                                        htmlspecialchars($societe['name_entreprise']),
                                                        htmlspecialchars(date('Y-m-d')),
                                                        htmlspecialchars("phase_fisca"),
                                                        htmlspecialchars($_GET['num'])
                                                    ));
                                                                                                }

                                                $search_notifs=$bdd->prepare('SELECT type_demande FROM notif_back WHERE id_session=:id LIMIT 1');
                                                $search_notifs->bindValue(':id',$_GET['num']);
                                                $search_notifs->execute();
                                                $result_notifs=$search_notifs->fetch(PDO::FETCH_ASSOC);
                                                */
                                                
                                                                                     //Mandat
                                                $societe_mandat = acronymDoc($societe,'doc_mandat');
                                                /*if($societe['doc_mandat'] !== "" AND is_null($societe['doc_mandat'])==false ){
                                                    if(substr($societe['doc_mandat'], -3) == "pdf"){
                                                        $societe_mandat = "pdf.png";
                                                    }
                                                    else{
                                                        $societe_mandat = "doc.png";
                                                    }
                                                }
                                                else{
                                                    $societe_mandat = "doc.png";
                                                }*/
                            
                                                //Cerfa27
                                                $societe_cerfa27 = acronymDoc($societe,'doc_cerfa27');
                                                
                                                //Courrier Annexe
                                                $societe_cour = acronymDoc($societe,'doc_cour');
                                                
                                                //FEC
                                                $societe_fec = acronymDoc($societe,'doc_fec');
                                                
                                                //Attestation RDV
                                                $societe_rdv = acronymDoc($societe,'doc_rdv');
                                                
                                            ?>
                                            <div class="card collapse-header" role="tablist">                                                
                                                <div id="headingCollapse1" class="card-header d-flex justify-content-between align-items-center" 
                                                data-toggle="collapse" role="tab" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                    <div>
                                                        <div class="pr-1">
                                                            <div class="avatar mr-75">                                                                   
                                                                <div class="livicon-evo" data-options=" name: briefcase.svg; size: 40px "></div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-body mt-25">
                                                        <span class="text-primary">Phase de premier rendez-vous</span>
                                                        <small class="text-muted d-block">Mandat, Cerfa 3927-SD, Courrier Annexe, Ensemble des fichiers FEC, Attestation de Rdv</small>
                                                    </div>
                                                    <div class="information d-sm-flex d-none align-items-center">        
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>   
                                                        </div>
                                                        <p class="sizeright <?php if($t_phase1 == "5/5"){echo "success";}else{echo "warning";} ?>"><?= $t_phase1 ?></p>
                                                    </div>
                                                </div>
                                                <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                                                    <div class="card-content">
                                                        <div class="card-footer pt-0 border-top text-center" >
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_mandat'] == "" OR is_null($societe['doc_mandat'])==true){echo "warning";}else{echo "success";} ?>">Mandat :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_mandat ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_mandat'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase1/mandat&type=mandat">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_mandat'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_mandat'] == "" OR is_null($societe['doc_mandat'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase1/mandat/<?= $societe['doc_mandat'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_mandat'] == "" OR is_null($societe['doc_mandat'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase1/mandat&file=<?= $societe['doc_mandat'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_cerfa27'] == "" OR is_null($societe['doc_cerfa27'])==true){echo "warning";}else{echo "success";} ?>">Cerfa 3927-SD :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_cerfa27 ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_cerfa27'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase1/cerfa_27&type=cerfa27">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_cerfa27'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cerfa27'] == "" OR is_null($societe['doc_cerfa27'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase1/cerfa_27/<?= $societe['doc_cerfa27'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cerfa27'] == "" OR is_null($societe['doc_cerfa27'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase1/cerfa_27&file=<?= $societe['doc_cerfa27'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_cour'] == "" OR is_null($societe['doc_cour'])==true){echo "warning";}else{echo "success";} ?>">Courrier Annexe :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_cour ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_cour'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase1/courrier&type=cour">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_cour'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cour'] == "" OR is_null($societe['doc_cour'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase1/courrier/<?= $societe['doc_cour'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cour'] == "" OR is_null($societe['doc_cour'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase1/courrier&file=<?= $societe['doc_cour'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_fec'] == "" OR is_null($societe['doc_fec'])==true){echo "warning";}else{echo "success";} ?>">Ensemble des fichiers FEC :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_fec ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_fec'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase1/fichier_FEC&type=fec">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_fec'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_fec'] == "" OR is_null($societe['doc_fec'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase1/fichier_FEC/<?= $societe['doc_fec'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_fec'] == "" OR is_null($societe['doc_fec'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase1/fichier_FEC&file=<?= $societe['doc_fec'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_rdv'] == "" OR is_null($societe['doc_rdv'])==true){echo "warning";}else{echo "success";} ?>">Attestation de rendez-vous :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_rdv ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_rdv'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase1/attestation_RDV&type=rdv">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_rdv'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_rdv'] == "" OR is_null($societe['doc_rdv'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase1/attestation_RDV/<?= $societe['doc_rdv'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_rdv'] == "" OR is_null($societe['doc_rdv'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase1/attestation_RDV&file=<?= $societe['doc_rdv'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--First Phase end-->
                                            <!--Second Phase start-->
                                            <?php
                                                //Nombre fichier phase2
                                                $t_doc_mail = presentDoc($societe,'doc_mail');
                                                $t_doc_noteV = presentDoc($societe,'doc_noteV');
                                                
                                                $t_phase2 = '' . ($t_doc_mail + $t_doc_noteV) . '/2';

                                                //Courrier
                                                $societe_mail = acronymDoc($societe,'doc_mail');

                                                //Note interne (phase verification/contradictoire)
                                                $societe_noteV = acronymDoc($societe,'doc_noteV');                                                
                                                
                                            ?>
                                            <div class="card collapse-header" role="tablist">
                                                <div id="headingCollapse2" class="card-header d-flex justify-content-between align-items-center" 
                                                data-toggle="collapse" role="tab" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                    <div>
                                                        <div class="pr-1">
                                                            <div class="avatar mr-75">                                                                   
                                                                <div class="livicon-evo" data-options=" name: briefcase.svg; size: 40px "></div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-body mt-25">
                                                        <span class="text-primary">Phase de vérification et contradictoire</span>
                                                        <small class="text-muted d-block">Courrier / Mail, Note interne</small>
                                                    </div>

                                                    <div class="information d-sm-flex d-none align-items-center">        
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>   
                                                        </div>
                                                        <p class="sizeright <?php if($t_phase2 == "2/2"){echo "success";}else{echo "warning";} ?>"><?= $t_phase2 ?></p>
                                                    </div>
                                                </div>
                                                <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse">
                                                    <div class="card-content">
                                                        <div class="card-footer pt-0 border-top text-center" >
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_mail'] == "" OR is_null($societe['doc_mail'])==true){echo "warning";}else{echo "success";} ?>">Courrier/Mail :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_mail ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_mail'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase2/mail&type=mail">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_mail'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_mail'] == "" OR is_null($societe['doc_mail'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase2/mail/<?= $societe['doc_mail'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_mail'] == "" OR is_null($societe['doc_mail'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase2/mail&file=<?= $societe['doc_mail'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_noteV'] == "" OR is_null($societe['doc_noteV'])==true){echo "warning";}else{echo "success";} ?>">Note Interne :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_noteV ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_noteV'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase2/note_int&type=noteV">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_noteV'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_noteV'] == "" OR is_null($societe['doc_noteV'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase2/note_int/<?= $societe['doc_noteV'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_noteV'] == "" OR is_null($societe['doc_noteV'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase2/note_int&file=<?= $societe['doc_noteV'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                            <!--Second Phase end-->
                                            <!--Third Phase start-->
                                            <?php
                                                //Nombre fichier phase3
                                                $t_doc_cerfa24 = presentDoc($societe,'doc_cerfa24');
                                                $t_doc_cerfa26 = presentDoc($societe,'doc_cerfa26');
                                                $t_doc_contest = presentDoc($societe,'doc_contest');
                                                
                                                $t_phase3 = '' . ($t_doc_cerfa24 + $t_doc_cerfa26 + $t_doc_contest) . '/3';

                                                //Cerfa 3924
                                                $societe_cerfa24 = acronymDoc($societe,'doc_cerfa24');
                                                
                                                //Cerfa 3926
                                                $societe_cerfa26 = acronymDoc($societe,'doc_cerfa26');
                                                
                                                //Courrier contestation
                                                $societe_contest = acronymDoc($societe,'doc_contest');                                                
                                                
                                            ?>
                                            <div class="card collapse-header" role="tablist">
                                                <div id="headingCollapse3" class="card-header d-flex justify-content-between align-items-center" 
                                                data-toggle="collapse" role="tab" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                                    <div>
                                                        <div class="pr-1">
                                                            <div class="avatar mr-75">                                                                   
                                                                <div class="livicon-evo" data-options=" name: briefcase.svg; size: 40px "></div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-body mt-25">
                                                        <span class="text-primary">Phase de proposition de rectification</span>
                                                        <small class="text-muted d-block">Cerfa 3924, Cerfa 3926, Courrier contestation</small>
                                                    </div>
                                                    <div class="information d-sm-flex d-none align-items-center">        
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>   
                                                        </div>
                                                        <p class="sizeright <?php if($t_phase3 == "3/3"){echo "success";}else{echo "warning";} ?>"><?= $t_phase3 ?></p>
                                                    </div>
                                                </div>
                                                <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse">
                                                    <div class="card-content">
                                                        <div class="card-footer pt-0 border-top text-center" >
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_cerfa24'] == ""){echo "warning";}else{echo "success";} ?>">Cerfa 3924 :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_cerfa24 ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_cerfa24'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase3/cerfa_24&type=cerfa24">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_cerfa24'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cerfa24'] == "" OR is_null($societe['doc_cerfa24'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase3/cerfa_24/<?= $societe['doc_cerfa24'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cerfa24'] == "" OR is_null($societe['doc_cerfa24'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase3/cerfa_24&file=<?= $societe['doc_cerfa24'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <!--
                                                                    <li class="cursor-pointer pb-25 <?php if($societe['doc_cerfa24'] == "" OR is_null($societe['doc_cerfa24']) == true){echo "none-validation";} ?>">
                                                                        <label for="">date reception (délai 25 jours) de la notification auto</label>
                                                                        
                                                                        <form action="php/notification_fisca.php?" action="POST">
                                                                            <input name="date" type="date"/>
                                                                            <button class="btn btn-icon btn-light-success" type="submit" style="position: relative; top: 3px;">
                                                                                <i class="bx bx-like"></i>
                                                                            </button>
                                                                        </form>
                                                                        
                                                                    </li>
                                                                -->
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_cerfa26'] == ""){echo "warning";}else{echo "success";} ?>">Cerfa 3926 :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_cerfa26 ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_cerfa26'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase3/cerfa_26&type=cerfa26">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_cerfa26'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cerfa26'] == "" OR is_null($societe['doc_cerfa26'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase3/cerfa_26/<?= $societe['doc_cerfa26'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_cerfa26'] == "" OR is_null($societe['doc_cerfa26'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase3/cerfa_26&file=<?= $societe['doc_cerfa26'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_contest'] == ""){echo "warning";}else{echo "success";} ?>">Courrier contestation :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_contest ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_contest'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase3/courrier_contest&type=contest">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_contest'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_contest'] == "" OR is_null($societe['doc_contest'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase3/courrier_contest/<?= $societe['doc_contest'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_contest'] == "" OR is_null($societe['doc_contest'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase3/courrier_contest&file=<?= $societe['doc_contest'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Third Phase end-->
                                            <!--Fourth Phase start-->
                                            <?php
                                            
                                                //Nombre fichier phase3
                                                $t_doc_saisine = presentDoc($societe,'doc_saisine');
                                                $t_doc_noteI = presentDoc($societe,'doc_noteI');
                                                
                                                $t_phase4 = '' . ($t_doc_saisine + $t_doc_noteI) . '/2';

                                                //Saisine
                                                $societe_saisine = acronymDoc($societe,'doc_saisine');
                                                
                                                //Note Interne phase4
                                                $societe_noteI = acronymDoc($societe,'doc_noteI');
                                                                                            
                                            ?>
                                            <div class="card collapse-header" role="tablist">
                                                <div id="headingCollapse4" class="card-header d-flex justify-content-between align-items-center" 
                                                data-toggle="collapse" role="tab" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                                    <div>
                                                        <div class="pr-1">
                                                            <div class="avatar mr-75">                                                                   
                                                                <div class="livicon-evo" data-options=" name: briefcase.svg; size: 40px "></div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-body mt-25">
                                                        <span class="text-primary">Phase Contentieuse / Impôt</span>
                                                        <small class="text-muted d-block">Courrier se saisine par le chef de Brigade / l'interlocuteur / la Comission Départementale, Note interne</small>
                                                    </div>
                                                    <div class="information d-sm-flex d-none align-items-center">        
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>   
                                                        </div>
                                                        <p class="sizeright <?php if($t_phase4 == "2/2"){echo "success";}else{echo "warning";} ?>"><?= $t_phase4 ?></p>
                                                    </div>
                                                </div>
                                                <div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4" class="collapse">
                                                    <div class="card-content">
                                                        <div class="card-footer pt-0 border-top text-center" >
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_saisine'] == ""){echo "warning";}else{echo "success";} ?>">Courrier se saisine par le chef de Brigade / l'interlocuteur / la Comission Départementale :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_saisine ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_saisine'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase4/saisine&type=saisine">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_saisine'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_saisine'] == "" OR is_null($societe['doc_saisine'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase4/saisine/<?= $societe['doc_saisine'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_saisine'] == "" OR is_null($societe['doc_saisine'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase4/saisine&file=<?= $societe['doc_saisine'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text <?php if($societe['doc_noteI'] == ""){echo "warning";}else{echo "success";} ?>">Note interne :</small>                                   
                                                                            <img src="../../../app-assets/images/icon/<?= $societe_noteI ?>" height="30" alt="psd.png">
                                                                            <small class="text-muted ml-1 attchement-text"><?= $societe['doc_noteI'] ?></small>
                                                                        </div>

                                                                        <div class="col-md-1-md-1">
                                                                            <a href="control-fiscal-upload.php?num=<?= $_GET['num'] ?>&etape=Phase4/note_int&type=noteI">
                                                                                <div class="image-upload">
                                                                                    <div class="livicon-evo" data-options=" name: <?php if($societe['doc_noteI'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_noteI'] == "" OR is_null($societe['doc_noteI'])==true){echo "nonedoc";} ?>" href="../../../src/fiscal/Phase4/note_int/<?= $societe['doc_noteI'] ?>" target="_blank">
                                                                                <div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div>
                                                                            </a>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <a class="<?php if($societe['doc_noteI'] == "" OR is_null($societe['doc_noteI'])==true){echo "nonedoc";} ?>" href="php/download_fiscal.php?destination=Phase4/note_int&file=<?= $societe['doc_noteI'] ?>&link=one">
                                                                                <i class='bx bx-download'></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Fourth Phase end-->
                                            <!--Fifth Phase start-->
                                            <div class="card collapse-header" role="tablist">
                                                <div id="headingCollapse5" class="card-header d-flex justify-content-between align-items-center" 
                                                data-toggle="collapse" role="tab" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                                    <div>
                                                        <div class="pr-1">
                                                            <div class="avatar mr-75">                                                                   
                                                                <div class="livicon-evo" data-options=" name: briefcase.svg; size: 40px "></div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-body mt-25">
                                                        <span class="text-primary">Phase Conctentieuse Administrative</span>
                                                        <small class="text-muted d-block">Identification compte en ligne telecours citoyen</small>
                                                    </div>
                                                    <div class="information d-sm-flex d-none align-items-center">        
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" id="fisrt-open-submenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>   
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="collapse">
                                                    <div class="card-content">
                                                        <div class="card-footer pt-0 border-top text-center" >
                                                            <ul class="list-unstyled mb-0">                                                                
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <!-- REdirection + Log Telecours -->
                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text">Adresse mail :</small>                                   
                                                                            <small class="text-muted ml-1 attchement-text">oui</small>
                                                                        </div>

                                                                        <div class="col">
                                                                            <small class="text-muted ml-1 attchement-text">Mot de passe :</small>
                                                                            <small class="text-muted ml-1 attchement-text">oui</small>
                                                                        </div>

                                                                    </div>
                                                                </li>
                                                                <li class="cursor-pointer pb-25">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a href="https://citoyens.telerecours.fr/#/authentication" target="_blank">
                                                                                <button type="button" class="btn-send btn btn-primary">
                                                                                    <i class='bx mr-25'></i> 
                                                                                    <span class="d-sm-inline d-none">Télérecours citoyens</span>
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Fifth Phase end-->
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- fiscal details end -->
                            
                            <!-- Simple Validation start -->
                            <section class="simple-validation">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header text-center">
                                                <h4 class="card-title"><?= $societe['name_entreprise'] ?></h4>
                                                <?php
                                                    $num = $_GET['num'];

                                                    if(strpos($societe['statut'],'FINISH') === false ){
                                                        if($t_phase1 == "5/5"){
                                                            $nb_etape_valide=1;
                                                            $etat_dossier="Phase de vérification et contradictoire";
                                                            if($t_phase2 == "2/2"){
                                                                $nb_etape_valide=2;
                                                                $etat_dossier="Phase de proposition de rétification";
                                                                if($t_phase3 == "3/3"){
                                                                    $nb_etape_valide=3;
                                                                    $etat_dossier="Phase Contentieuse / Impôt";
                                                                    if($t_phase4 == "2/2"){
                                                                        $nb_etape_valide=4;
                                                                        $etat_dossier="Phase Conctentieuse Administrative";
                                                                    }
                                                                }
                                                            }
                                                        }else{
                                                            $nb_etape_valide=0;
                                                            $etat_dossier="Phase de premier rendez-vous";
                                                        }
                                                    
                                                        $update = $bdd->prepare('UPDATE fiscal SET statut = ? WHERE id = ?');                                                    
                                                        $update->execute(array( $etat_dossier, $num ));
                                                    }else{
                                                        $nb_etape_valide=5;
                                                        
                                                        setlocale(LC_TIME, "fr_FR");

                                                        $date_statut = strftime("%d/%m/%Y", strtotime(substr($societe['statut'], 7)));
                                                        
                                                        $etat_dossier='Ce dossier a été terminé, le '.$date_statut.'';
                                                    }
                                                ?>                                               
                                                <div class="activity-progress sizebar">
                                                    <p class="text-muted d-inline-block mb-50">Etat du dossier : <?= $etat_dossier ?></p>
                                                    <p class="float-right"><?= $nb_etape_valide ?> / 5</p>
                                                    <div class="progress progress-bar-yellow progress-sm">
                                                        <div class="progress-bar <?php if (strpos($societe['statut'],'FINISH') !== false) {echo "bg-success";}?>" role="progressbar" aria-valuenow="<?= $nb_etape_valide/5 ?>" style="width:<?= 100*$nb_etape_valide/5 ?>%"></div>
                                                    </div>
                                                </div>

                                                <div class="download-files" >
                                                    <a href="php/download_fiscal.php?num=<?= $_GET['num'] ?>&link=all">
                                                        <p class="text-muted d-inline-block mb-50">Télécharger tout le dossier</p>
                                                        <i class='bx bx-download'></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <?php
                                                        //Fiscal Control Object
                                                        if ($societe['object_control'] == "ISTVA"){
                                                            $title_object="Impôt sur les sociétés + Taxe sur la valeur ajoutée (IS+TVA*)";
                                                        }

                                                        if ($societe['object_control'] == "IRTVA"){
                                                            $title_object="Impôt sur le revenu + Taxe sur la valeur ajoutée (IR+TVA)";
                                                        }

                                                        if ($societe['object_control'] == "IR"){
                                                            $title_object="Impôt sur le revenu (IR)";
                                                        }
                                                        
                                                        if ($societe['object_control'] == "TVA"){
                                                            $title_object="Taxe sur la valeur ajoutée (TVA)";
                                                        }
                                                                
                                                    ?>
                                                    <!-- Form Validation start -->
                                                    <div class="row">
                                                        <div class="col" style="border-right: 1px solid #A3AFBD;">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="num_societe" value="<?= $_GET['num'] ?>">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                        <label for="valid-state">Frais</label>
                                                                            <input type="number" min="0" name="frais" class="form-control <?php  if($societe['frais'] == ""){echo "is-invalid";}else{echo "is-valid";} ?>" id="valid-state" placeholder="Frais en €" value="<?php $value_frais = explode('!',$societe['frais']); echo $value_frais[0]; ?>" required>
                                                                            <div class="valid-feedback">
                                                                                <i class="bx bx-radio-circle"></i>
                                                                            Frais de paiement enregisté <?php $value_frais = explode('!',$societe['frais']); echo $value_frais[0]; ?> € 
                                                                            </div>
                                                                        </div>
                                                                        <div class="col col-lg-2">
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center" style="position: relative; top: 20%;">
                                                                                <p class="mb-0">Payé</p>
                                                                                <input onchange="paiement_frais_check()" name="frais_check" type="checkbox" class="custom-control-input" id="customSwitch1" <?php if(substr($societe['frais'], -3) == "yes"){echo "checked";} ?>>
                                                                                <label class="custom-control-label" for="customSwitch1">
                                                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-outline-<?php if($societe['frais'] == ""){echo "secondary";}else{echo "success";} ?> col-12"><i class="bx bx-check"></i><span class="align-middle ml-25"><?php if($societe['frais'] == ""){echo "Enregister les montants";}else{echo "Modifier les montants";} ?></span></button>
                                                                </div>                                                               
                                                            </form>
                                                            <div class="form-group">
                                                                <label for="">Periode de controle :</label>
                                                                <!--<div>
                                                                    <form action="">                                                                    
                                                                        <label for="">Date début contrôle :</label> 
                                                                        <input type="date" value=<?= $societe['date_control_begin'] ?> >
                                                                    </form>
                                                                </div>-->
                                                                <form action="" method="POST">
                                                                    <div class="d-flex align-items-center">
                                                                        <label class="text-center mr-75 <?php if(strpos($societe['date_control_begin'], '!edit') === false){echo "none-validation";} ?>">
                                                                            Date début contrôle : 
                                                                        </label>
                                                                        <label class="text-center <?php if(strpos($societe['date_control_begin'], '!edit') !== false){echo "none-validation";} ?>">
                                                                            Date de début du contrôle le <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($societe['date_control_begin'])); ?>
                                                                        </label>
                                                                        
                                                                        <fieldset class="d-flex justify-content-end">
                                                                            <!-- edit date begin-->
                                                                            <input name="date_begin" type="date" class="form-control mb-50 mb-sm-0 <?php if(strpos($societe['date_control_begin'], '!edit') === false){echo "none-validation";} ?>" placeholder="jj-mm-aa" style="margin: 5px; position: relative;">
                                                                            <button type="submit" class="btn btn-icon btn-light-success <?php if(strpos($societe['date_control_begin'], '!edit') === false){echo "none-validation";} ?>" style="position: relative; top: 3px;"><i class="bx bx-like"></i></button>
                                                                            <!--/ edit date begin-->
                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center <?php if(strpos($societe['date_control_begin'], '!edit') !== false){echo "none-validation";} ?>" style="margin-left: 10px ;position: relative; top: 20%;">
                                                                                <p class="mb-0">Déposé</p>
                                                                                <input onchange="dateD_depo()" type="checkbox" class="custom-control-input" id="customSwitch97" checked>
                                                                                <label class="custom-control-label" for="customSwitch97">
                                                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                                </label>
                                                                            </div>
                                                                        </fieldset>                                                                        
                                                                    </div>
                                                                </form>

                                                                <form action="" method="POST">
                                                                    <div class="d-flex align-items-center">
                                                                        <label class="text-center mr-75 <?php if(strpos($societe['date_control_end'], '!edit') === false){echo "none-validation";} ?>">
                                                                            Date fin contrôle : 
                                                                        </label>
                                                                        <label class="text-center <?php if(strpos($societe['date_control_end'], '!edit') !== false){echo "none-validation";} ?>">
                                                                            Date de fin du contrôle le <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($societe['date_control_end'])); ?>
                                                                        </label>
                                                                        <!--
                                                                        <label for="">Date fin contrôle :</label> 
                                                                        <input type="date" value=<?= $societe['date_control_end'] ?>>
                                                                        -->
                                                                        <fieldset class="d-flex justify-content-end">
                                                                            <input name="date_end" type="date" class="form-control mb-50 mb-sm-0 <?php if(strpos($societe['date_control_end'], '!edit') === false){echo "none-validation";} ?>" placeholder="jj-mm-aa" style="margin: 5px; position: relative;">
                                                                            <button type="submit" class="btn btn-icon btn-light-success <?php if(strpos($societe['date_control_end'], '!edit') === false){echo "none-validation";} ?>" style="position: relative; top: 3px;"><i class="bx bx-like"></i></button>

                                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center <?php if(strpos($societe['date_control_end'], '!edit') !== false){echo "none-validation";} ?>" style="margin-left: 10px ;position: relative; top: 20%;">
                                                                                <p class="mb-0">Déposé</p>
                                                                                <input onchange="dateF_depo()" type="checkbox" class="custom-control-input" id="customSwitch98" checked>
                                                                                <label class="custom-control-label" for="customSwitch98">
                                                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                                </label>
                                                                            </div>
                                                                        </fieldset>                                                                        
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="col pt-0 text-center">
                                                            <form action="" method="POST">
                                                                <label class="text-muted mr-75 <?php if(strpos($societe['object_control'], '!edit') === false){echo "none-validation";} ?>">
                                                                    Objet du contrôle: 
                                                                </label>
                                                                <label class="text-center <?php if(strpos($societe['object_control'], '!edit') !== false){echo "none-validation";} ?>">
                                                                    Objet du contrôle: <?= $title_object ?>
                                                                </label>
                                                                <fieldset class="form-group">
                                                                    <select name="control_obj" class="form-control invoice-item-select <?php if(strpos($societe['object_control'], '!edit') == false){echo "none-validation";} ?>">
                                                                        <option value="" selected disable hidden>Choisir l'objet du contrôle</option>
                                                                        <option value="ISTVA">Impôt sur les sociétés + Taxe sur la valeur ajoutée (IS+TVA*)</option>
                                                                        <option value="IRTVA">Impôt sur le revenu + Taxe sur la valeur ajoutée (IR+TVA)</option>
                                                                        <option value="IR">Impôt sur le revenu (IR)</option>
                                                                        <option value="TVA">Taxe sur la valeur ajoutée (TVA)</option>
                                                                    </select>
                                                                    <button type="submit" class="btn btn-icon btn-light-success <?php if(strpos($societe['object_control'], '!edit') == false){echo "none-validation";} ?>" style="position: relative; top: 3px;"><i class="bx bx-like"></i></button>
                                                                
                                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center <?php if(strpos($societe['object_control'], '!edit') !== false){echo "none-validation";} ?>" style="position: relative; top: 20%;">
                                                                        <p class="mb-0">Déposé</p>
                                                                        <input onchange="object_depo()" type="checkbox" class="custom-control-input" id="customSwitch99" checked>
                                                                        <label class="custom-control-label" for="customSwitch99">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </fieldset>
                                                            </form>

                                                            <form action="php/notification_fisca.php?num=<?= $_GET['num'] ?>&mode=manual" method="POST">
                                                                <label>Notification Manuelle</label>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label class="mr-75">Zone de texte sujet</label> 
                                                                        <br/>                                                               
                                                                        <input type="text" name="sujet" size="50"></input>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label class="mr-75">Zone de texte commentaire</label>
                                                                        <br/>                                                   
                                                                        <textarea name="textfield" cols="50" rows="7"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary"> Envoyer</button>
                                                                    </div>
                                                                </div>
                                                            </form>                                                            
                                                        </div>
                                                    </div>                                                    
                                                    <!-- Form Validation end -->
                                                </div>
                                                <div class="card-footer">
                                                        
                                                        <button onclick="fermer_dossier()" type="submit" class="btn-send btn btn-light-secondary">
                                                            <i class='bx bx-send mr-25'></i> 
                                                            <span class="d-sm-inline d-none">Clotûrer le dossier</span>
                                                        </button>
                                                        <!-- renvoyer un message d'erreur-->
                                                        <button onclick="supr_dossier()" type="reset" class="btn btn-light-secondary cancel-btn mr-1">
                                                            <i class='bx bx-x mr-25'></i>
                                                            <span class="d-sm-inline d-none">Supprimer le dossier</span>
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Simple Validation end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <script>
        function paiement_frais_check(){
            var notification_societe = document.getElementById("num_societe").value;
            alert(notification_societe);
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_frais_fiscal?num=<?= $_GET['num'] ?>&result=<?= $societe['frais'] ?>');
            requeteAjax.send(notification_societe);
        }
        function object_depo(){
            document.location.href="php/change_depo_fiscal.php?num=<?= $_GET['num'] ?>&style=object";
        }

        function dateD_depo(){
            document.location.href="php/change_depo_fiscal.php?num=<?= $_GET['num'] ?>&style=dateD";
        }

        function dateF_depo(){
            document.location.href="php/change_depo_fiscal.php?num=<?= $_GET['num'] ?>&style=dateF";
        }
        
        function fermer_dossier(){
            //
            var spge = <?php echo json_encode($societe['statut']); ?>;
            //
            if (spge.includes("FINISH") === false) {
                if (spge !== "Phase Conctentieuse Administrative"){
                    alert('Pour clôturer ce dossier, il faut compléter la phase: '+spge+'');
                }else{                
                    var res = confirm("Êtes-vous sûr de vouloir clôturer ce dossier ?");
                    if(res){
                        // Mettez ici la logique de clotûre du dossier
                        document.location.href="php/change_statut_fiscal.php?num=<?= $_GET['num'] ?>";
                    }              
                }
            }
            //alert("Afficher msg erreur");
            /*var res = confirm("Êtes-vous sûr de vouloir supprimer?");
            if(res){
                // Mettez ici la logique de suppression
            }*/
            
        }

        function supr_dossier(){
            var res = confirm("Êtes-vous sûr de vouloir supprimer ce dossier ?");
            if(res){
                // Mettez ici la logique de suppression
                document.location.href="php/corbeille_fiscal.php?num=<?= $_GET['num'] ?>&link=files";
            }
        }
    </script>
    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- END Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- END: Page JS-->

    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>