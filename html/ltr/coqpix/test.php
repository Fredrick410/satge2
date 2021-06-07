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

    if($crea['status_crea'] == "EURL"){
            $linkview = "morale";
    }else{        
        if($crea['status_crea'] == "SARL"){
            $linkview = "morale";
        }else{
            if($crea['status_crea'] == "SAS"){
                $linkview = "morale";
            }else{
                if($crea['status_crea'] == "SASU"){
                    $linkview = "morale";
                }else{
                    if($crea['status_crea'] == "SCI"){
                        $linkview = "morale";
                    }else{
                        if($crea['status_crea'] == "EIRL"){
                            $linkview = "physique";
                        }else{
                            if($crea['status_crea'] == "Micro-entreprise"){
                                $linkview = "physique";
                            }else{
                                $linkview = "physique";
                            }
                        }
                    }
                }
            }
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
    <title>Mon espace</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/swiper.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/faq.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
.none-validation{display: none;}
.block-validation{display: block;}
.red{color: red;}
.handpointer{cursor: pointer;}
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
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section id="bg-variants">
                    <div class="row text-center">
                        <div class="col-12 mt-3 mb-1">
                            <img src="../../../src/img/img_crea.png" width="" height="" class="img-fluid" alt="Responsive image">
                        </div>
                    </div>
                    <div class="form-group">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card handpointer" onclick="document.location.href='page-creation-edit.php'">
                                <div class="card-content">
                                    <div class="row no-gutters">
                                        <div class="col-md-12 col-lg-4">
                                            <img src="../../../app-assets/images/banner/banner-35.jpg" alt="element 01" class="h-100 w-100 rounded-left">
                                        </div>
                                        <div class="col-md-12 col-lg-8">
                                            <div class="card-body">
                                                <h5>Mon profile</h5>
                                                <p class="card-text text-ellipsis">
                                                    Dans votre profile vous aurez la possibilité de choisir votre forme juridique après avoir consulté un conseiller
                                                </p>
                                                <hr>
                                                <span>Votre future entreprise est une <?= $crea['status_crea'] ?></span>
                                                <hr>
                                                <small>😁 Pix vous souhaite bonne chance pour votre création d'entreprise !!!</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 <?php if($crea['status_crea'] == ""){echo "none-validation";} ?>">
                            <div class="card bg-light bg-lighten-1 handpointer" onclick="document.location.href='creation-view-<?= $linkview ?>-pieceid.php'">
                                <div class="card-content">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 col-md-12 d-flex align-items-center justify-content-center p-1">
                                            <img src="../../../app-assets/images/elements/apple-lap.png" class="card-img img-fluid" alt="apple-lap.png">
                                        </div>
                                        <div class="col-lg-8 col-md-12">
                                            <div class="card-body text-center">
                                                <h4 class="card-title white">Mes documents</h4>
                                                <p class="card-text white">Importer vos documents.</p>
                                                <button class="btn btn-secondary">Go</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="card handpointer" onclick="document.location.href='page-creation-chat.php'">
                                <div class="card-content">
                                    <div class="row no-gutters">
                                        <div class="col-lg-8 col-12">
                                            <div class="card-body">
                                                <h5>Chat'Pix</h5>
                                                <p class="card-text">
                                                    Envoyer un message à Pix il vous repondra le plus rapidement possible. <br>
                                                    Le chat va vous permettre de poser des questions et vous renseignez d'avantage sur votre création d'entreprise.
                                                </p>
                                                <button class="btn btn-info">Chatter</button><br>
                                                <small>Vous avez <?php if($crea['notification_crea'] == ""){echo "0";}else{echo $crea['notification_crea'];} ?> messages</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <img src="../../../app-assets/images/banner/banner-30.jpg" alt="element 01" class="h-100 w-100 rounded-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Background variants section end -->
                <!-- faq start -->
                <section class="faq ">
                    <div class="row">
                        <div class="col-12">
                            <!-- swiper start -->
                            <div class="card bg-transparent shadow-none">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="swiper-centered-slides swiper-container p-1">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide rounded swiper-shadow" id="getting-text"> <i class="bx bx-flag mb-1 font-large-1"></i>
                                                    <div class="cent-text1">Commencer</div>
                                                </div>
                                                <div class="swiper-slide rounded swiper-shadow" id="pricing-text"> <i class="bx bx-dollar-circle mb-1 font-large-1"></i>
                                                    <div class="cent-text1">Tarifs et plans</div>
                                                </div>
                                                <div class="swiper-slide rounded swiper-shadow" id="sales-text"> <i class="bx bx-shopping-bag mb-1 font-large-1"></i>
                                                    <div class="cent-text1">Question de vente</div>
                                                </div>
                                                <div class="swiper-slide rounded swiper-shadow" id="usage-text"> <i class="bx bx-book-open mb-1 font-large-1"></i>
                                                    <div class="cent-text1">Guides d'utilisation</div>
                                                </div>
                                                <div class="swiper-slide rounded swiper-shadow" id="general-text"> <i class="bx bx-info-circle mb-1 font-large-1"></i>
                                                    <div class="cent-text1">Guide général</div>
                                                </div>
                                            </div>
                                            <!-- Add Arrows -->
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                        <div class="main-wrapper-content">
                                            <div class="wrapper-content" data-faq="getting-text">
                                                <div class="text-center p-md-4 p-sm-1 py-1 p-0">
                                                    <h1 class="faq-title">Getting Started</h1>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam reprehenderit alias voluptas aspernatur
                                                        maiores
                                                        quis molestiae totam deserunt exercitationem ipsam officiis nisi, labore magni, commodi quaerat quia
                                                        earum
                                                        quas illo ea amet minus ad dolor?</p>
                                                </div>
                                                <!-- accordion start -->
                                                <div id="accordion-icon-wrapper1" class="collapse-icon accordion-icon-rotate">
                                                    <div class="accordion" id="accordionWrapar2">
                                                        <div class="card collapse-header">
                                                            <div id="heading5" class="card-header" data-toggle="collapse" role="button" data-target="#accordion5" aria-expanded="false" aria-controls="accordion5">
                                                                <span class="collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Purchasing process?
                                                                </span>
                                                            </div>
                                                            <div id="accordion5" role="tabpanel" data-parent="#accordionWrapar2" aria-labelledby="heading5" class="collapse">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Cheesecake cotton candy bonbon muffin cupcake tiramisu croissant. Tootsie roll sweet candy
                                                                        bear
                                                                        claw chupa chups lollipop toffee. Macaroon donut liquorice powder candy carrot cake macaroon
                                                                        fruitcake. Cookie toffee lollipop cotton candy ice cream dragée soufflé.
                                                                        Cake tiramisu lollipop wafer pie soufflé dessert tart. Biscuit ice cream pie apple pie topping
                                                                        oat cake dessert. Soufflé icing caramels. Chocolate cake icing ice cream macaroon pie
                                                                        cheesecake
                                                                        liquorice apple pie. <br> <br> Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                                        Voluptates
                                                                        alias
                                                                        architecto ullam? Ratione, vitae, amet corrupti non unde praesentium laborum incidunt fugit
                                                                        vel illo
                                                                        debitis
                                                                        dicta illum fugiat, at consequatur! Voluptatum sunt dolorem at deleniti dolor quis a nam
                                                                        facilis.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading6" class="card-header" data-toggle="collapse" role="button" data-target="#accordion66" aria-expanded="false" aria-controls="accordion66">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure are your payment?
                                                                </span>
                                                            </div>
                                                            <div id="accordion66" role="tabpanel" data-parent="#accordionWrapar2" aria-labelledby="heading6" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.
                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading17" class="card-header" data-toggle="collapse" role="button" data-target="#accordion71" aria-expanded="false" aria-controls="accordion71">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How to apply for a prepaid card?
                                                                </span>
                                                            </div>
                                                            <div id="accordion71" role="tabpanel" data-parent="#accordionWrapar2" aria-labelledby="heading17" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Gingerbread liquorice liquorice cake muffin lollipop powder chocolate cake. Gummi bears lemon
                                                                        drops toffee liquorice pastry cake caramels chocolate bar brownie. Sweet biscuit chupa chups
                                                                        sweet.
                                                                        Halvah fruitcake gingerbread croissant dessert cupcake. Chupa chups chocolate bar donut tart.
                                                                        Donut cake dessert cookie. Ice cream tootsie roll powder chupa chups pastry cupcake soufflé.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading81" class="card-header" data-toggle="collapse" role="button" data-target="#accordion801" aria-expanded="false" aria-controls="accordion801">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure is my data in App?
                                                                </span>
                                                            </div>
                                                            <div id="accordion801" role="tabpanel" data-parent="#accordionWrapar2" aria-labelledby="heading81" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Icing sweet roll cotton candy brownie candy canes candy canes. Pie jelly dragée pie. Ice cream
                                                                        jujubes wafer. Wafer croissant carrot cake wafer gummies gummies chupa chups halvah bonbon.
                                                                        Gummi bears cotton candy jelly-o halvah. Macaroon apple pie dragée bonbon marzipan cheesecake.
                                                                        Jelly jelly beans marshmallow.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading91" class="card-header" data-toggle="collapse" role="button" data-target="#accordion125" aria-expanded="false" aria-controls="accordion125">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How do I know latest version?
                                                                </span>
                                                            </div>
                                                            <div id="accordion125" role="tabpanel" data-parent="#accordionWrapar2" aria-labelledby="heading91" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.
                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading103" class="card-header" data-toggle="collapse" role="button" data-target="#accordion142" aria-expanded="false" aria-controls="accordion142">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Download documentation
                                                                </span>
                                                            </div>
                                                            <div id="accordion142" role="tabpanel" data-parent="#accordionWrapar2" aria-labelledby="heading103" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.
                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading113" class="card-header" data-toggle="collapse" role="button" data-target="#accordion91" aria-expanded="false" aria-controls="accordion91">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure my personal info?
                                                                </span>
                                                            </div>
                                                            <div id="accordion91" role="tabpanel" data-parent="#accordionWrapar2" aria-labelledby="heading113" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.
                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Accordion end -->
                                            </div>
                                            <div class="wrapper-content" data-faq="pricing-text">
                                                <div class="text-center p-md-4 p-sm-1 py-1 p-0">
                                                    <h1 class="faq-title">Pricing & Planes</h1>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam reprehenderit alias voluptas aspernatur
                                                        maiores
                                                        quis molestiae totam deserunt exercitationem ipsam officiis nisi, labore magni, commodi quaerat quia
                                                        earum
                                                        quas illo ea amet minus ad dolor?</p>
                                                </div>
                                                <!-- accordion start -->
                                                <div id="accordion-icon-wrapper2" class="collapse-icon accordion-icon-rotate">

                                                    <div class="accordion" id="accordionWrapar3">
                                                        <div class="card collapse-header">
                                                            <div id="heading27" class="card-header" data-toggle="collapse" role="button" data-target="#accordion16" aria-expanded="false" aria-controls="accordion16">
                                                                <span class="collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    What are your Purchasing process?
                                                                </span>
                                                            </div>
                                                            <div id="accordion16" role="tabpanel" data-parent="#accordionWrapar3" aria-labelledby="heading27" class="collapse">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Cheesecake cotton candy bonbon muffin cupcake tiramisu croissant. Tootsie roll sweet candy
                                                                        bear
                                                                        claw chupa chups lollipop toffee. Macaroon donut liquorice powder candy carrot cake macaroon
                                                                        fruitcake. Cookie toffee lollipop cotton candy ice cream dragée soufflé.
                                                                        Cake tiramisu lollipop wafer pie soufflé dessert tart. Biscuit ice cream pie apple pie topping
                                                                        oat cake dessert. Soufflé icing caramels. Chocolate cake icing ice cream macaroon pie
                                                                        cheesecake
                                                                        liquorice apple pie. <br> <br> Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                                        Voluptates
                                                                        alias
                                                                        architecto ullam? Ratione, vitae, amet corrupti non unde praesentium laborum incidunt fugit
                                                                        vel illo
                                                                        debitis
                                                                        dicta illum fugiat, at consequatur! Voluptatum sunt dolorem at deleniti dolor quis a nam
                                                                        facilis.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading82" class="card-header" data-toggle="collapse" role="button" data-target="#accordion26" aria-expanded="false" aria-controls="accordion26">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How rarely our information gets?
                                                                </span>
                                                            </div>
                                                            <div id="accordion26" role="tabpanel" data-parent="#accordionWrapar3" aria-labelledby="heading82" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading37" class="card-header" data-toggle="collapse" role="button" data-target="#accordion72" aria-expanded="false" aria-controls="accordion72">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How to apply for a unknown card?
                                                                </span>
                                                            </div>
                                                            <div id="accordion72" role="tabpanel" data-parent="#accordionWrapar3" aria-labelledby="heading37" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Gingerbread liquorice liquorice cake muffin lollipop powder chocolate cake. Gummi bears lemon
                                                                        drops toffee liquorice pastry cake caramels chocolate bar brownie. Sweet biscuit chupa chups
                                                                        sweet.

                                                                        Halvah fruitcake gingerbread croissant dessert cupcake. Chupa chups chocolate bar donut tart.
                                                                        Donut cake dessert cookie. Ice cream tootsie roll powder chupa chups pastry cupcake soufflé.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading83" class="card-header" data-toggle="collapse" role="button" data-target="#accordion802" aria-expanded="false" aria-controls="accordion802">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure is data and info in App?
                                                                </span>
                                                            </div>
                                                            <div id="accordion802" role="tabpanel" data-parent="#accordionWrapar3" aria-labelledby="heading83" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Icing sweet roll cotton candy brownie candy canes candy canes. Pie jelly dragée pie. Ice cream
                                                                        jujubes wafer. Wafer croissant carrot cake wafer gummies gummies chupa chups halvah bonbon.

                                                                        Gummi bears cotton candy jelly-o halvah. Macaroon apple pie dragée bonbon marzipan cheesecake.
                                                                        Jelly jelly beans marshmallow.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading92" class="card-header" data-toggle="collapse" role="button" data-target="#accordion121" aria-expanded="false" aria-controls="accordion121">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How do I know about midest version?
                                                                </span>
                                                            </div>
                                                            <div id="accordion121" role="tabpanel" data-parent="#accordionWrapar3" aria-labelledby="heading92" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading104" class="card-header" data-toggle="collapse" role="button" data-target="#accordion143" aria-expanded="false" aria-controls="accordion143">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Download offline documentation works?
                                                                </span>
                                                            </div>
                                                            <div id="accordion143" role="tabpanel" data-parent="#accordionWrapar3" aria-labelledby="heading104" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading114" class="card-header" data-toggle="collapse" role="button" data-target="#accordion92" aria-expanded="false" aria-controls="accordion92">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Secure my personal data?
                                                                </span>
                                                            </div>
                                                            <div id="accordion92" role="tabpanel" data-parent="#accordionWrapar3" aria-labelledby="heading114" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.
                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Accordion end -->
                                            </div>
                                            <div class="wrapper-content" data-faq="sales-text">
                                                <div class="text-center p-md-4 p-sm-1 py-1 p-0">
                                                    <h1 class="faq-title">Sales Question</h1>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam reprehenderit alias voluptas aspernatur
                                                        maiores
                                                        quis molestiae totam deserunt exercitationem ipsam officiis nisi, labore magni, commodi quaerat quia
                                                        earum
                                                        quas illo ea amet minus ad dolor?</p>
                                                </div>
                                                <!-- accordion start -->
                                                <div id="accordion-icon-wrapper3" class="collapse-icon accordion-icon-rotate">

                                                    <div class="accordion" id="accordionWrapar4">
                                                        <div class="card collapse-header">
                                                            <div id="heading47" class="card-header" data-toggle="collapse" role="button" data-target="#accordion73" aria-expanded="false" aria-controls="accordion73">
                                                                <span class="collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Detailed sales process?
                                                                </span>
                                                            </div>
                                                            <div id="accordion73" role="tabpanel" data-parent="#accordionWrapar4" aria-labelledby="heading47" class="collapse">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Cheesecake cotton candy bonbon muffin cupcake tiramisu croissant. Tootsie roll sweet candy
                                                                        bear
                                                                        claw chupa chups lollipop toffee. Macaroon donut liquorice powder candy carrot cake macaroon
                                                                        fruitcake. Cookie toffee lollipop cotton candy ice cream dragée soufflé.
                                                                        Cake tiramisu lollipop wafer pie soufflé dessert tart. Biscuit ice cream pie apple pie topping
                                                                        oat cake dessert. Soufflé icing caramels. Chocolate cake icing ice cream macaroon pie
                                                                        cheesecake
                                                                        liquorice apple pie. <br> <br> Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                                        Voluptates
                                                                        alias
                                                                        architecto ullam? Ratione, vitae, amet corrupti non unde praesentium laborum incidunt fugit
                                                                        vel illo
                                                                        debitis
                                                                        dicta illum fugiat, at consequatur! Voluptatum sunt dolorem at deleniti dolor quis a nam
                                                                        facilis.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading93" class="card-header" data-toggle="collapse" role="button" data-target="#accordion36" aria-expanded="false" aria-controls="accordion36">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    What you sales ?
                                                                </span>
                                                            </div>
                                                            <div id="accordion36" role="tabpanel" data-parent="#accordionWrapar4" aria-labelledby="heading93" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading57" class="card-header" data-toggle="collapse" role="button" data-target="#accordion74" aria-expanded="false" aria-controls="accordion74">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How to apply for a sales card?
                                                                </span>
                                                            </div>
                                                            <div id="accordion74" role="tabpanel" data-parent="#accordionWrapar4" aria-labelledby="heading57" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Gingerbread liquorice liquorice cake muffin lollipop powder chocolate cake. Gummi bears lemon
                                                                        drops toffee liquorice pastry cake caramels chocolate bar brownie. Sweet biscuit chupa chups
                                                                        sweet.

                                                                        Halvah fruitcake gingerbread croissant dessert cupcake. Chupa chups chocolate bar donut tart.
                                                                        Donut cake dessert cookie. Ice cream tootsie roll powder chupa chups pastry cupcake soufflé.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading84" class="card-header" data-toggle="collapse" role="button" data-target="#accordion803" aria-expanded="false" aria-controls="accordion803">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure is my data in sales App?
                                                                </span>
                                                            </div>
                                                            <div id="accordion803" role="tabpanel" data-parent="#accordionWrapar4" aria-labelledby="heading84" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Icing sweet roll cotton candy brownie candy canes candy canes. Pie jelly dragée pie. Ice cream
                                                                        jujubes wafer. Wafer croissant carrot cake wafer gummies gummies chupa chups halvah bonbon.

                                                                        Gummi bears cotton candy jelly-o halvah. Macaroon apple pie dragée bonbon marzipan cheesecake.
                                                                        Jelly jelly beans marshmallow.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading94" class="card-header" data-toggle="collapse" role="button" data-target="#accordion122" aria-expanded="false" aria-controls="accordion122">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How do I know sales?
                                                                </span>
                                                            </div>
                                                            <div id="accordion122" role="tabpanel" data-parent="#accordionWrapar4" aria-labelledby="heading94" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading105" class="card-header" data-toggle="collapse" role="button" data-target="#accordion144" aria-expanded="false" aria-controls="accordion144">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Download offline sales doc
                                                                </span>
                                                            </div>
                                                            <div id="accordion144" role="tabpanel" data-parent="#accordionWrapar4" aria-labelledby="heading105" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading115" class="card-header" data-toggle="collapse" role="button" data-target="#accordion93" aria-expanded="false" aria-controls="accordion93">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure my sales information?
                                                                </span>
                                                            </div>
                                                            <div id="accordion93" role="tabpanel" data-parent="#accordionWrapar4" aria-labelledby="heading115" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.
                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Accordion end -->
                                            </div>
                                            <div class="wrapper-content" data-faq="usage-text">
                                                <div class="text-center p-md-4 p-sm-1 py-1 p-0">
                                                    <h1 class="faq-title">Usage Guides</h1>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam reprehenderit alias voluptas aspernatur
                                                        maiores
                                                        quis molestiae totam deserunt exercitationem ipsam officiis nisi, labore magni, commodi quaerat quia
                                                        earum
                                                        quas illo ea amet minus ad dolor? Lorem1 </p>
                                                </div>
                                                <!-- accordion start -->
                                                <div id="accordion-icon-wrapper4" class="collapse-icon accordion-icon-rotate">
                                                    <div class="accordion" id="accordionWrapar5">
                                                        <div class="card collapse-header">
                                                            <div id="heading85" class="card-header" data-toggle="collapse" role="button" data-target="#accordion804" aria-expanded="false" aria-controls="accordion804">
                                                                <span class="collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Purchasing user process?
                                                                </span>
                                                            </div>
                                                            <div id="accordion804" role="tabpanel" data-parent="#accordionWrapar5" aria-labelledby="heading85" class="collapse">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Cheesecake cotton candy bonbon muffin cupcake tiramisu croissant. Tootsie roll sweet candy
                                                                        bear
                                                                        claw chupa chups lollipop toffee. Macaroon donut liquorice powder candy carrot cake macaroon
                                                                        fruitcake. Cookie toffee lollipop cotton candy ice cream dragée soufflé.
                                                                        Cake tiramisu lollipop wafer pie soufflé dessert tart. Biscuit ice cream pie apple pie topping
                                                                        oat cake dessert. Soufflé icing caramels. Chocolate cake icing ice cream macaroon pie
                                                                        cheesecake
                                                                        liquorice apple pie. <br> <br> Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                                        Voluptates
                                                                        alias
                                                                        architecto ullam? Ratione, vitae, amet corrupti non unde praesentium laborum incidunt fugit
                                                                        vel illo
                                                                        debitis
                                                                        dicta illum fugiat, at consequatur! Voluptatum sunt dolorem at deleniti dolor quis a nam
                                                                        facilis.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading106" class="card-header" data-toggle="collapse" role="button" data-target="#accordion46" aria-expanded="false" aria-controls="accordion46">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure are and legal rights?
                                                                </span>
                                                            </div>
                                                            <div id="accordion46" role="tabpanel" data-parent="#accordionWrapar5" aria-labelledby="heading106" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading67" class="card-header" data-toggle="collapse" role="button" data-target="#accordion75" aria-expanded="false" aria-controls="accordion75">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How to write for a postpaid card?
                                                                </span>
                                                            </div>
                                                            <div id="accordion75" role="tabpanel" data-parent="#accordionWrapar5" aria-labelledby="heading67" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Gingerbread liquorice liquorice cake muffin lollipop powder chocolate cake. Gummi bears lemon
                                                                        drops toffee liquorice pastry cake caramels chocolate bar brownie. Sweet biscuit chupa chups
                                                                        sweet.

                                                                        Halvah fruitcake gingerbread croissant dessert cupcake. Chupa chups chocolate bar donut tart.
                                                                        Donut cake dessert cookie. Ice cream tootsie roll powder chupa chups pastry cupcake soufflé.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading86" class="card-header" data-toggle="collapse" role="button" data-target="#accordion805" aria-expanded="false" aria-controls="accordion805">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How refresh is my info in App?
                                                                </span>
                                                            </div>
                                                            <div id="accordion805" role="tabpanel" data-parent="#accordionWrapar5" aria-labelledby="heading86" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Icing sweet roll cotton candy brownie candy canes candy canes. Pie jelly dragée pie. Ice cream
                                                                        jujubes wafer. Wafer croissant carrot cake wafer gummies gummies chupa chups halvah bonbon.

                                                                        Gummi bears cotton candy jelly-o halvah. Macaroon apple pie dragée bonbon marzipan cheesecake.
                                                                        Jelly jelly beans marshmallow.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading95" class="card-header" data-toggle="collapse" role="button" data-target="#accordion123" aria-expanded="false" aria-controls="accordion123">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How do write about about latest ?
                                                                </span>
                                                            </div>
                                                            <div id="accordion123" role="tabpanel" data-parent="#accordionWrapar5" aria-labelledby="heading95" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading101" class="card-header" data-toggle="collapse" role="button" data-target="#accordion145" aria-expanded="false" aria-controls="accordion145">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Download offline sales doc
                                                                </span>
                                                            </div>
                                                            <div id="accordion145" role="tabpanel" data-parent="#accordionWrapar5" aria-labelledby="heading101" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading116" class="card-header" data-toggle="collapse" role="button" data-target="#accordion94" aria-expanded="false" aria-controls="accordion94">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure is your personal information?
                                                                </span>
                                                            </div>
                                                            <div id="accordion94" role="tabpanel" data-parent="#accordionWrapar5" aria-labelledby="heading116" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Accordion end -->
                                            </div>
                                            <div class="wrapper-content" data-faq="general-text">
                                                <div class="text-center p-md-4 p-sm-1 py-1 p-0">
                                                    <h1 class="faq-title">General Guide</h1>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam reprehenderit alias voluptas aspernatur
                                                        maiores
                                                        quis molestiae totam deserunt exercitationem ipsam officiis nisi, labore magni, commodi quaerat quia
                                                        earum
                                                        quas illo ea amet minus ad dolor?</p>
                                                </div>
                                                <!-- accordion start -->
                                                <div id="accordion-icon-wrapper5" class="collapse-icon accordion-icon-rotate">
                                                    <div class="accordion" id="accordionWrapar6">
                                                        <div class="card collapse-header">
                                                            <div id="heading96" class="card-header" data-toggle="collapse" role="button" data-target="#accordion95" aria-expanded="false" aria-controls="accordion95">
                                                                <span class="collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    I wanna write process?
                                                                </span>
                                                            </div>
                                                            <div id="accordion95" role="tabpanel" data-parent="#accordionWrapar6" aria-labelledby="heading96" class="collapse">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Cheesecake cotton candy bonbon muffin cupcake tiramisu croissant. Tootsie roll sweet candy
                                                                        bear
                                                                        claw chupa chups lollipop toffee. Macaroon donut liquorice powder candy carrot cake macaroon
                                                                        fruitcake. Cookie toffee lollipop cotton candy ice cream dragée soufflé.
                                                                        Cake tiramisu lollipop wafer pie soufflé dessert tart. Biscuit ice cream pie apple pie topping
                                                                        oat cake dessert. Soufflé icing caramels. Chocolate cake icing ice cream macaroon pie
                                                                        cheesecake
                                                                        liquorice apple pie. <br> <br> Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                                        Voluptates
                                                                        alias
                                                                        architecto ullam? Ratione, vitae, amet corrupti non unde praesentium laborum incidunt fugit
                                                                        vel illo
                                                                        debitis
                                                                        dicta illum fugiat, at consequatur! Voluptatum sunt dolorem at deleniti dolor quis a nam
                                                                        facilis.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading111" class="card-header" data-toggle="collapse" role="button" data-target="#accordion56" aria-expanded="false" aria-controls="accordion56">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How untoched your gateway information?
                                                                </span>
                                                            </div>
                                                            <div id="accordion56" role="tabpanel" data-parent="#accordionWrapar6" aria-labelledby="heading111" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading77" class="card-header" data-toggle="collapse" role="button" data-target="#accordion76" aria-expanded="false" aria-controls="accordion76">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How to apply for a details?
                                                                </span>
                                                            </div>
                                                            <div id="accordion76" role="tabpanel" data-parent="#accordionWrapar6" aria-labelledby="heading77" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Gingerbread liquorice liquorice cake muffin lollipop powder chocolate cake. Gummi bears lemon
                                                                        drops toffee liquorice pastry cake caramels chocolate bar brownie. Sweet biscuit chupa chups
                                                                        sweet.

                                                                        Halvah fruitcake gingerbread croissant dessert cupcake. Chupa chups chocolate bar donut tart.
                                                                        Donut cake dessert cookie. Ice cream tootsie roll powder chupa chups pastry cupcake soufflé.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading87" class="card-header" data-toggle="collapse" role="button" data-target="#accordion800" aria-expanded="false" aria-controls="accordion800">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure is opensource ?
                                                                </span>
                                                            </div>
                                                            <div id="accordion800" role="tabpanel" data-parent="#accordionWrapar6" aria-labelledby="heading87" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Icing sweet roll cotton candy brownie candy canes candy canes. Pie jelly dragée pie. Ice cream
                                                                        jujubes wafer. Wafer croissant carrot cake wafer gummies gummies chupa chups halvah bonbon.

                                                                        Gummi bears cotton candy jelly-o halvah. Macaroon apple pie dragée bonbon marzipan cheesecake.
                                                                        Jelly jelly beans marshmallow.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading97" class="card-header" data-toggle="collapse" role="button" data-target="#accordion124" aria-expanded="false" aria-controls="accordion124">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How do I know about oldest version?
                                                                </span>
                                                            </div>
                                                            <div id="accordion124" role="tabpanel" data-parent="#accordionWrapar6" aria-labelledby="heading97" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading102" class="card-header" data-toggle="collapse" role="button" data-target="#accordion141" aria-expanded="false" aria-controls="accordion141">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    Download offline sales doc
                                                                </span>
                                                            </div>
                                                            <div id="accordion141" role="tabpanel" data-parent="#accordionWrapar6" aria-labelledby="heading102" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card collapse-header">
                                                            <div id="heading112" class="card-header" data-toggle="collapse" role="button" data-target="#accordion96" aria-expanded="false" aria-controls="accordion96">
                                                                <span class=" collapse-title d-flex align-items-center"><i class="bx bxs-circle font-small-1"></i>
                                                                    How secure personal data ?
                                                                </span>
                                                            </div>
                                                            <div id="accordion96" role="tabpanel" data-parent="#accordionWrapar6" aria-labelledby="heading112" class="collapse" aria-expanded="false">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        Pie pudding candy. Oat cake jelly beans bear claw lollipop. Ice cream candy canes tootsie roll
                                                                        muffin powder donut powder. Topping candy canes chocolate bar lemon drops candy canes.

                                                                        Halvah muffin marzipan powder sugar plum donut donut cotton candy biscuit. Wafer jujubes apple
                                                                        pie sweet lemon drops jelly cupcake. Caramels dessert halvah marshmallow. Candy topping cotton
                                                                        candy oat cake croissant halvah gummi bears toffee powder.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Accordion end -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- swiper ends -->
                        </div>
                    </div>
                </section>
                <!-- faq ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

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
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/faq.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>