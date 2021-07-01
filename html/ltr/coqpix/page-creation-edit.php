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
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout">
<style>

.harrypotter{display: none;}
.harrypottergood{display: block;}
.vert{color: #12ff3a;}

</style>
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
                            <h5 class="content-header-title float-left pr-1 mb-0">Paramètre du compte</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="page-creation.php"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active"> Paramètre du compte
                                    </li>
                                </ol>
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
                                            <a class="nav-link d-flex align-items-center active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                                <i class="bx bx-cog"></i>
                                                <span>General</span>
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
                                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
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

                                                                <?php 
                                                                
                                                                if($crea['status_crea'] == ""){
                                                                    $validation = "harrypottergood";
                                                                }else{
                                                                    $validation = "harrypotter";
                                                                }

                                                                ?>

                                                                <div class="<?php echo $validation; ?>">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <input type="button" class="btn btn-danger" value="⚠️POUR ACCEDER A L'INSERTION DE DOCUMENTS VOUS DEVEZ CHOISIR UNE FORME JURIDIQUE" disable>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Forme juridique ⚠️</label>
                                                                            <fieldset class="invoice-address form-group">
                                                                                <select name="status_crea" class="form-control invoice-item-select">
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
                                                                    <hr>
                                                                </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Nom de l'entreprise (Non-modifiable)</label>
                                                                            <input type="text" name="name_crea" id="name_crea" class="form-control" placeholder="" value="<?= $crea['name_crea'] ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Prénom du dirigeant</label>
                                                                            <input type="text" name="prenom_diri" class="form-control" placeholder="Name" value="<?= $crea['prenom_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Nom du dirigeant</label>
                                                                            <input type="text" name="nom_diri" class="form-control" placeholder="Nom du dirigeant" value="<?= $crea['nom_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Téléphone du dirigeant</label>
                                                                        <br>
                                                                        <input onchange='process(event)' type="text" name="tel_temp" id="tel_temp" class="form-control" value="<?= $crea['tel_diri'] ?>" required>
                                                                        <input type="text" name="tel_diri" id="tel_diri" hidden required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>E-mail (Identifiant de connexion)</label>
                                                                            <input type="email" name="email_crea" class="form-control" placeholder="Email de connexion" value="<?= $crea['email_crea'] ?>" required>
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
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Sauvegarder</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                        <form action="php/edit_password_crea.php" method="POST">
                                                            <input name="id" type="hidden" value="<?= $crea['id'] ?>">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Ancien mot de passe</label>
                                                                            <input type="password" name="lastpassword" class="form-control" placeholder="Votre ancien mot de passe">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Nouveaux mot de passe</label>
                                                                            <input type="password" name="password" class="form-control" placeholder="Votre nouveaux mot de passe">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Repeter le mot de passe</label>
                                                                            <input type="password" name="con-password" class="form-control" placeholder="Votre nouveaux mot de passe">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Sauvegarder</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                        <form novalidate>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Bio</label>
                                                                        <textarea class="form-control" id="accountTextarea" rows="3" placeholder="Your Bio data here..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Birth date</label>
                                                                            <input type="text" class="form-control birthdate-picker" required placeholder="Birth date" data-validation-required-message="This birthdate field is required">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <select class="form-control" id="accountSelect">
                                                                            <option>USA</option>
                                                                            <option>India</option>
                                                                            <option>Canada</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Languages</label>
                                                                        <select class="form-control" id="languageselect2" multiple="multiple">
                                                                            <option value="English" selected>English</option>
                                                                            <option value="Spanish">Spanish</option>
                                                                            <option value="French">French</option>
                                                                            <option value="Russian">Russian</option>
                                                                            <option value="German">German</option>
                                                                            <option value="Arabic" selected>Arabic</option>
                                                                            <option value="Sanskrit">Sanskrit</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>Phone</label>
                                                                            <input type="text" class="form-control" required placeholder="Phone number" value="(+656) 254 2568" data-validation-required-message="This phone number field is required">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Website</label>
                                                                        <input type="text" class="form-control" placeholder="Website address">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Favourite Music</label>
                                                                        <select class="form-control" id="musicselect2" multiple="multiple">
                                                                            <option value="Rock">Rock</option>
                                                                            <option value="Jazz" selected>Jazz</option>
                                                                            <option value="Disco">Disco</option>
                                                                            <option value="Pop">Pop</option>
                                                                            <option value="Techno">Techno</option>
                                                                            <option value="Folk" selected>Folk</option>
                                                                            <option value="Hip hop">Hip hop</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Favourite movies</label>
                                                                        <select class="form-control" id="moviesselect2" multiple="multiple">
                                                                            <option value="The Dark Knight" selected>The Dark Knight
                                                                            </option>
                                                                            <option value="Harry Potter" selected>Harry Potter</option>
                                                                            <option value="Airplane!">Airplane!</option>
                                                                            <option value="Perl Harbour">Perl Harbour</option>
                                                                            <option value="Spider Man">Spider Man</option>
                                                                            <option value="Iron Man" selected>Iron Man</option>
                                                                            <option value="Avatar">Avatar</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                        changes</button>
                                                                    <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade " id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Twitter</label>
                                                                        <input type="text" class="form-control" placeholder="Add link" value="https://www.twitter.com">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Facebook</label>
                                                                        <input type="text" class="form-control" placeholder="Add link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Google+</label>
                                                                        <input type="text" class="form-control" placeholder="Add link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>LinkedIn</label>
                                                                        <input type="text" class="form-control" placeholder="Add link" value="https://www.linkedin.com">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Instagram</label>
                                                                        <input type="text" class="form-control" placeholder="Add link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Quora</label>
                                                                        <input type="text" class="form-control" placeholder="Add link">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                        changes</button>
                                                                    <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="account-vertical-connections" role="tabpanel" aria-labelledby="account-pill-connections" aria-expanded="false">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <a href="javascript: void(0);" class="btn btn-info">Connect to
                                                                    <strong>Twitter</strong></a>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 my-2">
                                                                <button class=" btn btn-sm btn-light-secondary float-right">edit</button>
                                                                <h6>You are connected to facebook.</h6>
                                                                <p>Johndoe@gmail.com</p>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 my-2">
                                                                <a href="javascript: void(0);" class="btn btn-danger">Connect to
                                                                    <strong>Google</strong>
                                                                </a>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 my-2">
                                                                <button class=" btn btn-sm btn-light-secondary float-right">edit</button>
                                                                <h6>You are connected to Instagram.</h6>
                                                                <p>Johndoe@gmail.com</p>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                    changes</button>
                                                                <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                                        <div class="row">
                                                            <h6 class="m-1">Activity</h6>
                                                            <div class="col-12 mb-1">
                                                                <div class="custom-control custom-switch custom-control-inline">
                                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch1">
                                                                    <label class="custom-control-label mr-1" for="accountSwitch1"></label>
                                                                    <span class="switch-label w-100">Email me when someone comments
                                                                        onmy
                                                                        article</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-1">
                                                                <div class="custom-control custom-switch custom-control-inline">
                                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch2">
                                                                    <label class="custom-control-label mr-1" for="accountSwitch2"></label>
                                                                    <span class="switch-label w-100">Email me when someone answers on
                                                                        my
                                                                        form</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-1">
                                                                <div class="custom-control custom-switch custom-control-inline">
                                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch3">
                                                                    <label class="custom-control-label mr-1" for="accountSwitch3"></label>
                                                                    <span class="switch-label w-100">Email me hen someone follows
                                                                        me</span>
                                                                </div>
                                                            </div>
                                                            <h6 class="m-1">Application</h6>
                                                            <div class="col-12 mb-1">
                                                                <div class="custom-control custom-switch custom-control-inline">
                                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch4">
                                                                    <label class="custom-control-label mr-1" for="accountSwitch4"></label>
                                                                    <span class="switch-label w-100">News and announcements</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-1">
                                                                <div class="custom-control custom-switch custom-control-inline">
                                                                    <input type="checkbox" class="custom-control-input" id="accountSwitch5">
                                                                    <label class="custom-control-label mr-1" for="accountSwitch5"></label>
                                                                    <span class="switch-label w-100">Weekly product updates</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-1">
                                                                <div class="custom-control custom-switch custom-control-inline">
                                                                    <input type="checkbox" class="custom-control-input" checked id="accountSwitch6">
                                                                    <label class="custom-control-label mr-1" for="accountSwitch6"></label>
                                                                    <span class="switch-label w-100">Weekly blog digest</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                    changes</button>
                                                                <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                            </div>
                                                        </div>
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