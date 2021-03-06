<?php 
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $select_entreprise = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $select_entreprise->bindValue(':num',$_SESSION['id']);
    $select_entreprise->execute();
    $entreprise = $select_entreprise->fetch();
    
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Helpdesk - Chat</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-sticky content-left-sidebar chat-application footer-static" data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-success navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="#">
                    <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/chatpix4.png"></div>
                </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav bookmark-icons">                          
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="dashboard-analytics.php" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name">Support</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/chatpix3.png" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <!-- app chat user profile left sidebar start -->
                    <div class="chat-user-profile">
                        <header class="chat-user-profile-header text-center border-bottom">
                            <span class="chat-profile-close">
                                <i class="bx bx-x"></i>
                            </span>
                            <div class="my-2">
                                <div class="avatar">
                                    <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="user_avatar" height="100" width="100">
                                </div>
                                <h5 class="mb-0"><?= $entreprise['nameentreprise'] ?></h5>
                                <span><?= $entreprise['descr_entreprise'] ?></span>
                            </div>
                        </header>
                        <div class="chat-user-profile-content">
                            <div class="chat-user-profile-scroll">
                                <h6>DIRIGEANT</h6>
                                <p class="mb-2">Nom : <?= $entreprise['nom_diri'] ?><br>Prénom : <?= $entreprise['prenom_diri'] ?></p>
                                <h6>INFORMATIONS PERSONNELLES</h6>
                                <ul class="list-unstyled mb-2">
                                    <li class="mb-25"><?= $entreprise['emailentreprise'] ?></li>
                                    <li><?= $entreprise['telentreprise'] ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- app chat user profile left sidebar ends -->
                    <!-- app chat sidebar start -->
                    <div class="chat-sidebar card">
                        <span class="chat-sidebar-close">
                            <i class="bx bx-x"></i>
                        </span>
                        <div class="chat-sidebar-search">
                            <div class="d-flex align-items-center">
                                <div class="chat-sidebar-profile-toggle">
                                    <div class="avatar">
                                        <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="loading" height="36" width="36">
                                    </div>
                                </div>
                                <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
                                    <input type="text" class="form-control round" id="chat-search" placeholder="Rechercher">
                                    <div class="form-control-position">
                                        <i class="bx bx-search-alt text-dark"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="chat-sidebar-list-wrapper">
                            <h6 class="px-2 pt-2">CHAT INTRA-ENTREPRISE<i id="creer_channel" class="bx bx-plus float-right cursor-pointer"></i></h6>
                            <ul class="liste-channels chat-sidebar-list">
                                
                            </ul>
                            <ul class="liste-membres chat-sidebar-list">
         
                            </ul>
                            <h6 class="px-2 pt-2">SUPPORT</h6>
                            <div class="m-1">
                                <button id="btn_demande_req" type="button" class="btn btn-primary btn-block compose-btn">
                                    <i class="bx bx-plus"></i>
                                    Envoyer une requête
                                </button>
                            </div>
                            <ul class="liste-tickets chat-sidebar-list">

                            </ul>
                        </div>
                    </div>
                    <!-- app chat sidebar ends -->
                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- app chat overlay -->
                        <div class="chat-overlay"></div>
                        <!-- app chat window start -->
                        <section class="chat-window-wrapper">
                            <div class="chat-start">
                                <span class="bx bx-message chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                                <h4 class="d-none d-lg-block py-50 text-bold-500">Sélectionnez un contact pour démarrer un chat !</h4>
                                <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
                                    Conversation!
                                </button>
                            </div>
                            <div class="chat-area d-none">
                                <div class="chat-header" style="background-color: #FFFFFF;">
                                    <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-75" style="height: 59.5px;">
                                        <div class="d-flex align-items-center">
                                            <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="bx bx-menu font-large-1 cursor-pointer"></i>
                                            </div>
                                            <div id="image_chat" class="avatar m-0 mr-1">           
                                            </div>
                                            <h6 id="nom_chat" class="mb-0"></h6>
                                            <input id ="id_chat" type="hidden" value=""> 
                                        </div>
                                        <div id="icons_channel" class="chat-header-icons" style="display: none;">
                                            <i id="get_membres_not_in_channel" class="bx bx-user-plus font-medium-5 cursor-pointer mr-50"></i>
                                            <i id="get_membres_channel" class="bx bxs-user-detail font-medium-5 cursor-pointer"></i>                
                                        </div>
                                    </header>
                                </div>
                                <!-- chat card start -->
                                <div class="card chat-wrapper shadow-none">
                                    <div class="card-content">
                                        <div class="card-body chat-container">
                                            <div class="chat-content">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer chat-footer border-top px-2 pt-1 pb-0 mb-1">
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-face cursor-pointer"></i>
                                            <i class="bx bx-paperclip ml-1 cursor-pointer"></i>
                                            <!-- ID de l'utilisateur connecté -->
                                            <input type="hidden" id="id_session" value="<?= $_SESSION['id_membre'] ?>">
                                            <!-- ID de l'entreprise de l'utilisateur -->
                                            <input type="hidden" id="id" value="<?= $_SESSION['id'] ?>">
                                            <?php if (isset($_GET['req']) && !empty($_GET['req'])) { ?>
                                                <!-- Variable GET permettant de savoir que l'on vient de créer un ticket et qu'il faut l'ouvrir -->
                                                <input type="hidden" id="req" value="<?= $_GET['req'] ?>">
                                            <?php } ?>
                                            <!-- Variable permettant de savoir que l'on est dans le front -->
                                            <input type="hidden" id="auteur" value="user">
                                            <!-- Variable permettant de savoir dans quel chat on se situe (Channel, Chat privé, Support)
                                            afin de charger les messages correspondants -->
                                            <input type="hidden" id="type_chat" value="">
                                            <!-- Texte du message -->
                                            <input type="text" id="texte" class="form-control chat-message-send mx-1" placeholder="Tapez votre message ici...">
                                            <button type="submit" class="btn-envoyer-msg btn btn-primary glow send d-lg-flex"><i class="bx bx-paper-plane"></i>
                                            <span class="d-none d-lg-block ml-1">Envoyer</span></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- chat card ends -->
                            </div>
                        </section>
                        <!-- app chat window ends -->
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
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
    <script src="../../../app-assets/js/scripts/pages/chat_support.js"></script>
    <script src="../../../app-assets/js/scripts/pages/chat_interne.js"></script>
    <!-- END: Page JS-->

    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>