<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $pdoS = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $membre = $pdoS->fetchAll();

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Ajouter une equipe</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout content-left-sidebar todo-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="<?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout">
<style>
.none-validation{display: none;}
</style>
    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Créer une équipe</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="teams-list.php"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">Projet
                                    </li>
                                    <li style="cursor: pointer;" class="breadcrumb-item active">Nouvelle team
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- vertical Wizard start-->
                <section id="vertical-wizard">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="">Owohwo vous créez une team, Pix veut y participer</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                    <form id="paramgeneral" action="1">
                                        <!-- step 1 -->
                                        <h3>
                                            <span class="fonticon-wrap mr-1">
                                                <i class="livicon-evo" data-options="name:gear.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                            </span>
                                            <span class="icon-title">
                                                <span class="d-block">Paramètre de la team</span>
                                                <small class="text-muted">Configurez les détails de votre team ici.</small>
                                            </span>
                                        </h3>
                                        <!-- step 1 end-->
                                        <!-- step 1 content -->
                                        <fieldset class="pt-0">
                                            <h6 class="pb-50">Entrez les détails de votre team</h6>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="firstName12">Nom de votre équipe <label style="color: red;">*</label></label>
                                                        <input name="name_team" id="id_name_team" type="text" class="form-control" placeholder="Nom de la team" required>
                                                        <small class="text-muted form-text">Entrez votre nom d'équipe s'il vous plait.</small>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="lastName1">Tags de votre équipe</label>
                                                        <input name="tags_name" id="id_tags_name" type="text" class="form-control" placeholder="Tags de votre team">
                                                        <small class="text-muted form-text">Les tags vont permettre vous distinguez des autres équipes, Soyez les plus originaux !</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="emailAddress12">E-mail <label style="color: red;">*</label></label>
                                                        <input name="email_team" id="id_email_team" type="email" class="form-control" placeholder="Entez votre email de team" required>
                                                        <small class="text-muted form-text">L'e-mail de team va permettre l'échange important entre coéquipiers.</small>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Téléphone de contact <label style="color: red;">*</label></label>
                                                        <input name="tel_team" id="id_tel_team" type="tel" class="form-control" placeholder="06 00 00 00 00" required>
                                                        <small class="text-muted form-text">Le numéro est très important, l'échange au téléphone permet la résolution de beaucoup de problèmes.</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button id="bt_formone" class="btn btn-success glow mr-1 mb-1" type="submit">Prochaine étape <i class='bx bx-right-arrow-circle'></i></button>
                                                <div class="none-validation" id="loader">
                                                    <img src="../../../app-assets/images/ico/ajax-loader.gif" alt="loading">
                                                </div>
                                                <div class="alert bg-rgba-success alert-dismissible text-center none-validation" id="message_good">
                                                    <i class="bx bx-like"></i>
                                                    <span>Votre groupe a bien été créé, ajouter maintenant des membres 🤠</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <!-- step 1 content end-->                                
                                    <!-- section 3 -->
                                    <div id="add_membre" class="none-validation">
                                        <div class="form-group">
                                            <hr>
                                        </div>  
                                        <h3>
                                            <span class="fonticon-wrap mr-1">
                                                <i class="livicon-evo" data-options="name:users.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                            </span>
                                            <span class="icon-title">
                                                <small class="text-muted">Ajouter des membres à votre team.</small>
                                            </span>
                                            <div class="form-group">
                                                <br>
                                            </div>
                                        </h3>
                                        <!-- step 3 content -->
                                        <fieldset class="pt-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form id="parammembre" action="">
                                                        <input name="team_num" id="id_team" type="hidden">
                                                        <div class="form-group">
                                                            <label>Selectionnez les membres de la team :</label>
                                                            <select id="name_membre" name="name_membre" class="form-control">
                                                                    <option value="Pix prend la place de votre membre 👅">Selectionnez un membre</option>
                                                                <?php foreach($membre as $membres): ?>
                                                                    <option value="<?= $membres['nom'] ?> <?= $membres['prenom'] ?>"><?= $membres['nom'] ?> <?= $membres['prenom'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <button id="btn_submit" class="btn btn-outline-success round mr-1 mb-1" type="button"> Ajouter</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row custom-line imgprof">

                                            </div>
                                            <div class="form-group">
                                                <br>
                                                <a href="teams-list.php"><button id="btn_submit" class="btn btn-light-info mr-1 mb-1" type="button"> Terminer</button></a>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <!-- step 3 content end-->
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- vertical Wizard end-->

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
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/team_add.js"></script>
    <!-- END: Page JS-->
        <!-- TIMEOUT -->
        <?php include('timeout.php'); ?>
</body>
<!-- END Body-->

</html>