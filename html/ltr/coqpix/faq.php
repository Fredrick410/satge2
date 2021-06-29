<?php 
include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $pdoS->execute();
    $entreprise = $pdoS->fetch();

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>FAQ - Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/ui/plyr.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/swiper.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/faq.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">
<style>
    .none-validation{display: none;}
</style>
    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <section class="faq-search">
                <div class="row">
                    <div class="col-12">
                        <div class="card faq-bg bg-transparent box-shadow-0 p-1 p-md-5">
                            <div class="card-content">
                                <div class="card-body p-0">
                                    <h1 class="faq-title text-center mb-3">Bonjour, comment pouvons-nous vous aider? (SOON)</h1>
                                    <form>
                                        <fieldset class="faq-search-width form-group position-relative w-50 mx-auto">
                                            <input disabled type="text" class="form-control round form-control-lg shadow pl-2" id="searchbar" placeholder="Poser une question...">
                                            <button class="btn btn-primary round position-absolute d-none d-sm-block" type="button">Envoyer</button>
                                            <button class="btn btn-primary round position-absolute d-block d-sm-none" type="button"><i class="bx bx-search"></i></button>
                                        </fieldset>
                                    </form>
                                    <center><small class="card-text text-center mt-3 font-medium-1 text-muted text-center">
                                        Poser votre question Pix vous répondra le plus rapidement possible !</small></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_one">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°1 - Données</h6>
                            <div class="video-player" id="">
                                <iframe src="https://www.youtube.com/embed/gxPvRVyjGjE"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_two">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°2 - Ventes</h6>
                            <div class="video-player" id="">
                                <iframe src="https://www.youtube.com/embed/km6iSYtbojo"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_three">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°3 - Achats</h6>
                            <div class="video-player" id="">
                                <!-- <iframe src="https://www.youtube.com/embed/km6iSYtbojo"></iframe> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_four">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°4 -  Déclarations</h6>
                            <div class="video-player" id="">
                                <iframe src="https://www.youtube.com/watch?v=sbEMIxrHuOo"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_five">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°5 - Cloudpix</h6>
                            <div class="video-player" id="">
                                <iframe src="https://www.youtube.com/watch?v=S-a6VKEYuCE"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_six">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°6 - Outils</h6>
                            <div class="video-player" id="">
                                <iframe src="hhttps://www.youtube.com/watch?v=O6aeQJ0qXSU"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_six_one">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°6.1 - Outils (I love PDF)</h6>
                            <div class="video-player" id="">
                                <iframe src="https://www.youtube.com/watch?v=aFOWqkRO7kk"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="none-validation" id="video_six_two">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <h6>Tuto N°6.2 - Outils (I love IMG)</h6>
                            <div class="video-player" id="">
                                <iframe src="https://www.youtube.com/watch?v=8DAMB1hJ820"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- coverflow effect swiper start -->
            <section id="component-swiper-coverflow">
                <div class="card ">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="swiper-coverflow swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"> <label>Tuto N°1 - Données</label><iframe src="https://www.youtube.com/embed/gxPvRVyjGjE"></iframe>
                                    </div>
                                    <div class="swiper-slide"> <label>Tuto N°2 - Ventes</label><iframe src="https://www.youtube.com/embed/km6iSYtbojo"></iframe>
                                    </div>
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <!-- coverflow effect swiper ends -->
            <section id="media-player-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <div class="form-group">
                                <h4>Nos tutoriels</h4>
                            </div>
                            <div class="form-group">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <!-- timeline widget start -->
                                            <ul class="widget-timeline">
                                                <li class="timeline-items timeline-icon-danger active">
                                                    <h6 class="timeline-title">Tuto N°1 - Les données</h6>
                                                    <div class="timeline-content">
                                                        Le tutoriel données va vous permettre d'apprendre comment gérer les auto-completions et l'optimisation de coqpix 🙂&nbsp&nbsp
                                                        <button onclick="bt_one()" type="button" style="display: inline; position: relative; top: 8px;" class="btn btn-outline-danger mr-1 mb-1"><span class="align-middle ml-25">Voir</span></button>
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning active">
                                                    <h6 class="timeline-title">Tuto N°2 - Ventes</h6>
                                                    <div class="timeline-content">
                                                        Après avoir vu la vidéo la création de devis, facture etc . ne sera plus un problème...🌸&nbsp&nbsp
                                                        <button onclick="bt_two()" type="button" style="display: inline; position: relative; top: 8px;" class="btn btn-outline-warning mr-1 mb-1"><span class="align-middle ml-25">Voir</span></button>
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning active">
                                                    <h6 class="timeline-title">Tuto N°3 - Achats</h6>
                                                    <div class="timeline-content">
                                                        Non disponible&nbsp&nbsp
                                                        <button onclick="bt_two()" type="button" style="display: inline; position: relative; top: 8px;" class="btn btn-outline-warning mr-1 mb-1"><span class="align-middle ml-25">Voir</span></button>
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning active">
                                                    <h6 class="timeline-title">Tuto N°4 - Déclarations</h6>
                                                    <div class="timeline-content">
                                                        Dans l'espace déclaration géraient vos documents sociaux ou fiscaux en quelques secondes ...🤞&nbsp&nbsp
                                                        <button onclick="bt_four()" type="button" style="display: inline; position: relative; top: 8px;" class="btn btn-outline-warning mr-1 mb-1"><span class="align-middle ml-25">Voir</span></button>
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning active">
                                                    <h6 class="timeline-title">Tuto N°5 - Cloudpix</h6>
                                                    <div class="timeline-content">
                                                        Envoyer vos documents a votre comptable via cloudpix ...☁️&nbsp&nbsp
                                                        <button onclick="bt_five()" type="button" style="display: inline; position: relative; top: 8px;" class="btn btn-outline-warning mr-1 mb-1"><span class="align-middle ml-25">Voir</span></button>
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning active">
                                                    <h6 class="timeline-title">Tuto N°6 - Outis</h6>
                                                    <div class="timeline-content">
                                                        Nous vous mettons à disposition des outils pour gérer vos documents...🔨&nbsp&nbsp
                                                        <button onclick="bt_six()" type="button" style="display: inline; position: relative; top: 8px;" class="btn btn-outline-warning mr-1 mb-1"><span class="align-middle ml-25">Voir</span></button>
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning active">
                                                    <h6 class="timeline-title">Tuto N°6.1 - Outils(I Love PDF)</h6>
                                                    <div class="timeline-content">
                                                        I love PDF, va vous permettre de fusionner, diviser vos pdf ...✂️&nbsp&nbsp
                                                    </div>
                                                </li>
                                                <li class="timeline-items timeline-icon-warning active">
                                                    <h6 class="timeline-title">Tuto N°6.2 - Outils(I Love IMG)</h6>
                                                    <div class="timeline-content">
                                                        I love IMG, des images pleines d'amours...📷&nbsp&nbsp
                                                        <button onclick="bt_six_two()" type="button" style="display: inline; position: relative; top: 8px;" class="btn btn-outline-warning mr-1 mb-1"><span class="align-middle ml-25">Voir</span></button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
    <script src="../../../app-assets/vendors/js/ui/plyr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/extensions/ext-component-media-player.js"></script>
    <script src="../../../app-assets/js/scripts/pages/faq.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/swiper.js"></script>
    <!-- END: Page JS-->
    
    <script>
        function bt_one(){
            document.getElementById('video_one').style.display = "block";
            document.getElementById('video_two').style.display = "none";
            document.getElementById('video_four').style.display = "none";
            document.getElementById('video_five').style.display = "none";
            document.getElementById('video_six').style.display = "none";
            document.getElementById('video_six_one').style.display = "none";
            document.getElementById('video_six_two').style.display = "none";
            document.getElementById('component-swiper-coverflow').style.display = "none"; 
        }
        function bt_two(){
            document.getElementById('video_one').style.display = "none";
            document.getElementById('video_two').style.display = "block";
            document.getElementById('video_four').style.display = "none";
            document.getElementById('video_five').style.display = "none";
            document.getElementById('video_six').style.display = "none";
            document.getElementById('video_six_one').style.display = "none";
            document.getElementById('video_six_two').style.display = "none";
            document.getElementById('component-swiper-coverflow').style.display = "none";
        }
        function bt_four(){
            document.getElementById('video_one').style.display = "none";
            document.getElementById('video_two').style.display = "none";
            document.getElementById('video_four').style.display = "block";
            document.getElementById('video_five').style.display = "none";
            document.getElementById('video_six').style.display = "none";
            document.getElementById('video_six_one').style.display = "none";
            document.getElementById('video_six_two').style.display = "none";
            document.getElementById('component-swiper-coverflow').style.display = "none";
        }
        function bt_five(){
            document.getElementById('video_one').style.display = "none";
            document.getElementById('video_two').style.display = "none";
            document.getElementById('video_four').style.display = "none";
            document.getElementById('video_five').style.display = "block";
            document.getElementById('video_six').style.display = "none";
            document.getElementById('video_six_one').style.display = "none";
            document.getElementById('video_six_two').style.display = "none";
            document.getElementById('component-swiper-coverflow').style.display = "none";
        }
        function bt_six(){
            document.getElementById('video_one').style.display = "none";
            document.getElementById('video_two').style.display = "none";
            document.getElementById('video_four').style.display = "none";
            document.getElementById('video_five').style.display = "none";
            document.getElementById('video_six').style.display = "block";
            document.getElementById('video_six_one').style.display = "none";
            document.getElementById('video_six_two').style.display = "none";
            document.getElementById('component-swiper-coverflow').style.display = "none";
        }
        function bt_six_one(){
            document.getElementById('video_one').style.display = "none";
            document.getElementById('video_two').style.display = "none";
            document.getElementById('video_four').style.display = "none";
            document.getElementById('video_five').style.display = "none";
            document.getElementById('video_six').style.display = "none";
            document.getElementById('video_six_one').style.display = "block";
            document.getElementById('video_six_two').style.display = "none";
            document.getElementById('component-swiper-coverflow').style.display = "none";
        }
        function bt_six_two(){
            document.getElementById('video_one').style.display = "none";
            document.getElementById('video_two').style.display = "none";
            document.getElementById('video_four').style.display = "none";
            document.getElementById('video_five').style.display = "none";
            document.getElementById('video_six').style.display = "none";
            document.getElementById('video_six_one').style.display = "none";
            document.getElementById('video_six_two').style.display = "block";
            document.getElementById('component-swiper-coverflow').style.display = "none";
        }
    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>