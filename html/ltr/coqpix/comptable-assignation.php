<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise');
    $pdoSta->execute();
    $entreprise = $pdoSta->fetchAll();

    $pdoSta = $bdd->prepare('SELECT * FROM comptable WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $comptable = $pdoSta->fetch();

    $pdoSta = $bdd->prepare('SELECT * FROM comptable_list WHERE id_comptable=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $comptable_list = $pdoSta->fetchAll();
    $count_comptable_list = count($comptable_list);

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
    <title>Assignation comptable - Coqpix</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="layout">
<style>
    .none-validation{display: none;}
    .icone{color: grey;}
    .icone:hover{cursor: pointer; color: #FF5B5C;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #f3e53c;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix2.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none text-black"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
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

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_backend.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="form-group">
                    <div class="alert bg-rgba-success alert-dismissible mb-2 col-6 <?php if(empty($_GET['req'])){echo "none-validation";}else{if($_GET['req'] !== "mAB3Pk632v"){echo "none-validation";}} ?>" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="d-flex align-items-center">
                            <i class="bx bx-like"></i>
                            <span>
                                L'opération d'assignation a bien était réalisé bravo !
                            </span>
                        </div>
                    </div>
                    <div class="alert bg-rgba-danger alert-dismissible mb-2 col-6 <?php if(empty($_GET['req'])){echo "none-validation";}else{if($_GET['req'] !== "88CpXdaU67"){echo "none-validation";}} ?>" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="d-flex align-items-center">
                            <i class="bx bx-error"></i>
                            <span>
                                L'assignation du client a déja était réalisé pour supprimer l'assignation cliquez <a href="php/comptable_assignation.php?75KUicaG42=<?= $_GET['75KUicaG42'] ?>&num=<?= $_GET['num'] ?>&delete=on">ici</a> !
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="forme-group">
                        <h5>Assignation de client pour : <?= $comptable['nom'] ?> <?= $comptable['prenom'] ?></h5>
                    </div>
                    <div class="form-group">
                        <label>Legendes couleur de fond :</label>
                        <p style="display: inline;">&nbsp&nbsp<span class="bullet bullet-sm bullet-success"></span> = client assigné,</p>
                        <p style="display: inline;">&nbsp&nbsp<span class="bullet bullet-sm bullet-light"></span> = client non assigné</p>
                    </div>
                    <div class="form-group">
                        <p>Assigné un client à un comptable en cliquant sur l'icone &nbsp&nbsp&nbsp<i class="bx bxs-purchase-tag icone" style="position: relative; top: 3px;"></i> et désassigné en re-cliquant sur celui ci !</p>
                    </div>
                    <div id="bt_pluss" class="form-group">
                        <label>Ouvrir la liste des clients assignés (<label style="color: red;"><?= $count_comptable_list ?></label>) : </label>
                        <button style="position: relative; top: 6px;" class="btn btn-icon btn-light-success mr-1 mb-1" type="button" onclick="plus()">
                            <i class="bx bx-plus"></i>
                        </button>
                    </div>
                    <div id="div_info" class="form-group none-validation">
                        <?php foreach($comptable_list as $comptable_liste): ?>
                            <p>- <?= $comptable_liste['name_societe'] ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <!-- invoice list -->
                <section class="invoice-list-wrapper">
                    <div class="action-dropdown-btn d-none">
                        <div class="dropdown invoice-filter-action">
                       
                        </div>
                        <div class="dropdown invoice-options">
                            
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <span class="align-middle">NOM SOCiété</span>
                                    </th>
                                    <th>Téléphone</th>
                                    <th>Date créaction</th>
                                    <th>E-mail</th>
                                    <th>Nom</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($entreprise as $entreprisee): ?>
                            <?php 
                                
                            $nameentreprise = $entreprisee['nameentreprise'];
                            $pdoSta = $bdd->prepare('SELECT * FROM comptable_list WHERE name_societe=:name_societe');
                            $pdoSta->bindValue(':name_societe',$nameentreprise);
                            $pdoSta->execute();
                            $comptable_listi = $pdoSta->fetchAll();
                            $count_verif= count($comptable_listi);
                            
                            ?>
                                <tr style="background-color: <?php if($count_verif > 0){echo "#f3fff1";} ?>;">
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="#"><?= $entreprisee['nameentreprise'] ?></a>
                                    </td>
                                    <td><span class="invoice-amount"><?= $entreprisee['telentreprise'] ?></span></td>
                                    <td><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($entreprisee['datecreation']));?></small></td>
                                    <td><span class="invoice-customer"><?= $entreprisee['emailentreprise'] ?></span></td>
                                    <td><span class="invoice-customer"><?= $entreprisee['nom_diri'] ?></span></td>                                    
                                    <td><span class="<?= $entreprisee['color'] ?>"><?= $entreprisee['new_user'] ?></span></td>
                                    <td><a href="php/comptable_assignation.php?num=<?= $_GET['num'] ?>&id=<?= $entreprisee['id'] ?>"><i class="bx bxs-purchase-tag icone"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
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
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
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
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <!-- END: Page JS-->
    
    <script>
        function plus(){
            document.getElementById('div_info').style.display = "block";
            document.getElementById('bt_pluss').style.diplay = "none";
        }
    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>