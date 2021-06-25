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

@media screen and (max-width: 1870px) {
    #titre p{
        font-size: 65px;
    }
    #sous-titre p{
        font-size: 25px;
        line-height: 40px;
    }
}

@media screen and (max-width: 1278px) {
    #sous-titre p{
        margin: 100px 0 0 0;
    }
}

@media screen and (max-width: 1785px) {
    #div-titre-gauche{
        display: none;
    }
    #div-titre-droite{
        min-width: 100%;
    }
}

@media screen and (min-width: 2300px) {
    #titre p{
        font-size: 65px;
    }
    #sous-titre p{
        font-size: 25px;
        line-height: 40px;
    }
}

@media screen and (max-width: 1878px) {
    #div-carte-droite{
        display: none;
    }
    #div-carte-gauche{
        min-width: 100%;
    }
    #titre p{
        font-size: 65px;
    }
    #sous-titre p{
        font-size: 25px;
        line-height: 40px;
    }
}

#titre{
    font-family: mukta malar medium;
    color: white;
    margin: 180px 0 0 10%;
    font-size: 60px;
    width: 80%;
}

#titre p{
    line-height: 70px;
}

#sous-titre{
    font-family: mukta malar medium;
    color: white;
    margin: 50px 0 0 10%;
    font-size: 17px;
}

#sous-titre p{
    width: 70%;
}

.container-fluid {
    padding-top: 68px;
}

#div-titre-gauche{
    background-color: #051441;
    border-radius: 0 400px 400px 0;
    
}

#div-titre-droite{
    padding: 100px;
}

#div-titre-droite h1{
    color: #003783;
    font-family: mukta malar medium;
    margin: 50px 0 0 20px;
}

#solution-logo{
    margin-top: 50px;
}

#solution-logo ul{
    padding: 10px;
    text-align: center;
}

#solution-logo ul li{
    list-style: none;
    display: inline-block;
    margin: 0 8% 10px 0;
}

#solution-logo ul li p{
    margin-top: 10px;
    text-align: center;
    font-family: mukta malar medium;
    color: #051441;
}

#localisation{
    margin: 50px 10% 0 0;
}

input[type="checkbox"].solu {
    display: none;
}

input[type="checkbox"].solu + label {
    padding: 10px;
    border: none;
    border-radius: 15px;
}

input[type="checkbox"].solu + label:hover{
    cursor:pointer;
}

input[type="checkbox"].solu:checked + label {
    border: 1px hidden rgba(5, 20, 65, 0.6);
    background-color: rgba(5, 20, 65, 0.1);
}

.card-container{
    margin: 50px;
}

.card-container ul{
    padding: 10px;
    text-align: center;
}

.card-container ul li{
    list-style: none;
    display: inline-block;
}

.card-body{
    width: 300px;
    border: 1px solid #051441;
    border-radius: 10px;
    margin: 20px;
}

.card-body img{
    width: 250px;
    height: 200px;
}

.card-descrip{
    margin-top: 5px;
}

.card-descrip #ville{
    font-family: mukta malar medium;
    color: black;
}

.card-descrip #adresse{
    font-family: mukta malar medium;
    color: black;
}

.card-btn{
    margin-bottom: 5px;
}

.card-btn a{
    font-family: mukta malar medium;
    color: #003783;
    text-transform: uppercase;
}

.offers{
    padding: 10px;
    margin : 20px;
    border-radius: 15px;
}

.offers:hover{
    border: 1px solid black;
    cursor : pointer;
}
    
</style>

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-sticky bg-white content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="container-fluid">
        <div class="row" id="div-titre" style="min-height: 100%;">
            <div class="col-6 p-0" id="div-titre-gauche" style="min-height: 100%;">
                <div id="titre"><p>Grâce à COQPIX et nos partenaires.<br> Domiciliez-vous <span style="color: #29fe8c;">rapidement</span> et <span style="color: #29fe8c;">facilement</span> </p></div>
                <div id="sous-titre"><p>Bureaux privatifs modulables, Spots de coworking, salles de réunion, domiciliation d'entreprise...<br> Que vous soyez entrepreneur, start-up, PME ou grande entreprise, trouvez la solution de travail flexible qui vous convient.</p></div>
            </div>
            <div class="col-6" id="div-titre-droite" style="min-height: 100%;">
                <div id="solution" class="col-12">
                    <form action="" method="POST">
                    <div>
                        <h1>Nos solutions</h1>
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
                    </div>
                    <div id="localisation">
                        <div class="form-group">
                            <label class="" style="font-size: 15px; font-family: mukta malar bold; color: #051441; margin-left: 25px">Localisation</label>
                            <input type="text" id="" name="" style="font-family: mukta malar medium; color: #051441; margin-top: 20px;" class="form-control border rounded-pill border-dark" placeholder="Entrez une ville..." required>
                        </div>
                        <div class="form-group" style="text-align: center; margin-top: 50px;">
                            <button type="submit" id='' style="font-family: mukta malar bold; width: 200px; white-space: nowrap; background-color: #29fe8c;" class="btn text-dark glow position-relative border rounded-pill">Rechercher<img src="../../../app-assets/fonts/LivIconsEvo/svg/search.svg" id="icon-search" class="" style="width: 20px; float: right;"></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row" id="div-carte" style="height: 100%;">
            <div class="col-6" id="div-carte-gauche" style="height: 800px;">
                <div class="card-container">
                    <ul>
                        <li>
<<<<<<< HEAD
                            <div class="card-body offers" onclick="window.location='page-coming-soon.html';">
                                <img src="../../../app-assets/images/profile/pages/page-09.jpg">
                                <div class="card-descrip">
                                    <p>Salut</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="card-body offers" onclick="window.location='page-coming-soon.html';">
=======
                            <div class="card-body p-0">
>>>>>>> 346e30ed98acfb993f5192a0d4304130bdb95e75
                                <img src="../../../app-assets/images/profile/pages/page-09.jpg">
                                <div class="card-descrip">
                                    <p id="ville">Multiburo Paris Châtelet, 75003</p>
                                    <p id="adresse">52 boulevard Sébastopol<br> 75003 Paris</p>
                                </div>
<<<<<<< HEAD
                            </div>
                        </li>
                        <li>
                            <div class="card-body offers" onclick="window.location='page-coming-soon.html';">
                                <img src="../../../app-assets/images/profile/pages/page-09.jpg">
                                <div class="card-descrip">
                                    <p>Salut</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="card-body offers" onclick="window.location='page-coming-soon.html';">
                                <img src="../../../app-assets/images/profile/pages/page-09.jpg">
                                <div class="card-descrip">
                                    <p>Salut</p>
=======
                                <div class="card-btn">
                                    <a href="domiciliation-offre.php">Découvrir cette adresse</a>
>>>>>>> 346e30ed98acfb993f5192a0d4304130bdb95e75
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-6" id="div-carte-droite" style="height: 800px;">
            <iframe src="https://www.google.com/maps/d/embed?mid=1d4qkN6nzCX93ftELMhFaubmUOlWgDF7q" width="100%" height="800px" right=0;></iframe>
            
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