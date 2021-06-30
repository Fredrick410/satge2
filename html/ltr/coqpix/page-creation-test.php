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
                <img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar"><br>
                <h3> <?= $crea['name_crea'] ?> </h3>
                <span class="user-status">En ligne</span>
            </div>
            <div class="col-8 m-0 p-2" id="div-info">
                <form action="php/edit_crea_client.php" method="POST">
                    <input type="hidden" name="id" value="<?= $crea['id'] ?>">

                    <?php 
                        if($crea['status_crea'] == ""){
                            $validation = "harrypottergood";
                        }else{
                            $validation = "harrypotter";
                        }
                    ?>
                    <ul class="row">
                        <li class="col-4">
                            <div class="form-group" id="info-gauche">
                                <div class="form-row m-0 p-2">
                                    <label>Prénom du dirigeant</label>
                                    <input type="text" name="prenom_diri" class="form-control" placeholder="Prénom du dirigeant" value="<?= $crea['prenom_diri'] ?>" required>
                                </div>
                                <div class="form-row m-0 p-2">
                                    <label>Nom du dirigeant</label>
                                    <input type="text" name="nom_diri" class="form-control" placeholder="Nom du dirigeant" value="<?= $crea['nom_diri'] ?>" required>
                                </div>
                            </div>
                        </li>
                        <li class="col-4">
                            <div class="form-group" id="info-droite">
                                <div class="form-row m-0 p-2">
                                    <label>E-mail</label>
                                    <input type="email" name="email_crea" class="form-control" placeholder="Email de connexion" value="<?= $crea['email_crea'] ?>" required>
                                </div>
                                <div class="form-row m-0 p-2">
                                    <label>Téléphone du dirigeant</label>
                                    <input onchange='process(event)' type="text" name="tel_temp" id="tel_temp" class="form-control" value="<?= $crea['tel_diri'] ?>" required>
                                    <input type="text" name="tel_diri" id="tel_diri" hidden required>
                                </div> 
                            </div> 
                        </li>

                                <?php
                                    if(!empty($_GET['enregister'])){
                                        if($_GET['enregister'] == "1"){
                                            $good = "harrypottergood";
                                        }else{
                                            $good = "";
                                        }
                                    }else{
                                        $good = "harrypotter";
                                    }
                                ?>
                               <!-- <div class="col-12 <?php echo $good; ?>">
                                    <div class="form-group">
                                        <label>Enregistrement effectué 👍🏽</label>
                                    </div>
                                </div> -->
                                
                        <li class="col-4">
                            <div class="form group" id="info-btn">
                                <button type="submit" class="btn mr-sm-1 mb-1">Sauvegarder</button>
                            </div>
                        </li>
                    </ul>
                    
                
                    
                    
                </form>
            </div>
        </div>

        <div class="row pt-2 pb-5" id="div-dodo">
            <div class="col-6 m-0 px-3 pt-2" id="div-domiciliation">
                <h2>Domiciliation</h2>
                <div class="row p-2" id="se-domicilier">
                    <h3>Pas encore d'adresse ? Je me <a href="domiciliation.php" id="domicilie">domicilie</a></h3>
                    <a href="domiciliation.php" type="button">Se Domicilier</a>
                </div>
                <div class="row p-2" id="solution">
                    <ul class="col-12">
                        <li class="col-3">
                            <input type="checkbox" id="domicilia" onclick='openGreen("green1","blue1")' class="solu"></input>
                            <label for="domicilia" class="">
                                <img id="blue1" src="../../../app-assets/images/pages/domiciliation.png">
                                <img id="green1" style="display:none;"  src="../../../app-assets/images/pages/domiciliation_green.png">
                            </label><br>
                            <label>
                                <p>Domiciliation</p>
                            </label>
                        </li>
                        <li class="col-3">
                            <input type="checkbox" onclick='openGreen("green2","blue2")' id="bureau" class="solu"></input>
                            <label for="bureau" class="">
                                <img id="blue2" src="../../../app-assets/images/pages/bureau.png">
                                <img id="green2" style="display:none;" src="../../../app-assets/images/pages/bureau_green.png">
                            </label><br>
                            <label>
                                <p>Bureaux privatifs</p>
                            </label>
                        </li>
                        <li class="col-3">
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
            <div class="col-6 m-0 px-3 pt-2" id="div-document">
                <h2>Mes documents</h2>
                <div class="row p-2" id="doc-manquant">
                    <h4>Document manquant</h4>
                        <div class="col-12" id="scroll-doc">
                            <div class="form-group">
                                <label class="line">Administration</label>
                            </div>  
                            <?php 
                                if($doc_pieceid == "1"){ ?>
                                <a href="creation-view-morale-pieceid.php" id="av" class="list-group-item" >
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div>
                                    Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/v.png">
                                </a>
                            <?php }else{ ?>
                                <a href="creation-view-morale-pieceid.php" id="ax" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div>
                                    Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/x.png">
                                </a>
                            <?php } 
                                if($doc_cerfaM0 == "1"){ ?>
                                <a href="creation-view-morale-cerfaM0.php" id="av" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/v.png">
                                </a>
                            <?php }else{ ?>
                                <a href="creation-view-morale-cerfaM0.php" id="ax" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/x.png">
                                </a>
                            <?php } 
                                if($doc_cerfaMBE == "1"){ ?>
                                <a href="creation-view-morale-cerfaMBE.php" id="av" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Cerfa MBE <img id="vx" src="../../../app-assets/images/pages/v.png">
                                </a>
                            <?php }else{ ?>
                                <a href="creation-view-morale-cerfaMBE.php" id="ax" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Cerfa MBE <img id="vx" src="../../../app-assets/images/pages/x.png">
                                </a>
                            <?php } 
                                if($doc_justificatifss == "1"){ ?>
                                <a href="creation-view-morale-justificatifss.php" id="av" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Justificatif siège social <img id="vx" src="../../../app-assets/images/pages/v.png">
                                </a>
                            <?php }else{ ?>
                                <a href="creation-view-morale-justificatifss.php" id="ax" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Justificatif siège social <img id="vx" src="../../../app-assets/images/pages/x.png">
                                </a>
                            <?php } ?>
                            <div class="form-group">
                                <label class="line">Rédaction</label>
                            </div>                                       
                            <?php 
                                if($doc_pouvoir == "1"){ ?>
                                <a href="creation-view-morale-pouvoir.php" id="av" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Pouvoir <img id="vx" src="../../../app-assets/images/pages/v.png">
                                </a>
                            <?php }else{ ?>
                                <a href="creation-view-morale-pouvoir.php" id="ax" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Pouvoir <img id="vx" src="../../../app-assets/images/pages/x.png">
                                </a>
                            <?php } 
                                if($doc_attestation == "1"){ ?>
                                <a href="creation-view-morale-attestation.php" id="av" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/v.png">
                                </a>
                            <?php }else{ ?>
                                <a href="creation-view-morale-attestation.php" id="ax" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/x.png">
                                </a>
                            <?php } ?>
                            <div class="form-group">
                                <label class="line">Banque et Publication</label>
                            </div>
                            <?php 
                                if($doc_depot == "1"){ ?>
                                <a href="creation-view-morale-depot.php" id="av" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Dépôt de capital <img id="vx" src="../../../app-assets/images/pages/v.png">
                                </a>
                            <?php }else{ ?>
                                <a href="creation-view-morale-depot.php" id="ax" class="list-group-item">
                                    <div class="fonticon-wrap d-inline mr-25">
                                        <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                    </div> 
                                    Dépôt de capital <img id="vx" src="../../../app-assets/images/pages/x.png">
                                </a>
                            <?php } ?>                                    
                        </div>
                </div>
            </div>
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