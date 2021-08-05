<?php 
require_once 'php/verif_session_connect_admin.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    if (isset($_GET['id_ticket']) && !empty($_GET['id_ticket'])) {
        $select_ticket = $bdd->prepare('SELECT S.objet, upper(S.statut) AS statut, M.nom, M.prenom FROM support_ticket S, membres M WHERE S.id_ticket = :id_ticket AND M.id = S.id_membre');
        $select_ticket->bindValue(':id_ticket', $_GET['id_ticket']);
        $select_ticket->execute();
        $infos_ticket = $select_ticket->fetch();
    }

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Chat'Pix Support - Coqpix</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/dragula.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-todo.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        .row-ticket:hover {
            box-shadow: 3px 3px red, -1em 0 0.4em olive;
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky content-left-sidebar todo-application chat-application footer-static" data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

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
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="helpdesk-tickets-support.php" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
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
                    <div class="todo-sidebar d-flex">
                        <span class="sidebar-close-icon">
                            <i class="bx bx-x"></i>
                        </span>
                        <!-- todo app menu -->
                        <div class="todo-app-menu">
                            <!-- sidebar list start -->
                            <div class="sidebar-menu-list">
                                <div class="list-group">
                                    <a href="javascript:void(0);" class="all-tickets list-group-item border-0 active">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: list.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent;"></i>
                                        </span>
                                        <span> Tous</span>
                                    </a>
                                </div>
                                <label class="filter-label mt-2 mb-1 pt-25">Filters</label>
                                <div class="list-group">
                                    <a href="javascript:void(0);" class="filtre-non-lu list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: bell.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span> Non lu</span>
                                    </a>
                                    <a href="javascript:void(0);" class="filtre-ouvert list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: comments.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span> Ouvert</span>
                                    </a>
                                    <a href="javascript:void(0);" class=" filtre-fermé list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: lock.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span> Fermé</span>
                                    </a>
                                </div>
                                <label class="filter-label mt-2 mb-1 pt-25">Labels</label>
                                <div class="list-group">
                                    <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                        <span>Général</span>
                                        <span class="bullet bullet-sm bullet-light"></span>
                                    </a>
                                    <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                        <span>Comptabilité</span>
                                        <span class="bullet bullet-sm" style="background-color: yellow;"></span>
                                    </a>
                                    <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                        <span>Juridique</span>
                                        <span class="bullet bullet-sm bullet-danger"></span>
                                    </a>
                                    <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                        <span>Fiscalité</span>
                                        <span class="bullet bullet-sm bullet-warning"></span>
                                    </a>
                                    <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                        <span>Social</span>
                                        <span class="bullet bullet-sm bullet-info"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- sidebar list end -->
                        </div>
                    </div>
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
                            <div class="chat-area d-block">
                                <div class="chat-header" style="background-color: #FFFFFF">
                                    <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-75">
                                        <div class="d-flex align-items-center">
                                            <a href="helpdesk-tickets-support" class="mr-50">
                                                <span class="fonticon-wrap d-inline">
                                                    <i class="livicon-evo" data-options="name: chevron-left.svg; size: 32px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                    </i>
                                                </span>
                                            </a>
                                            <h6 id="objet_ticket" class="mb-0"><?= $infos_ticket['objet'] ?><i class="bx bx-user mx-1"></i><small><?= $infos_ticket['nom'].' '.$infos_ticket['prenom'] ?></small></h6>
                                            <div id="statut_ticket">             
                                                <span id="statut" class="badge badge-light-<?php if ($infos_ticket['statut'] == "OUVERT") { echo "success"; } else { echo "danger"; } ?> badge-pill ml-1"><?= $infos_ticket['statut'] ?></span>
                                            </div>
                                        </div>
                                        <div class="chat-header-icons">
                                            <span class="chat-icon-favorite">
                                                <i class="bx bx-star font-medium-5 cursor-pointer"></i>
                                            </span>
                                            <span class="dropdown">
                                                <i class="bx bx-dots-vertical-rounded font-medium-4 ml-25 cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                </i>
                                                <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a id="fermer_ticket" class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-lock mr-50"></i> Fermer</a>
                                                    <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-trash mr-50"></i> Effacer</a>
                                                    <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-block mr-50"></i> Bloquer</a>
                                                </span>
                                            </span>
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
                                            <?php
                                            if (isset($_GET['id_ticket']) && !empty($_GET['id_ticket'])) { ?>
                                                <input type="hidden" id="id_ticket" value="<?= $_GET['id_ticket'] ?>">
                                                <?php
                                                $query = $bdd->prepare('SELECT id_membre FROM support_ticket WHERE id_ticket = :id_ticket');
                                                $query->bindValue('id_ticket', $_GET['id_ticket']);
                                                $query->execute();
                                                $result = $query->fetch(); ?>
                                                <input type="hidden" id="id_membre" value="<?= $result['id_membre'] ?>">
                                            <?php
                                            } ?>
                                            <input type="hidden" id="auteur" value="support">
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
    <script src="../../../app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dragula.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-todo.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
    <script src="../../../app-assets/js/scripts/pages/chat_support.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>