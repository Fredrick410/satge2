<?php

session_start();

if(!empty($_SESSION['id']) && (!empty($_SESSION['id_session'])) || (!empty($_SESSION['id_admin'])))
{
   //l'utilisateur est connecté
}
else
{  
   sleep(2);
   header('Location: ../../../');
   exit;
}

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
   
    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $entreprise = $pdoStat->fetch();

    $pdoStat = $bdd->prepare('SELECT * FROM other_declaration WHERE id_session = :num AND type_declaration=:type_declaration');
    $pdoStat->bindValue(':num',$_SESSION['id_session']);
    $pdoStat->bindValue(':type_declaration',"decla_cfe");
    $pdoStat->execute();
    $cfe_decla = $pdoStat->fetchAll();
    $count_cfe_decla = count($cfe_decla);

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
    <title>Autres Déclarations - Coqpix</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/swiper.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">
<style>
    .none-validation{display: none;}
    .iconi{position: relative; top: 3px; cursor: pointer; color: green;}
    .iconi:hover{opacity: 0.5;}
</style>
    <!-- BEGIN: Header-->
    <?php $btnreturn = true;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- coverflow effect swiper start -->
                <section id="component-swiper-coverflow">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Déclaration CFE</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-group <?php if($count_cfe_decla > 0){echo "none-validation";} ?>">
                                    <p>Vous avez la possibilité de stocker votre déclaration CFE dans cet espace de Coqpix.</p>
                                    <p>Mettre en ligne ma déclaration CFE</p><a href="declarationother-upload.php?num=<?= $_SESSION['id_session'] ?>&document=decla_cfe"><button class="btn btn-danger mr-1 mb-1" type="button">Uploader ma déclaration</button></a>
                                </div>
                                <div class="form-group <?php if($count_cfe_decla > 0){}else{echo "none-validation";} ?>">
                                    <p>Télécharger, visualiser votre déclaration cfe avec les icones <i class='bx bx-show-alt cursor iconi'></i> et <i class='bx bxs-download cursor iconi'></i></p>
                                    <div class="form-group">
                                        <div class="col-sm">
                                            <div class="card border shadow-none mb-1 app-file-info text-center">
                                                <div class="card-content">
                                                    <div class="app-file-content-logo card-img-top">
                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/doc.png" height="38" width="30" alt="Card image cap">
                                                    </div>
                                                    <div class="card-body p-50">
                                                        <div class="app-file-details">
                                                            <div class="app-file-name font-size-small font-weight-bold"><?php foreach($cfe_decla as $cfe_declas): ?> <?= $cfe_declas['files_other'] ?> <?php endforeach; ?></div>
                                                            <div class="app-file-size font-size-small text-muted mb-25"><?php foreach($cfe_decla as $cfe_declas): ?> <?= $cfe_declas['dte'] ?> <?php endforeach; ?></div>
                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/other_declaration/<?php foreach($cfe_decla as $cfe_declas): ?><?= $cfe_declas['files_other'] ?> <?php endforeach; ?>" target="_blank"><i class='bx bx-show-alt cursor'></i></a>&nbsp&nbsp&nbsp<a href="../../../src/other_declaration/<?php foreach($cfe_decla as $cfe_declas): ?><?= $cfe_declas['files_other'] ?> <?php endforeach; ?>" download><i class='bx bxs-download cursor'></i></a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Si par erreur vous avez upload le mauvais document contacter le support via l'espace dédié en cliquant <a href="support-chat.php"><label style="color: red; cursor: pointer;">ici</label></a></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- coverflow effect swiper ends -->
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
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/extensions/swiper.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>