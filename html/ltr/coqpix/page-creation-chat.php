<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea'], PDO::PARAM_INT);
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
    <title>Mon espace - Chat</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky content-left-sidebar chat-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">
<style>

.red{color: red;}

</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-secondary navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="#">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name"><?= $crea['name_crea'] ?></span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
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
                                    <img src="../../../app-assets/images/ico/<?= $crea['img_crea'] ?>" alt="user_avatar" height="100" width="100">
                                </div>
                                <h5 class="mb-0"><?= $crea['name_crea'] ?></h5>
                            </div>
                        </header>
                        <div class="chat-user-profile-content">
                            <div class="chat-user-profile-scroll">
                                <h6 class="text-uppercase mb-1">A propos de vous</h6>
                                <p class="mb-2">Bonjour et bienvenue sur Coqpix vous etes actuellement en cours de création d'entreprise n'hésitez pas à nous contacter via l'espace chat pour plus de question .</p>
                                <h6>Information personnelle</h6>
                                <ul class="list-unstyled mb-2">
                                    <li class="mb-25"><?= $crea['email_crea'] ?></li>
                                    <li><?= $crea['tel_diri'] ?></li>
                                </ul>
                                <h6 class="text-uppercase mb-1">Paramètres</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-50 "><a href="page-creation-edit.php" class="d-flex align-items-center"><i class="bx bx-user mr-50"></i>
                                            Modifier mon profile</a></li>
                                    <li class="mb-50 "><a href="page-creation-document.php" class="d-flex align-items-center"><i class="bx bx-star mr-50"></i>
                                            Mes documents</a>
                                    </li>
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
                                        <div class="row">
                                            <div class="col-md-4">

                                                <div class="livicon-evo" onclick="retourn()" data-options=" name: arrow-left.svg; size: 30px " style="cursor: pointer; position: relative; top: 6px;"></div>

                                                <script>
                                                    function retourn() {
                                                        window.history.back();
                                                    }
                                                </script>
                                            </div>
                                            <div class="col-md-4 mr-auto">
                                                <img src="../../../app-assets/images/ico/<?= $crea['img_crea'] ?>" alt="user_avatar" height="36" width="36">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-sidebar-list-wrapper pt-0">
                            <h6 class="px-2 pt-2 pb-25 mb-0">CHATS</h6>
                            <ul class="chat-sidebar-list">
                                <li>
                                    <div id="notification" onclick="notif()" class="d-flex align-items-center">
                                        <?php
                                            if($crea['notification_crea'] > 0){
                                                $notification = 'avatar-status-busy'; 
                                            }else{
                                                $notification = ""; 
                                            }
                                        ?>
                                        <div class="avatar m-0 mr-50"><img src="../../../app-assets/images/ico/astro1.gif" height="36" width="36" alt="sidebar user image">
                                            <span class="<?php echo $notification; ?>"></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">Coqpix</h6><span class="text-muted">Support</span>
                                        </div>
                                    </div>
                                </li>
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
                                <h4 class="d-none d-lg-block py-50 text-bold-500">Sélectionnez un contact pour démarrer une discussion!</h4>
                                <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
                                    Conversation!</button>
                            </div>
                            <div class="chat-area d-none">
                                <div class="chat-header">
                                    <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-75">
                                        <div class="d-flex align-items-center">
                                            <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="bx bx-menu font-large-1 cursor-pointer"></i>
                                            </div>
                                            <div class="avatar chat-profile-toggle m-0 mr-1">
                                                <img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="36" width="36" />
                                                <span class="avatar-status-busy"></span>
                                            </div>
                                            <h6 class="mb-0">Coqpix</h6>
                                        </div>
                                    </header>
                                </div>
                                <!-- chat card start -->
                                <div class="card chat-wrapper shadow-none">
                                    <div class="card-content">
                                        <div class="card-body chat-container">
                                            <div class="chat-content">
                                                <div class="chat chat-left">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>Bonjour et bienvenue, n'hésite pas à nous envoyer un petit message.</p>
                                                            <?php $dateactuelle = date("H:i"); ?>
                                                            <span class="chat-time"><?= $dateactuelle; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer chat-footer border-top px-2 pt-1 pb-0 mb-1">
                                        <div class="d-flex align-items-center">
                                            <input type="hidden" name="id" id="id_client" value="<?= $_SESSION['id_crea'] ?>">
                                            <input type="hidden" name="author" id="author" value="<?= $crea['name_crea'] ?>">
                                            <input type="text" name="content" id="content" class="form-control chat-message-send mx-1" placeholder="Tapez votre message ici...">
                                            <button type="button" id="btn_submit" class="btn btn-primary glow send d-lg-flex"><i class="bx bx-paper-plane"></i>
                                            <span class="d-none d-lg-block ml-1">Envoyer</span></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- chat card ends -->
                            </div>
                        </section>
                        <!-- app chat window ends -->
                        <!-- app chat profile right sidebar start -->
                        <section class="chat-profile">
                            <header class="chat-profile-header text-center border-bottom">
                                <span class="chat-profile-close">
                                    <i class="bx bx-x"></i>
                                </span>
                                <div class="my-2">
                                    <div class="avatar">
                                        <img src="../../../app-assets/images/ico/astro1.gif" alt="chat avatar" height="100" width="100">
                                    </div>
                                    <h5 class="app-chat-user-name mb-0">Pix</h5>
                                    <span>Astonaute</span>
                                </div>
                            </header>
                            <div class="chat-profile-content p-2">
                                <h6 class="mt-1">A propos de nous</h6>
                                <p>Bonjour, nous vous souhaitons bienvenue sur Coqpix l'interface qui va vous facilite la vie.</p>
                                <h6 class="mt-2">Information de contact</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-25">contact@auditactionplus.com</li>
                                    <li>+336 00 00 00 00</li>
                                </ul>
                            </div>
                        </section>
                        <!-- app chat profile right sidebar ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        function notif(){
            const notification_crea = '0';
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', '../../../../html/ltr/coqpix/php/chat_notif.php');
            requeteAjax.send(notification_crea);
        }
    </script>

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

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
    <script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
    <script src="../../../app-assets/js/scripts/pages/chat_crea_user.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>