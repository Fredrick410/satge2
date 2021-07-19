<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'gestionnaire fiscal');
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdoSta = $bdd->prepare('SELECT * FROM other_declaration WHERE type_declaration=:type_declaration AND id_session=:num');
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->bindValue(':type_declaration',"decla_cfe", PDO::PARAM_INT);
    $pdoSta->execute();
    $cfe_decla = $pdoSta->fetchAll();
    $count_cfe_decla = count($cfe_decla);

?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Autres Déclaration - <?= $entreprise['nameentreprise'] ?></title>
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../app-assets/css/pages/dsn-upload.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
.none-validation{display: none;}
.closee{padding: 20px; font-size: 25px;}
.closee:hover{color: red;}
.cursor{cursor: pointer;}
.cursor:hover{color: black;}
</style>

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style='background-color: #e72424;'>
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                    <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding-top: 0px; margin-top: 0px;">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="dashboard-admin.php"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="declarationother.php">Autres déclarations</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#"><?= $entreprise['nameentreprise'] ?></a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="">Ajouter une déclaration fiscale</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <h6>Ajouter une déclaration CFE ! <h6 style="color: red; display: <?php if($count_cfe_decla > 0){echo "inline";}else{echo "none";} ?>;">Déja déposé ❤️</h6></h6>
                                                <a href="declarationother-upload.php?num=<?= $_GET['num'] ?>&document=decla_cfe"><button class="btn btn-danger mr-1 mb-1 <?php if($count_cfe_decla > 0){echo "none-validation";} ?>" type="button">Télécharger la déclaration</button></a>
                                                <hr>
                                            </div>
                                            <div class="form-group">
                                                <h6>Ajouter une déclaration ... (SOON) !</h6>
                                                <button class="btn btn-danger mr-1 mb-1" type="button" disabled>Télécharger la déclaration</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card" style="background-color: rgba(128, 128, 128, .5);">
                                <div class="card-header" style="text-align: center; position: relative; top: 40%;">
                                    <h5 class="">Activitée recent (SOON)</h4>
                                </div>
                                <div class="card-content">

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic Horizontal form layout section end -->

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5 class="">Tous les documents</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <h5><u>Déclaration CFE :</u></h5>
                                            </div>
                                            <div class="form-group <?php if($count_cfe_decla > 0){echo "";}else{echo "none-validation";} ?>">
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
                                                                    <div class="app-file-type font-size-small text-muted"><a href="../../../src/other_declaration/<?php foreach($cfe_decla as $cfe_declas): ?><?= $cfe_declas['files_other'] ?> <?php endforeach; ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/other_declaration/<?php foreach($cfe_decla as $cfe_declas): ?><?= $cfe_declas['files_other'] ?> <?php endforeach; ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_other_declaration.php?id=<?= $_GET['num'] ?>&num=<?php foreach($cfe_decla as $cfe_declas): ?><?= $cfe_declas['id'] ?> <?php endforeach; ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center <?php if($count_cfe_decla > 0){echo "none-validation";} ?>">
                                                <h6 class="text-muted">Aucune déclaration CFE</h6>
                                            </div>
                                            <div class="form-group">
                                                <br>
                                            </div>
                                            <div class="form-group">
                                                <h5 class=""><u>Déclaration other ... (SOON) :</u></h5>
                                            </div>
                                            <!-- <div class="form-group">
                                                <div class="col-sm" s>
                                                    <div class="card border shadow-none mb-1 app-file-info text-center">
                                                        <div class="card-content">
                                                            <div class="app-file-content-logo card-img-top">
                                                                <img class="d-block mx-auto" src="../../../app-assets/images/icon/doc.png" height="38" width="30" alt="Card image cap">
                                                            </div>
                                                            <div class="card-body p-50">
                                                                <div class="app-file-details">
                                                                    <div class="app-file-name font-size-small font-weight-bold">Autres document</div>
                                                                    <div class="app-file-size font-size-small text-muted mb-25"><?= date('d/m/Y'); ?></div>
                                                                    <div class="app-file-type font-size-small text-muted"><i class='bx bx-show-alt cursor'></i>&nbsp&nbsp&nbsp<i class='bx bxs-download cursor'></i>&nbsp&nbsp&nbsp<i class='bx bxs-trash cursor' ></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script>
        function conf(){
            document.getElementById('div_conf').style.display = "block";
        }

        function overplay(){
            document.getElementById('div_conf').style.display = "none";
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/creation-upload.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>