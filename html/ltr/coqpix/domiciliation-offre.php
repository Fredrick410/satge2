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
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<style>

@font-face{
    font-family: "mukta malar bold";
    src: url("../../../app-assets/css/Mukta_Malar/MuktaMalar-Bold.ttf");
}

@font-face{
    font-family: "mukta malar medium";
    src: url("../../../app-assets/css/Mukta_Malar/MuktaMalar-Medium.ttf");
}

@font-face{
    font-family: "mukta malar light";
    src: url("../../../app-assets/css/Mukta_Malar/MuktaMalar-Light.ttf");
}

.container-fluid {
    padding-top: 68px;
}

.carousel{
    margin: 50px;
    border-radius: 10px;
}

.carousel-item img{
    height: 600px; 
    width: 100%; 
    border-radius: 10px;
}

#titre{
    text-transform: uppercase;
    font-family: mukta malar bold;
    color: #051441;
}

#div-descrip pre{
    font-family: mukta malar medium;
    color: #051441;
    font-size: 17px;
    white-space: pre-wrap;
    background-color: #ffffff;
}

#div-info{
    background-color: #051441;
}

#div-info ul{
    margin: 50px 15%;
}

#div-info ul li{
    list-style-position: inside;
    list-style-type: ;
    color: white;
    font-family: mukta malar medium;
}

#div-service-dispo{
    padding: 50px;
}

#div-service-dispo h2{
    font-family: mukta malar bold;
    color: #003783;
    text-align: center;
}

#solution-logo{
    margin: 50px 50px 0 50px;
}

#solution-logo ul{
    padding: 10px;
    text-align: center;
}

#solution-logo ul li{
    list-style: none;
    display: inline-block;
    margin: 0 5%;
}

#solution-logo ul li p{
    margin-top: 10px;
    text-align: center;
    font-family: mukta malar medium;
    color: #051441;
}

input[type="checkbox"].solu {
    display: none;
}

input[type="checkbox"].solu + label {
    padding: 10px;
    border: none;
    border-radius: 15px;
}

input[type="checkbox"].solu:checked + label {
    border: 1px hidden rgba(5, 20, 65, 0.6);
    background-color: rgba(5, 20, 65, 0.1);
}

#div-btn-sol{
    text-align: center;
}

#btn-sol{
    font-family: mukta malar bold; 
    width: 150px; 
    white-space: nowrap; 
    background-color: #29fe8c;
}

</style>

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-sticky bg-white content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
<div class="container-fluid">
    <div class="row">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 600px; background-color: grey;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-mdb-interval="10000000000" id="img1">
    	
              	<img src="../../../app-assets/images/banner/banner-1.jpg" >
      	
            </div>
            <div class="carousel-item" data-mdb-interval="10000">
    	
      	        <img src="../../../app-assets/images/banner/banner-2.jpg" >
        
            </div>
            <div class="carousel-item" data-mdb-interval="10000">
    	
      	        <img src="../../../app-assets/images/banner/banner-3.jpg" >
      	
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8" id="div-descrip">
            <h1 id="titre">Venez travailler sur un air d'opéra à Paris 9</h1>
            <br>
            <pre>
Offrez une envolée lyrique à votre société ! Installez-vous dans un quartier ultra recherché qui attire depuis longtemps les grands noms de la High Tech et de la Finance. A 2 pas de l'Opéra Garnier et des Galeries Layette, vous êtes au coeur de la capitale bénéficiez d'un position idéale pour votre image de marque.
            
Dans un cadre coloré et lumineux, profitez de nos espaces de bureaux et plateaux privatifs pour installer votre société , et recevez vos clients avec calme et confort dans un cadre prestigieux. Besoin d'une belle adresse à Paris 9 ? Venez nous rendre visite !
            
Multiburo Paris Opéra, c'est :
            </pre>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row">
        <div class="col-12" id="div-info">
            <ul>
                <li> 2 300m^2 d'espaces modulables et évolutifs</li>
                <li> Des bureaux flexibles et personnalisables</li>
                <li> 6 sales de réunion jusqu'à 30 personnes</li>
                <li> Un espace de bureaux partagés lumineux</li>
                <li> Des services de domiciliation et de bureau virtuel</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12" id="div-service-dispo">
            <h2>Les services disponibles à cette adresse</h2>
            <div id="solution-logo">
                <ul>
                    <li>
                        <input type="checkbox" id="bureau" class="solu"></input>
                        <label for="bureau" class="">
                            <img src="../../../app-assets/images/pages/bureau.png" width= 150px; >
                            <p>Bureaux privatifs</p>
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" id="cowork" class="solu"></input>
                        <label for="cowork" class="">
                            <img src="../../../app-assets/images/pages/coworking.png" width= 150px; >
                            <p>Coworking</p>
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" id="domicilia" class="solu"></input>
                            <label for="domicilia" class="">
                                <img src="../../../app-assets/images/pages/domiciliation.png" width= 150px; >
                                <p>Domiciliation</p>
                            </label>
                    </li>
                </ul>
            </div>
            <div class="form-group" id="div-btn-sol">
                <button type="submit" id="btn-sol" class="btn text-dark glow position-relative border rounded-pill">Soumettre</button>
            </div>
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

