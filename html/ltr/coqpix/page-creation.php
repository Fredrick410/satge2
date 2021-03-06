<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
require_once 'php/get_documents_physique.php';
require_once 'php/get_documents.php';
require_once 'php/get_info.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea'], PDO::PARAM_INT);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    if(!empty($_GET['suppression'])){
        $disparition = "harrypottergood";
    }else{
        $disparition = "harrypotter";
    }

    if ($crea['doc_domiciliation'] == '') {
        $affichage_domi = "";
        $affichage_doc = "hidden";
    } else {
        $affichage_domi = "hidden";
        $affichage_doc = "";
    }

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

    $verif = false;
    $color = '#C0C0C0';

    if($linkview == 'morale'){
        if($doc_pieceid == "1"){
            if($doc_cerfaM0 == "1"){
                if($doc_cerfaMBE == "1"){
                    if($doc_justificatifss == "1"){
                        if($doc_pouvoir == "1"){
                            if($doc_attestation == "1"){
                                if($doc_depot == "1"){
                                    if($nom_diri == "1"){                                    
                                        if($prenom_diri == "1"){                                        
                                            if($tel_diri == "1"){
                                                if($email_diri == "1"){
                                                    if($adresse_diri == "1"){
                                                        if($ville_diri == "1"){
                                                            if($cp_diri == "1"){
                                                                if($status_crea == "1"){
                                                                    if($secteur_dactivite == "1"){
                                                                        if($name_crea == "1"){
                                    
                                                                            $verif = true;    
                                                                            $color = '#29fe8c';     
                                                                            
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }                                    
                                }
                            }
                        }
                    }
                }
            }
        }
    }else{
        if($doc_pieceid == "1"){
            if($doc_cerfaM0 == "1"){
                if($doc_xp == "1"){
                    if($doc_justificatifd == "1"){
                        if($doc_peirl == "1"){
                            if($doc_affectation == "1"){
                                if($doc_pouvoir == "1"){
                                    if($doc_attestation == "1"){
                                        if($nom_diri == "1"){                                    
                                            if($prenom_diri == "1"){                                        
                                                if($tel_diri == "1"){
                                                    if($email_diri == "1"){
                                                        if($adresse_diri == "1"){
                                                            if($ville_diri == "1"){
                                                                if($cp_diri == "1"){
                                                                    if($status_crea == "1"){
                                                                        if($secteur_dactivite == "1"){
                                                                            if($name_crea == "1"){
                                    
                                                                                $verif = true;    
                                                                                $color = '#29fe8c';     
                                                                            
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }                                 
                                    }
                                }
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
    <meta name="description" content="Coqpix cr??e By audit action plus - d??velopp?? par Youness Haddou">
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
                    <span class="user-status">En ligne</span> <span class="bx bx-cog"></span> <span class="bx bx-log-out"></span>
                </a>
                <div class="dropdown-menu pb-0" style="margin-left: 40%;">
                    <div class="dropdown-divider mb-0"></div><a class="dropdown-item" style="color: #051441; font-family: mukta malar medium;" href="page-creation-edit.php"><i class="bx bxs-pencil mr-50"></i> Information entreprise/dirigeant</a>
                    <div class="dropdown-divider my-0"></div><a class="dropdown-item" style="color: #051441; font-family: mukta malar medium;" href="php/disconnect.php"><i class="bx bx-log-out mr-50"></i> Se d??connecter</a>
                </div>
            </div>
            <div class="col-8 m-0 p-2" id="div-info">
                    <ul class="row">
                        <li class="col-4">
                            <div class="form-group" id="info-gauche">
                                <div class="form-row m-0 p-2">
                                    <label>Pr??nom du dirigeant</label>
                                    <p name="prenom_diri" class="form-control"> <?= $crea['prenom_diri'] ?> </p>
                                </div>
                                <div class="form-row m-0 p-2">
                                    <label>E-mail <span style="text-transform: lowercase;">(identifiant de connexion)</span></label>
                                    <p name="email_crea" class="form-control"> <?= $crea['email_diri'] ?> </p>
                                </div>
                            </div>
                        </li>
                        <li class="col-4">
                            <div class="form-group" id="info-droite">
                                <div class="form-row m-0 p-2">
                                    <label>Nom du dirigeant</label>
                                    <p name="nom_diri" class="form-control"> <?= $crea['nom_diri'] ?> </p>
                                </div>
                                <div class="form-row m-0 p-2">
                                    <label>T??l??phone du dirigeant</label>
                                    <p name="tel_diri" class="form-control"> <?= $crea['tel_diri'] ?> </p>
                                </div> 
                            </div> 
                        </li>
                        <li class="col-4">
                            <?php if($doc_contrat == "1"){ ?>
                            <a class="btn btn-contrat" style="background-color: #29fe8c;" href="../../../src/crea_societe/contrat/<?= $crea['doc_contrat'] ?>" target="_blank">
                            <img src="../../../app-assets/images/pages/doc.png" id="img-doc1">
                            <label>Voir mon contrat<img id="vx1" src="../../../app-assets/images/pages/v.png"></label>
                            </a>
                            <?php if($crea['estimation_contrat'] == ''){ ?>
                                <a class="btn btn-primary1" style="background-color: #C0C0C0;"><label style="font-size: 13px;" class="m-0" onclick="alert('Veuillez attendre que Coqpix indique le co??t du contrat s\'il vous plait');"><span class="bx bx-pen"></span> Signer mon contrat</label></a>
                            <?php }else{ 
                                if($crea['portefeuille_contrat'] == 'false'){ ?>
                                <a href="signature-contrat.php" href="#" class="btn btn-primary1" style="background-color: #29fe8c;"><label style="font-size: 13px;" class="m-0" ><span class="bx bx-pen"></span> Signer mon contrat</label></a>
                                <?php }else{ ?>
                                    <p style="width: 100%; text-align: center; margin: 10px 0 0 20px;">Contrat sign?? ????????</p>
                            <?php } } ?>
                            <?php }else{ 
                                if($verif == true){ ?>
                            <a class="btn btn-contrat" style="background-color: <?= $color ?>;" href="generate-pdf-2.php" target="_blank">
                                <img src="../../../app-assets/images/pages/doc.png" id="img-doc1">
                                <label style="font-size: 13px;">G??n??rer mon contrat<img id="vx1" src="../../../app-assets/images/pages/v.png"></label>
                            </a>
                            <?php }else{ ?>
                            <a class="btn btn-contrat" onclick="alert('Veuillez compl??ter votre compte avant de g??n??rer votre contrat');" style="background-color: <?= $color ?>;" href="#">
                                <img src="../../../app-assets/images/pages/doc.png" id="img-doc1">
                                <label style="font-size: 13px;">G??n??rer mon contrat<img id="vx1" src="../../../app-assets/images/pages/x.png"></label>
                            </a>
                            <?php  }
                            } ?>
                        </li>
                    </ul>
            </div>
        </div>

        <div class="row pt-2 pb-5" id="div-dodo">
            <div class="col-6 m-0 px-3 pt-2" id="div-domiciliation" <?= $affichage_domi ?>>
                <h2>Domiciliation</h2>
                <div class="row p-2" id="se-domicilier">
                    <h3>Pas encore d'adresse ? Je me <a href="domiciliation.php" id="domicilie">domicilie</a></h3><br>
                    <div class="form-group">
                        <br>
                    </div>
                    <br>
                    <a href="domiciliation.php" type="button">Se Domicilier</a>
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

            <div class="col-6 m-0 px-3 pt-2" id="div-domiciliation" <?= $affichage_doc ?>>
                <h2>Domiciliation</h2>
                <div class="row" id="doc_domiciliation">

                    <embed src=../../../src/crea_societe/domiciliation/<?= $crea['doc_domiciliation'] ?> width=100% height=100% type='application/pdf'/>
                
                    <div class="col">
                        <button class="btn btn-primary glow mr-sm-1 mb-1 border rounded-pill border-dark" onclick="location.replace('php/domiciliation-cancel.php')">Annuler</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary glow mr-sm-1 mb-1 border rounded-pill border-dark" onclick="location.href = 'domiciliation.php'">Modifier</button>
                    </div>
                    
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