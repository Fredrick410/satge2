<?php 

error_reporting(E_ALL);
session_start();
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $explode = explode(';',$_GET['key']);

    $num = $explode[2];

    $pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
    $pdoSta->bindValue(':num',$num);
    $pdoSta->execute();
    $annonce = $pdoSta->fetch();

    $pdoSta = $bdd->prepare('SELECT * FROM rh_candidature WHERE key_candidat=:key_candidat');
    $pdoSta->bindValue(':key_candidat',$_GET['key']);
    $pdoSta->execute();
    $candidat = $pdoSta->fetch();

    if(isset($_POST['code_annonce'])){

        $code = $_POST['code_annonce'];
        $name = $_GET['annonce'];

        $query = $bdd->query("SELECT * FROM rh_annonce WHERE code_annonce = '$code'"); 
        $count = $query->rowCount();

        if($count >= 1) 
        {
            $_SESSION['invite'] = $_GET['num'];

            header('Location: candidature-recrutement.php?'.$annonce['link'].'$req=true');
            exit();
        }else{

            header('Location: candidature-recrutement.php?'.$annonce['link'].'&req=false');
            exit();
        }  
    }

    if($annonce['code_annonce'] == ""){
        $locked = "red";
        $none_bts = "";
        $none_btd = "none-validation";
    }else{
        if(empty($_SESSION['invite'])){
            $locked = "red";
            $none_bts = "";
            $none_btd = "none-validation";
        }else{
            $locked = "green";
            $none_bts = "none-validation";
            $none_btd = "";
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
    <title>Annonce de recrutement</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
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
    .text_a{color: grey; cursor: pointer;}
    .text_a:hover{color: orange;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: <?= $annonce['color_annonce'] ?>;">
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
                        <li class="dropdown dropdown-user nav-item">
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" style="cursor: pointer; font-size: 25px; color: <?= $locked ?>;" data-toggle="modal" data-target="#info"><i class='bx bxs-lock'></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding: 0px; margin: 0px;">
            <div class="content-body">
                <div class="form-group">
                    <div class="form-group text-center">
                        <h4>Etape 3 - Téléchargement des fichiers</h4>
                    </div>
                    <div class="form-group">
                        <h5 style='padding-left: 20px;'>Annonce N°<?= $annonce['id'] ?> - <?= $annonce['name_annonce'] ?> - <?php if($candidat['sexe_candidat'] == "femme"){echo "Mme ".$candidat['nom_candidat']."";}else{echo 'Mr '.$candidat['nom_candidat'].'';} ?> <p style="display: inline; color: <?php if($annonce['statut'] == "actif"){echo "green";}else{echo 'red';} ?>;">(<?php if($annonce['statut'] == "actif"){echo "Actif";}else{echo 'En pause';} ?>)</p></h5>
                    </div>
                    <div class="form-group" style='padding-left: 20px;'>
                        <div class="form-group line">
                            <h4>CONDITIONS D'ACCEPTATIONS</h4>
                        </div>
                        <div class="form-group">
                            <p>Les documents demandé devront respecter l'intégralité des condictions sous peine d'un refus de création d'entreprise.</p>
                            <div class="form-group">
                                <p>Les documents devront :</p>
                                <label> - Être fournie sous un format numérique de préférence en PDF. (PNG, JPG, JPEG)</label><br>
                                <label> - Être fournie en intégralité (Tous les bords visibles)</label><br>
                                <label> - Être fournie en couleur de préférence.</label><br>
                                <label> - Être parfaitement net et visible</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col border <?php if($candidat['cv_doc'] !== ""){echo "none-validation";} ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Dépot de votre CV</label>                   
                            </div>
                            <div class="form-group">
                                <a href="https://www.cidj.com/emploi-jobs-stages/nos-conseils-pour-trouver-un-job-ou-un-emploi/comment-rediger-son-cv-pour-trouver-un-emploi" target="_blank"><small class="text_a">Comment bien réaliser son cv ?</small></a>
                            </div>
                            <div class="form-group">
                                <label>Mon cv</label>
                                <a href="candidature-recrutement-files-two.php?key=<?= $_GET['key'] ?>&document=cv"><div class="custom-file" style="cursor: pointer;">
                                    <input class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                </div></a>
                            </div>
                        </div>
                        <div class="col border <?php if($candidat['cv_doc'] == ""){echo "none-validation";} ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Cv déja deposé !</label>                   
                            </div>
                            <div class="form-group">
                                <hr>
                            </div>
                            <div class="form-group">
                                <p><?= $candidat['cv_doc'] ?> <a href="../../../src/recrutement/cv/<?= $candidat['cv_doc'] ?>" download><i class="bx bx-download"></i></a></p>
                            </div>
                        </div>
                        <div class="col border <?php if($candidat['lettredemotivation_doc'] !== ""){echo "none-validation";} ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Dépot de la lettre de motivation</label>                   
                            </div>
                            <div class="form-group">
                                <a href="https://www.jobup.ch/fr/job-coach/conseils-checklistes/comment-rediger-une-bonne-lettre-de-motivation/" target="_blank"><small class="text_a">Comment bien écrire ma lettre de motivation ?</small></a>
                            </div>
                            <div class="form-group">
                                <label>Ma lettre de motivation</label>
                                <a href="candidature-recrutement-files-two.php?key=<?= $_GET['key'] ?>&document=lettredemotivation"><div class="custom-file" style="cursor: pointer;">
                                    <input class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                </div></a>
                            </div>
                        </div>
                        <div class="col border <?php if($candidat['lettredemotivation_doc'] == ""){echo "none-validation";} ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Lettre de motivation déja deposé !</label>                   
                            </div>
                            <div class="form-group">
                                <hr>
                            </div>
                            <div class="form-group">
                                <p><?= $candidat['lettredemotivation_doc'] ?> <a href="../../../src/recrutement/lzttredemotivation/<?= $candidat['lettredemotivation_doc'] ?>" download><i class="bx bx-download"></i></a></p>
                            </div>
                        </div>
                        <div class="col border <?php if($candidat['other_doc'] !== ""){echo "none-validation";} ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Dépot de documents supplementaires</label>                   
                            </div>
                            <div class="form-group">
                                <br>
                            </div>
                            <div class="form-group">
                                <label>Autres documents</label>
                                <a href="candidature-recrutement-files-two.php?key=<?= $_GET['key'] ?>&document=other"><div class="custom-file" style="cursor: pointer;">
                                    <input class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                </div></a>
                            </div>
                        </div>
                        <div class="col border <?php if($candidat['other_doc'] == ""){echo "none-validation";} ?>" style="margin: 50px; background-color: #d7cfcd; border-radius: 10px;">
                            <div class="form-group text-center" style="padding-top: 20px;">
                                <label>Cv déja deposé !</label>                   
                            </div>
                            <div class="form-group">
                                <hr>
                            </div>
                            <div class="form-group">
                                <p><?= $candidat['other_doc'] ?> <a href="../../../src/recrutement/other/<?= $candidat['other_doc'] ?>" download><i class="bx bx-download"></i></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <!-- Button trigger for default modal -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#defaultSize">
                        Validation de votre candidature
                    </button>

                    <!--Default size Modal -->
                    <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel18">Félicitation !</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="bx bx-x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Vous aurez la possibilitée de voir le suivit de votre candidature avec les informations
                                    suivante : <br><br>
                                    Clé d'authentification : <?= $explode[0] ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Annuler</span>
                                    </button>
                                    <a href="https://www.google.com/"><button type="button" class="btn btn-success ml-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Confirmer</span>
                                    </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--Modal lg size -->
                </div>
            </div>
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
    <script src="../../../app-assets/js/scripts/modal/components-modal.js"></script>
    <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>