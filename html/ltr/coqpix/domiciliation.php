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
                    <p id="titre">Grâce à COQPIX et nos partenaires.<br> Domiciliez-vous <span style="color: #29fe8c;">rapidement</span> et <span style="color: #29fe8c;">facilement</span> au meilleur <span style="color: #29fe8c;">PRIX !!!</span> </p>
                    <p id="sous-titre">Bureaux privatifs modulables, Spots de coworking, salles de réunion, domiciliation d'entreprise...<br> Que vous soyez entrepreneur, start-up, PME ou grande entreprise, trouvez la solution de travail flexible qui vous convient.</p>
                </div>
            </div>
            <div class="col-6" id="div-titre-droite">
                <div id="solution" class="col-12">
                    <div>
                        <h1>Nos solutions</h1>
                        <div id="solution-logo">
                            <ul>
                                <li>
                                    <input type="checkbox" id="domicilia" onclick='openGreen("green1","blue1"), countType()' class="solu"></input>
                                    <label for="domicilia" class="">
                                        <img id="blue1" src="../../../app-assets/images/pages/domiciliation.png">
                                        <img id="green1" style="display:none;"  src="../../../app-assets/images/pages/domiciliation_green.png">
                                    </label><br>
                                    <label>
                                        <p>Domiciliation</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" onclick='openGreen("green2","blue2"), countType()' id="bureau" class="solu"></input>
                                    <label for="bureau" class="">
                                        <img id="blue2" src="../../../app-assets/images/pages/bureau.png">
                                        <img id="green2" style="display:none;" src="../../../app-assets/images/pages/bureau_green.png">
                                    </label><br>
                                    <label>
                                        <p>Bureaux privatifs</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="checkbox" onclick='openGreen("green3","blue3"), countType()' id="cowork" class="solu"></input>
                                    <label for="cowork" class="">
                                        <img id="blue3"  src="../../../app-assets/images/pages/coworking.png">
                                        <img id="green3" style="display:none;" src="../../../app-assets/images/pages/coworking_green.png">
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
                            <button type="submit" id='btn-recherche' class="btn text-dark glow position-relative border rounded-pill">Rechercher<img src="../../../app-assets/fonts/LivIconsEvo/svg/search.svg" id="icon-search" class="" style="width: 20px; float: right;"></button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row" id="div-carte" style="height: 100%;">
            <div class="col-6" id="div-carte-gauche" >
                <div class="card-container" id="offre-conteneur">
                    <!--<ul>
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
                    </ul>-->
                </div>
            </div>
            <div class="col-6" id="div-carte-droite" >
            <iframe src="https://www.google.com/maps/d/embed?mid=1d4qkN6nzCX93ftELMhFaubmUOlWgDF7q" width="100%" height="800px" right=0;></iframe>
            
            </div>
        </div>
        <?php require_once('php/chat_domiciliation.php')?>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>    

<script>

    //changement image
    function openGreen(element1,element2) {
        if (document.getElementById(element1).style.display == "none" ){
            document.getElementById(element1).style.display = "block";
            document.getElementById(element2).style.display = "none";
        } else {
            document.getElementById(element1).style.display = "none";
            document.getElementById(element2).style.display = "block";
        }
    }

    function countType() {
        var bureau = document.getElementById("bureau");
        var cowork = document.getElementById("cowork");
        var domicilia = document.getElementById("domicilia");

        var i = 0;

        if (bureau.checked) {
            i = i+1;
        }
        if (cowork.checked) {
            i = i+2;
        }
        if (domicilia.checked) {
            i = i+4;
        }
        console.log(i);
        return i;
    };
    
    //suggest adresse
    $(document).ready(function(){
        $("#search-box").keyup(function(){
            $.ajax({
            type: "POST",
            url: "php/readCity.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#search-box").css("background","#FFF url(../../../app-assets/images/ico/ajax-loader.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggestion-box").show();
                $("#suggestion-box").html(data);
                $("#search-box").css("background","#FFF");
            }
            });
        });
        $("#btn-recherche").on('click',function(){
            $.ajax({
            type: "POST",
            url: "php/display-offers.php",
            data:'ville='+$("#search-box").val() + "&type=" + countType(),
            success: function(data){
                console.log("affichage des offres");
                $("#offre-conteneur").html(data);
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