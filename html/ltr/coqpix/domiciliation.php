<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    if($crea['doc_pieceid'] == ""){
        $doc_pieceid = "0";
    }else{
        $doc_pieceid = "1";
    }
    if($crea['doc_cerfaM0'] == ""){
        $doc_cerfaM0 = "0";
    }else{
        $doc_cerfaM0 = "1";
    }
    if($crea['doc_justificatifd'] == ""){
        $doc_justificatifd = "0";
    }else{
        $doc_justificatifd = "1";
    }
    if($crea['doc_affectation'] == ""){
        $doc_affectation = "0";
    }else{
        $doc_affectation = "1";
    }
    if($crea['doc_pouvoir'] == ""){
        $doc_pouvoir = "0";
    }else{
        $doc_pouvoir = "1";
    }
    if($crea['doc_attestation'] == ""){
        $doc_attestation = "0";
    }else{
        $doc_attestation = "1";
    }
    if($crea['doc_xp'] == ""){
        $doc_xp = "0";
    }else{
        $doc_xp = "1";
    }
    if($crea['doc_peirl'] == ""){
        $doc_peirl = "0";
    }else{
        $doc_peirl = "1";
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/domiciliation.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->


<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-sticky bg-white content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="container-fluid">
        <div class="row" id="div-titre">
            <div class="col-6 p-0" id="div-titre-gauche">
                <div id="longueur-titre">
                    <p id="titre">Grâce à COQPIX et nos partenaires.<br> Domiciliez-vous <span style="color: #29fe8c;">rapidement</span> et <span style="color: #29fe8c;">facilement</span> </p>
                    <p id="sous-titre">Bureaux privatifs modulables, Spots de coworking, salles de réunion, domiciliation d'entreprise...<br> Que vous soyez entrepreneur, start-up, PME ou grande entreprise, trouvez la solution de travail flexible qui vous convient.</p>
                </div>
            </div>
            <div class="col-6" id="div-titre-droite">
                <div id="solution" class="col-12">
                    <form action="" method="POST">
                    <div>
                        <h1>Nos solutions</h1>
                        <div id="solution-logo">
                            <ul>
                                <li>
                                    <input type="checkbox" id="domicilia" class="solu"></input>
                                    <label for="domicilia" class="">
                                        <img src="../../../app-assets/images/pages/domiciliation.png">
                                    </label><br>
                                    <label>
                                        <p>Domiciliation</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="bureau" class="solu"></input>
                                    <label for="bureau" class="">
                                        <img src="../../../app-assets/images/pages/bureau.png">
                                    </label><br>
                                    <label>
                                        <p>Bureaux privatifs</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cowork" class="solu"></input>
                                    <label for="cowork" class="">
                                        <img src="../../../app-assets/images/pages/coworking.png">
                                    </label><br>
                                    <label>
                                        <p>Coworking</p>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="localisation">
                        <div class="form-group">
                            <label class="">Localisation</label>
                            <input type="text" id="search-box" name="" class="form-control border rounded-pill border-dark" placeholder="Entrez une ville..." required>
                            <div id="suggestion-box"></div>
                        </div>
                        <div class="form-group" id="div-btn">
                            <button type="submit" id='' class="btn text-dark glow position-relative border rounded-pill">Rechercher<img src="../../../app-assets/fonts/LivIconsEvo/svg/search.svg" id="icon-search" class="" style="width: 20px; float: right;"></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row" id="div-carte" style="height: 100%;">
            <div class="col-6" id="div-carte-gauche" >
                <div class="card-container">
                    <ul>
                        <li>
                            <div class="card-body p-0">
                                <img src="../../../app-assets/images/profile/pages/page-09.jpg">
                                <div class="card-descrip">
                                    <p id="ville">Multiburo Paris Châtelet, 75003</p>
                                    <p id="adresse">52 boulevard Sébastopol<br> 75003 Paris</p>
                                </div>
                                <div class="card-btn">
                                    <a href="domiciliation-offre.php">Découvrir cette adresse</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-6" id="div-carte-droite" >
            <iframe src="https://www.google.com/maps/d/embed?mid=1d4qkN6nzCX93ftELMhFaubmUOlWgDF7q" width="100%" height="800px" right=0;></iframe>
            
            </div>
        </div>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>    

<script>
    //suggest adresse
    $(document).ready(function(){
        $("#search-box").keyup(function(){
            $.ajax({
            type: "POST",
            url: "php/readCity.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggestion-box").show();
                $("#suggestion-box").html(data);
                $("#search-box").css("background","#FFF");
            }
            });
        });
    });

    function selectCity(val) {
    $("#search-box").val(val);
    $("#suggestion-box").hide();
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

    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>