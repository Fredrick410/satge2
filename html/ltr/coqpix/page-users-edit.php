<?php 

require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $query = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $query->bindValue(':numentreprise',$_SESSION['id']);
    $query->execute();
    $entreprise = $query->fetch();

    $query = $bdd->prepare('SELECT * FROM membres WHERE id = :id_membre');
    $query->bindValue('id_membre', $_SESSION['id_membre']);
    $query->execute();
    $membre = $query->fetch();

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
    <title>Listes Membres</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">

    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="h-auto card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Info Société</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                            <i class="bx bx-info-circle mr-25"></i><span class="d-none d-sm-block">Mes informations</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->
                                        <form action="php/insert_image.php" method="POST" enctype="multipart/form-data">
                                            <div class="media mb-2">
                                                <a class="mr-2" href="#">
                                                    <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading">Image de l'entreprise</h4>
                                                    <div class="col-12 px-0 d-flex">
                                                        <input type="file" accept="image/png, image/jpg, image/jpeg" name="FILES" required>                                                   
                                                    </div><br>
                                                    <input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form action="php/edit_profile_1.php" method="POST">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Nom de la société :</label>
                                                            <input name="nameentreprise" type="text" class="form-control" placeholder="Nom de la société" value="<?= $entreprise['nameentreprise']; ?>" required data-validation-required-message="Le nom d'entreprise est imcomplet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Numéros Siret :</label>
                                                            <input name="numerossiret" type="text" class="form-control" placeholder="N°Siret" value="<?= $entreprise['numerossiret']; ?>" required data-validation-required-message="Le nom d'entreprise est imcomplet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Pays de la société :</label>
                                                            <input name="pays_entreprise" type="text" class="form-control" placeholder="Pays" value="<?= $entreprise['pays_entreprise']; ?>" required data-validation-required-message="Pays de la société">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Adresse société :</label>
                                                            <input name="adresseentreprise" type="text" class="form-control" placeholder="Adresse de la societe" value="<?= $entreprise['adresseentreprise']; ?>" required data-validation-required-message="L'adresse de la societe est obligatoire">
                                                        </div><br>
                                                        <label>Secteur d'activité :</label>
                                                        <fieldset class="invoice-address form-group">
                                                            <select name="descr_entreprise" class="form-control invoice-item-select">
                                                                <option value="<?= $entreprise['descr_entreprise'] ?>"><?= $entreprise['descr_entreprise'] ?></option>
                                                                <option value="Agroalimentaire">Agroalimentaire</option>
                                                                <option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
                                                                <option value="Chimie / Parachimie">Chimie / Parachimie</option>
                                                                <option value="Électronique / Électricité">Électronique / Électricité</option>
                                                                <option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
                                                                <option value="Machines et équipements / Automobile">Machines et équipements / Automobile</option>
                                                                <option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
                                                                <option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
                                                                <option value="Banque / Assurance">Banque / Assurance</option>
                                                                <option value="BTP / Matériaux de construction">BTP / Matériaux de construction</option>
                                                                <option value="Commerce / Négoce / Distribution">Commerce / Négoce / Distribution</option>
                                                                <option value="Édition / Communication / Multimédia">Édition / Communication / Multimédia</option>
                                                                <option value="Études et conseils">Études et conseils</option>
                                                                <option value="Informatique / Télécoms">Informatique / Télécoms</option>
                                                                <option value="Métallurgie / Travail du métal">Métallurgie / Travail du métal</option>
                                                                <option value="Transports / Logistique">Transports / Logistique</option>
                                                                <option value="Services aux entreprises">Services aux entreprises</option>
                                                                <option value="Autres">Autres</option>
                                                            </select>
                                                        </fieldset>
                                                        <div class="form-group">
                                                            <label>*Date de cloture :</label>
                                                            <input name="datedecloture" type="date" class="form-control" value="<?= $entreprise['datedecloture'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>*Numéros de téléphone :</label>
                                                        <input name="telentreprise" type="text" class="form-control" placeholder="Numéros de téléphone de la société" value="<?= $entreprise['telentreprise']; ?>" required data-validation-required-message="Le numéros de la société est obligatoire">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Siteweb de la société :</label>
                                                        <input name="link_website" type="text" class="form-control" placeholder="www.monentreprise.fr" value="<?= $entreprise['link_website']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Email Societe :</label>
                                                            <input name="emailentreprise" type="email" class="form-control" placeholder="E-mail de la societe" value="<?= $entreprise['emailentreprise']; ?>" required data-validation-required-message="L'e-mail de la societe obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Début d'activité :</label>
                                                            <input name="datecreation" type="text" placeholder="jj-mm-aa" class="form-control" value="<?= $entreprise['datecreation']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>IBAN :</label>
                                                        <input name="iban_entreprise" type="text" class="form-control" placeholder="FR-" value="<?= $entreprise['iban_entreprise']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <label>Compléter les Infos Dirigeants</label>&nbsp&nbsp<i class='bx bx-right-arrow-alt'></i>
                                                </div>
                                            </div>
                                        <!-- users edit account form ends -->
                                    </div>
                                    <div class="tab-pane fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                        <!-- users edit Info form start -->
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <h5 class="mb-1"><i class="bx bx-link mr-25"></i>Mes informations</h5>

                                                    <!-- <form action="php/insert_image_membre.php" method="POST" enctype="multipart/form-data">
                                                        <div class="media mb-2">
                                                            <a class="mr-2" href="#">
                                                                <img src="../../../src/img/<?= $membre['img_membres'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="media-heading">Mon image de profil</h4>
                                                                <div class="col-12 px-0 d-flex">
                                                                    <input type="file" accept="image/png, image/jpg, image/jpeg" name="FILES" required>                                                   
                                                                </div><br>
                                                                <input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary">
                                                            </div>
                                                        </div>
                                                    </form> -->

                                                    <div class="form-group">
                                                        <label>Nom :</label>
                                                        <input name="nom_membre" class="form-control" type="text" placeholder="Nom" value="<?= $membre['nom']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Prénom :</label>
                                                        <input name="prenom_membre" class="form-control" type="text" placeholder="Prénom" value="<?= $membre['prenom']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Téléphone :</label>
                                                        <input name="tel_membre" class="form-control" type="text" placeholder="Téléphone" value="<?= $membre['tel']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-mail :</label>
                                                        <input name="email_membre" class="form-control" type="text" placeholder="E-mail" value="<?= $membre['email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-1 mt-sm-0">

                                                                    <!-- PUBLICITER -->
                                                    
                                                </div>
                                                <input name="numentreprise" type="hidden" value="<?= $entreprise['id'] ?>">
                                                <input name="id_membre" type="hidden" value="<?= $_SESSION['id_membre'] ?>">
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Valider<i class='bx bx-right-arrow-alt'></i></button>
                                                </div>
                                                <label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
            </div>
        </div>
    </div>

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/jkanban/jkanban.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <script src="../../../app-assets/js/scripts/navs/navs.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>