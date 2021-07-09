<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

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
        <div class="content-area-wrapper bg-white">
            <div class="form-group">
                <style>
                    .backk{font-size: 30px; color: black;}
                    .backk:hover{color: #727E8C;}
                </style>
                <a href="creation-list.php"><i class='bx bx-arrow-back backk'></i></a>
            </div>
            <div class="sidebar-left bg-white">
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

                <div class="content-wrapper bouge bg-white" style="width:100%;">
                    <div class="content-header row ">
                    </div>
                    <div class="content-body bg-white border" style="height: 95%;">
                        <!-- email app overlay -->
                        <div class="app-content-overlay"></div>

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
                                                <span class="text-muted font-small-3">Actif</span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body widget-chat-container widget-chat-demo-scroll" style="background-color: #F2F4F4; height: 79%;">
                                        <div class="chat-content" id="chat-content">
                                            <!-- CLASSEMENT PAR JOURS  -->
                                            <!-- <div class="badge badge-pill badge-light-secondary my-1">Aujourd'hui</div> -->
                                        </div>
                                    </div>
                                    <div class="card-footer border-top p-1">
                                        <div class="d-flex">
                                            <input type="hidden" name="id" id="id_client" value="<?= $_GET['num'] ?>">
                                            <input type="hidden" name="author" id="author" value="<?= $crea['name_crea'] ?>">
                                            <input type="text" name="content" id="content" class="form-control chat-message-demo mr-75" placeholder="Tapez votre message...">
                                            <button id="btn_submit" type="button" class="btn btn-primary glow px-1"><i class="bx bx-paper-plane"></i></button>
                                        </div>
                                    </div>
                            
                    </div>
                </div>

        </div>
    </div>
    <!-- END: Content-->

    
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