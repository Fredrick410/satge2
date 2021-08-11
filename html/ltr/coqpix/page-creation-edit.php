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


    if(!empty($_GET['suppression'])){

        $disparition = "harrypottergood";

        if($_GET['suppression'] == "3"){
            $message = "Changement de mot de passe avec succès ✔️";
        }
        if($_GET['suppression'] == "2"){
            $message = "Ancien mot de passe incorrect ❌";
        }
        if($_GET['suppression'] == "1"){
            $message = "Les nouveaux mot de passe ne correspond pas ❌";
        }
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
    <title>Création de société - Mon compte</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/validation/form-validation.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-creation-edit.css">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
     
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="form-group">
                                 <div class="livicon-evo" onclick="retourn()" data-options=" name: arrow-left.svg; size: 30px " style="color: #051441; cursor: pointer; display:inline-block; top: 6px;"></div>
                                        <script>
                                            function retourn() {
                                                document.location.href="page-creation.php";
                                            }
                                        </script>
                                <label class="" style="color: #051441;">Retour à l'accueil</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <!-- left menu section -->
                                <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center active" id="account-pill-dirigeant" data-toggle="pill" href="#account-vertical-dirigeant" aria-expanded="true">
                                                <i class="bx bx-user"></i>
                                                <span>Dirigeant</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="account-pill-entreprise" data-toggle="pill" href="#account-vertical-entreprise" aria-expanded="false">
                                                <i class="bx bx-buildings"></i>
                                                <span>Entreprise</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                                <i class="bx bx-lock"></i>
                                                <span>Changer de mot de passe</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- right content section -->
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-dirigeant" aria-labelledby="account-pill-dirigeant" aria-expanded="true">
                                                        <!-- ESPACE IMAGE -->
                                                        <!-- <div class="media">
                                                            <a href="javascript: void(0);">
                                                                <img src="../../../app-assets/images/portrait/small/avatar-s-16.jpg" class="rounded mr-75" alt="profile image" height="64" width="64">
                                                            </a>
                                                            <div class="media-body mt-25">
                                                                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                    <label for="select-files" class="btn btn-sm btn-light-primary ml-50 mb-50 mb-sm-0">
                                                                        <span>Upload new photo</span>
                                                                        <input id="select-files" type="file" hidden>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr> -->
                                                        <form action="php/edit_crea_client.php" method="POST">
                                                            <input type="hidden" name="id" value="<?= $crea['id'] ?>">
                                                            <div class="row">
                                                            <input name="status_crea" value="<?= $crea['status_crea'] ?>" hidden>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Prénom du dirigeant</label>
                                                                            <input type="text" name="prenom_diri" class="form-control border rounded-pill border-dark" placeholder="Name" value="<?= $crea['prenom_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Nom du dirigeant</label>
                                                                            <input type="text" name="nom_diri" class="form-control border rounded-pill border-dark" placeholder="Nom du dirigeant" value="<?= $crea['nom_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Téléphone du dirigeant</label>
                                                                        <br>
                                                                        <input onchange='process(event)' type="text" name="tel_temp" id="tel_temp" class="form-control border rounded-pill border-dark" value="<?= $crea['tel_diri'] ?>" required>
                                                                        <input type="text" name="tel_diri" id="tel_diri" value="<?= $crea['tel_diri'] ?>" hidden required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>E-mail (Identifiant de connexion)</label>
                                                                            <input type="email" name="email_crea" class="form-control border rounded-pill border-dark" placeholder="Email de connexion" value="<?= $crea['email_crea'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Adresse du dirigeant</label>
                                                                            <input type="text" name="adresse_diri" class="form-control border rounded-pill border-dark" placeholder="Ex: 2 Rue de Rivoli" value="<?= $crea['adresse_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Ville</label>
                                                                            <input type="text" name="ville_diri" class="form-control border rounded-pill border-dark" placeholder="Ex: Paris" value="<?= $crea['ville_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Code Postal</label>
                                                                            <input type="text" name="cp_diri" class="form-control border rounded-pill border-dark" placeholder="Ex: 75004" value="<?= $crea['cp_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Confirmation du mail -->
                                                                <!-- <div class="col-12">
                                                                    <div class="alert bg-rgba-warning alert-dismissible mb-2" role="alert">
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                        <p class="mb-0">
                                                                            Your email is not confirmed. Please check your inbox.
                                                                        </p>
                                                                        <a href="javascript: void(0);">Resend confirmation</a>
                                                                    </div>
                                                                </div> -->
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
                                                                <div class="col-12 <?php echo $good; ?>">
                                                                    <div class="form-group">
                                                                        <hr>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Enregistrement effectué 👍🏽</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 <?php echo $disparition; ?>">
                                                                    <div class="form-group">
                                                                        <hr>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label><?php echo $message; ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1 border rounded-pill border-dark">Sauvegarder</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="account-vertical-entreprise" role="tabpanel" aria-labelledby="account-pill-entreprise" aria-expanded="false">
                                                        <form action="php/edit_crea_entreprise.php" method="POST">
                                                            <input type="hidden" name="id" value="<?= $crea['id'] ?>">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Nom de l'entreprise (Non-modifiable)</label>
                                                                            <input type="text" name="name_crea" id="name_crea" class="form-control border rounded-pill border-dark" placeholder="" value="<?= $crea['name_crea'] ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>                                    
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Forme juridique</label>
                                                                            <fieldset class="invoice-address form-group">
                                                                                <select name="status_crea" class="form-control invoice-item-select border rounded-pill border-dark">
                                                                                    <option value="<?= $crea['status_crea'] ?>" selected>Choisir une forme juridique</option>
                                                                                    <optgroup label="Morale">
                                                                                        <option value="SARL">SARL</option>
                                                                                        <option value="SAS">SAS</option>
                                                                                        <option value="SASU">SASU</option>
                                                                                        <option value="SCI">SCI</option>
                                                                                        <option value="EURL">EURL</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="Physique">
                                                                                        <option value="EIRL">EIRL</option>
                                                                                        <option value="EI">EI</option>
                                                                                        <option value="Micro-entreprise">Micro-entreprise</option>
                                                                                    </optgroup> 
                                                                                </select>
                                                                            <small>La forme juridique est obligatoire pour la suite de la création de votre entreprise pour plus d'informations concernant celle-ci contactez-nous via le chat mis à votre disposition.</small>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Secteur d'activité</label>
                                                                            <input type="text" name="secteur_dactivite" id="secteur_dactivite" class="form-control border rounded-pill border-dark" placeholder="" value="<?= $crea['secteur_dactivite'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1 border rounded-pill border-dark">Sauvegarder</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                        <form action="php/edit_password_crea.php" method="POST">
                                                            <input name="id" type="hidden" value="<?= $crea['id'] ?>">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Ancien mot de passe</label>
                                                                            <input type="password" name="lastpassword" class="form-control border rounded-pill border-dark" placeholder="Votre ancien mot de passe">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Nouveaux mot de passe</label>
                                                                            <input type="password" name="password" class="form-control border rounded-pill border-dark" placeholder="Votre nouveaux mot de passe">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Repeter le mot de passe</label>
                                                                            <input type="password" name="con-password" class="form-control border rounded-pill border-dark" placeholder="Votre nouveaux mot de passe">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1 border rounded-pill border-dark">Sauvegarder</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>



    <script>
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
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-account-settings.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>