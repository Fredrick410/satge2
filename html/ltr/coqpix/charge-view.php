<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="01"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $janvier = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="02"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $fevrier = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="03"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $mars = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="04"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $avril = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="05"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $mai = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="06"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $juin = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="07"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $juillet = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="08"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $aout = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="09"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $septembre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="10"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $octobre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="11"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $novembre = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM charge WHERE id_session=:num AND date_m="12"');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $decembre = $pdoSt->fetchAll();


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
    <title>CHARGE - <?= $entreprise['nameentreprise'] ?></title>
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
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #3c91d5;">
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
                                <div class="user-nav d-lg-flex d-none text-white"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
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
                                    <li class="breadcrumb-item"><a href="charge-list.php">charges sociales</a>
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
                                    <h5 class="">Ajouter une déclaration de charges sociales</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="php/insert_charge.php?num=<?= $_GET['num'] ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>E-mail</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <div class="position-relative has-icon-left">
                                                            <input type="email" id="email-icon" class="form-control" name="email_charge" value="<?= $entreprise['emailentreprise'] ?>" placeholder="E-mail" required>
                                                            <div class="form-control-position">
                                                                <i class="bx bx-mail-send"></i>
                                                            </div>
                                                            <small>L'email permettra de notifier et de valider l'envoye des charges sociales !</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Date du document</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <div class="position-relative has-icon-left">
                                                            <input type="date" class="form-control pickadate picker__input" name="date_charge" value="" placeholder="" required>
                                                            <div class="form-control-position">
                                                                <i class='bx bx-timer'></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" onclick="conf()" class="btn btn-outline-success col-12">Confirmation du mail !</button>
                                                </div>
                                                <div id="div_conf" class="form-group none-validation">
                                                    <div class="file-container">
                                                        <div class="file-overlay" onclick="overplay()"></div>
                                                        <div class="file-wrapper">
                                                            <input name="doc_files" class="file-input" id="js-file-input" type="file" onchange="this.form.submit();">
                                                            <div class="file-content">
                                                                <div class="file-infos">
                                                                    <p class="file-icon"><i class="fas fa-file-upload fa-7x"></i><span class="icon-shadow"></span><span>Cliquez pour parcourir<span class="has-drag"> ou déposez le fichier ici</span></span></p>                                                                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Janvier
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($janvier as $janvierr): $type = substr($janvierr['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $janvierr['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $janvierr['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $janvierr['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $janvierr['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $_GET['num'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Fevrier
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($fevrier as $fevrierr): $type = substr($fevrierr['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $fevrierr['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $fevrierr['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $fevrierr['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $fevrierr['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $fevrierr['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Mars
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($mars as $marss): $type = substr($marss['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $marss['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $marss['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $marss['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $marss['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $marss['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Avril
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($avril as $avrill): $type = substr($avrill['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $avrill['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $avrill['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $avrill['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $avrill['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $avrill['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Mai
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($mai as $maii): $type = substr($maii['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $maii['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $maii['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $maii['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $maii['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $maii['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Juin
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($juin as $juinn): $type = substr($juinn['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $juinn['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $juinn['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $juinn['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $juinn['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $juinn['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Juillet
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($juillet as $juillett): $type = substr($juillett['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $juillett['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $juillett['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $juillett['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $juillett['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $juillett['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Aout
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($aout as $aoutt): $type = substr($aoutt['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $aoutt['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $aoutt['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $aoutt['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $aoutt['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $aoutt['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Septembre
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($septembre as $septembree): $type = substr($septembree['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $septembree['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $septembree['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $septembree['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $septembree['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $septembree['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Octobre
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($octobre as $octobree): $type = substr($octobree['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $octobree['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $octobree['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $octobree['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $octobree['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $octobree['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Novembre
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($novembre as $novembree): $type = substr($novembree['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $novembree['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $novembree['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $novembree['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $novembree['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $novembree['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="divider">
                                                <div class="divider-text">
                                                    Décembre
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row text-center">
                                                    <?php foreach($decembre as $decembree): $type = substr($decembree['files_charge'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $decembree['files_charge'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $decembree['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/charge/<?= $decembree['files_charge'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/charge/<?= $decembree['files_charge'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_charge.php?id=<?= $_GET['num'] ?>&num=<?= $decembree['id'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>    
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