<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'gestionnaire fiscal');
require_once 'php/verif_session_connect_admin.php';

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

    .bouge{
    overflow-y: auto;
    scrollbar-color: #e5e5e5 white;
    scrollbar-width: thin;
    border-radius: 10px;
    overflow-x:hidden;
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
                <a href="control-fiscal.php"><i class='bx bx-arrow-back backk'></i></a>
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
                                                                <!--
                                                                <small class="text-muted ml-1 attchement-text <?php if($crea['doc_pieceid'] == ""){echo "warning";}else{echo "success";} ?>">Piece d'identitée :</small>
                                                                <img src="../../../app-assets/images/icon/<?= $crea_pieceid ?>" height="30" alt="psd.png">
                                                                <small class="text-muted ml-1 attchement-text"><?= $crea['doc_pieceid'] ?></small>
                                                                    <a href="creation-upload.php?num=<?= $_GET['num'] ?>&forme=morale&type=pieceid">
                                                                        <div class="image-upload">
                                                                            <div class="livicon-evo" data-options=" name: <?php if($crea['doc_pieceid'] == ""){echo "plus-alt";}else{echo "morph-link";} ?>.svg; size: 25px "></div>
                                                                        </div>
                                                                    </a>
                                                                <a class="<?php if($crea['doc_pieceid'] == ""){echo "nonedoc";} ?>" href="../../../src/crea_societe/pieceid/<?= $crea['doc_pieceid'] ?>" target="_blank"><div class="livicon-evo" data-options=" name: morph-eye-open-close.svg; size: 25px "></div></a>
                                                                -->
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
                                                        <!--
                                                        <div class="form-group">
                                                            <a href="php/corbeille_societe.php?statut=valide&num=<?= $_GET['num'] ?>"><button type="button" class="btn mb-1 btn-outline-danger btn-lg btn-block">Suppression du dossier de création !</button></a>
                                                        </div>
                                                        -->
                                                    </div>
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
        function action_switch(){
            let switchK = document.getElementById('doggo2');
            if(switchK.checked){
                document.getElementById('div_process').style.display = "none";
                document.getElementById('div_finish').style.display = "block";
            } else {
                document.getElementById('div_process').style.display = "block";
                document.getElementById('div_finish').style.display = "none";
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