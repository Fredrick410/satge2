<?php 

require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id']);
    $pdoStat->execute();
    $entreprise = $pdoStat->fetch();

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
    <title>Ajouter article</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/jkanban/jkanban.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
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
    <?php $btnreturn = true;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <br><br><br><br><br>
    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->
    
    <!-- BEGIN: Content-->
    <?php foreach ($entreprise as $entreprisee): ?>
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
                                            <i class='bx bxs-purchase-tag-alt'></i><span class="d-none d-sm-block">Ajouter un article</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">

                                        <!-- users edit media object start -->


                                        <!-- <form action="php/insert_image_edit.php" method="POST" enctype="multipart/form-data">
                                        <div class="media mb-2">
                                            <a class="mr-2" href="#">
                                                <img src="../../../src/img/<?= $entreprisee['img_entreprise'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Image du fournisseur</h4>
                                                <div class="col-12 px-0 d-flex">
                                                    <input type="file" name="FILES" accept="image/png, image/jpg, image/jpeg" required>                                                   
                                                </div><br>
                                                <input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary">
                                            </div>
                                        </div>
                                        </form> -->


                                        <!-- users edit media object ends -->



                                        <!-- users edit account form start -->
                            <form action="php/insert_article.php" method="POST">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Désignation :</label>
                                                            <input name="article" type="text" class="form-control" placeholder="Désignation de l'article" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Unités de mesure :</label>
                                                            <input name="umesure" type="text" class="form-control" placeholder="Unités de mesure">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Référence de l'article :</label>
                                                        <input name="referencearticle" type="text" class="form-control" placeholder="Référence de l'article">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                 <hr><style>.line{text-decoration: underline;}</style>
                                                </div>
                                                <div class="col-12 col-sm-6  border">
                                                    <div class="form-group text-center">
                                                        <div class="controls">
                                                            <h4 class="line">VENTE</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6  border">
                                                    <div class="form-group text-center">
                                                        <h4 class="line">ACHAT</h4>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 border">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Prix de vente HT :</label>
                                                            <input name="prixvente" type="number" step="any" class="form-control" placeholder="Prix de vente de l'article">
                                                        </div>
                                                        <div class="controls">
                                                            <label>Tva vente :</label>
                                                            <fieldset class="invoice-address form-group">
                                                            <select name="tvavente" class="form-control invoice-item-select">
                                                                <option value="20">Taux normal : 20 %</option>
                                                                <option value="10">Taux intermédiaire : 10 %</option>
                                                                <option value="5.5">Taux réduit : 5.5 %</option>
                                                                <option value="2.1">Taux particulier : 2.1 %</option>
                                                                <option value="0">Taux nul : 0 %</option>
                                                            </select>
                                                        </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 border">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Cout d'achat HT :</label>
                                                            <input name="coutachat" type="number" step="any" class="form-control" placeholder="Cout d'achat de l'article">
                                                        </div>
                                                        <div class="controls">
                                                            <label>Tva achat :</label>
                                                            <fieldset class="invoice-address form-group">
                                                            <select name="tvaachat" class="form-control invoice-item-select">
                                                                <option value="20">Taux normal : 20 %</option>
                                                                <option value="10">Taux intermédiaire : 10 %</option>
                                                                <option value="5.5">Taux réduit : 5.5 %</option>
                                                                <option value="2.1">Taux particulier : 2.1 %</option>
                                                                <option value="0">Taux nul : 0 %</option>
                                                            </select>
                                                        </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
                                                </div>
                                                <label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
                                            </div>
                                        <!-- users edit account form ends -->
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
    <?php endforeach; ?>


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