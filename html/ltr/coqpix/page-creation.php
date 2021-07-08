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
    if($crea['doc_cerfaMBE'] == ""){
        $doc_cerfaMBE = "0";
    }else{
        $doc_cerfaMBE = "1";
    }
    if($crea['doc_justificatifd'] == ""){
        $doc_justificatifd = "0";
    }else{
        $doc_justificatifd = "1";
    }
    if($crea['doc_justificatifss'] == ""){
        $doc_justificatifss = "0";
    }else{
        $doc_justificatifss = "1";
    }
    if($crea['doc_statuts'] == ""){
        $doc_statuts = "0";
    }else{
        $doc_statuts = "1";
    }
    if($crea['doc_nomination'] == ""){
        $doc_nomination = "0";
    }else{
        $doc_nomination = "1";
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
    if($crea['doc_depot'] == ""){
        $doc_depot = "0";
    }else{
        $doc_depot = "1";
    }
    if($crea['doc_annonce'] == ""){
        $doc_annonce = "0";
    }else{
        $doc_annonce = "1";
    }

    if(!empty($_GET['suppression'])){
        $disparition = "harrypottergood";
    }else{
        $disparition = "harrypotter";
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-creation.css">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns footer-static" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
.none-validation{display: none;}
.block-validation{display: block;}
.red{color: red;}
</style>

    <!-- BEGIN: Header-->
    <?php //require_once("php/header-crea.php") ?> 
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    
    <div class="container-fluid">
        <div class="row" id="div-entreprise">                
            <div class="col-4 m-0" id="div-nom">
                <a class="dropdown-user-link" href="#" data-toggle="dropdown">
                    <img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar"><br>
                    <h3> <?= $crea['name_crea'] ?> </h3>
                    <span class="user-status">En ligne</span>
                </a>
                <div class="dropdown-menu pb-0" style="margin-left: 40%;">
                    <div class="dropdown-divider mb-0"></div><a class="dropdown-item" style="color: #051441; font-family: mukta malar medium;" href="page-creation-edit.php"><i class="bx bxs-pencil mr-50"></i> Information entreprise/dirigeant</a>
                    <div class="dropdown-divider my-0"></div><a class="dropdown-item" style="color: #051441; font-family: mukta malar medium;" href="php/disconnect.php"><i class="bx bx-log-out mr-50"></i> Se déconnecter</a>
                </div>
            </div>
            <div class="col-8 m-0 p-2" id="div-info">
                    <ul class="row">
                        <li class="col-6">
                            <div class="form-group" id="info-gauche">
                                <div class="form-row m-0 p-2">
                                    <label>Prénom du dirigeant</label>
                                    <input type="text" name="prenom_diri" class="form-control" placeholder="Prénom du dirigeant" value="<?= $crea['prenom_diri'] ?>" readonly>
                                </div>
                                <div class="form-row m-0 p-2">
                                    <label>E-mail <span style="text-transform: lowercase;">(identifiant de connexion)</span></label>
                                    <input type="email" name="email_crea" class="form-control" placeholder="Email de connexion" value="<?= $crea['email_crea'] ?>" readonly>
                                </div>
                            </div>
                        </li>
                        <li class="col-6">
                            <div class="form-group" id="info-droite">
                                <div class="form-row m-0 p-2">
                                    <label>Nom du dirigeant</label>
                                    <input type="text" name="nom_diri" class="form-control" placeholder="Nom du dirigeant" value="<?= $crea['nom_diri'] ?>" readonly>
                                </div>
                                <div class="form-row m-0 p-2">
                                    <label>Téléphone du dirigeant</label>
                                    <input onchange='process(event)' type="text" name="tel_temp" id="tel_temp" class="form-control" value="<?= $crea['tel_diri'] ?>" readonly>
                                    <input type="text" name="tel_diri" id="tel_diri" hidden required>
                                </div> 
                            </div> 
                        </li>
                    </ul>
            </div>
        </div>

        <div class="row pt-2 pb-5" id="div-dodo">
            <div class="col-6 m-0 px-3 pt-2" id="div-domiciliation">
                <h2>Domiciliation</h2>
                <div class="row p-2" id="se-domicilier">
                    <h3>Pas encore d'adresse ? Je me <a href="domiciliation.php" id="domicilie">domicilie</a><br><a href="domiciliation.php" type="button">Se Domicilier</a></h3>
                    
                </div>
                <div class="row p-0" id="solution">
                    <ul>
                        <li>
                            <input type="checkbox" id="domicilia" onclick='openGreen("green1","blue1")' class="solu"></input>
                            <label for="domicilia" class="">
                                <img id="blue1" src="../../../app-assets/images/pages/domiciliation.png">
                                <img id="green1" style="display:none;"  src="../../../app-assets/images/pages/domiciliation_green.png">
                            </label><br>
                            <label>
                                <p>Domiciliation</p>
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" onclick='openGreen("green2","blue2")' id="bureau" class="solu"></input>
                            <label for="bureau" class="">
                                <img id="blue2" src="../../../app-assets/images/pages/bureau.png">
                                <img id="green2" style="display:none;" src="../../../app-assets/images/pages/bureau_green.png">
                            </label><br>
                            <label>
                                <p>Bureaux privatifs</p>
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" onclick='openGreen("green3","blue3")' id="cowork" class="solu"></input>
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
            <?php require_once('php/page-creation-document.php') ?>
        </div>
        <?php require_once('php/chat_domiciliation.php')?>
    </div>

    <!-- END: Content -->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

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

        //telephone
        const phoneInputField = document.querySelector("#tel_temp");
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["fr"],
            utilsScript: 
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        function process(event) {
            event.preventDefault();

            const phoneNumber = phoneInput.getNumber();

           
            document.getElementById("tel_diri").value=`${phoneNumber}`;
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