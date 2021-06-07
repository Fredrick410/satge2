<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
   
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
    $pdoSta->execute(); 
    $entreprise = $pdoSta->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM article WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdoSt->execute(); 
    $article = $pdoSt->fetchAll();

    $pdoS = $bdd->prepare('SELECT * FROM facture WHERE id = :num');
    $pdoS->bindValue(':num',$_GET['numfacture']);
    $pdoS->execute(); 
    $facture = $pdoS->fetch();
    $numeros = $facture['numerosfacture'];

    $pdo = $bdd->prepare('SELECT * FROM articles WHERE id_session = :num AND numeros=:numeros AND typ="facturevente"');
    $pdo->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdo->bindValue(':numeros',$numeros);
    $pdo->execute(); 
    $articles = $pdo->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM client WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdoSt->execute(); 
    $client = $pdoSt->fetchAll();

    try{
  
    $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) T ";
  
    $req = $bdd->prepare($sql);
    $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $req->bindValue(':numeros',$numeros); 
    $req->execute();
    $res = $req->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;


    try{
  
    $sq = "SELECT SUM(R.TOTA) as MONTANT_R FROM ( SELECT cout,quantite,remise ,(((cout * quantite) * (1 - (remise/100)))) as TOTA FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) R ";
  
    $re = $bdd->prepare($sq);
    $re->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $re->bindValue(':numeros',$numeros); 
    $re->execute();
    $rer = $re->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_r = !empty($rer) ? $rer['MONTANT_R'] : 0;

    try{
  
    $sql = "SELECT SUM(V.TOTAL) as MONTANT_V FROM ( SELECT cout,quantite,tva ,(((cout * quantite) * (1 - (tva/100)))) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) V ";
  
    $req = $bdd->prepare($sql);
    $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $req->bindValue(':numeros',$numeros); 
    $req->execute();
    $res = $req->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_tva = !empty($res) ? $res['MONTANT_V'] : 0;

    // Auto incrementation

    $max_incrementation = "";

    if($_GET['jXN955CbHqqbQ463u5Uq'] == "Rt82u" OR $_GET['jXN955CbHqqbQ463u5Uq'] == "y44vJ"){

        if($_GET['jXN955CbHqqbQ463u5Uq'] == "Rt82u"){

            $pdoSt = $bdd->prepare('SELECT numerosavoir FROM avoir WHERE id_session = :num');
            $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
            $pdoSt->execute(); 
            $incrementation = $pdoSt->fetchAll();
            $count_incrementation = count($incrementation);
            $max_incrementation = "0";

            for ($i=0; $i < $count_incrementation ; $i++) { 
                foreach($incrementation as $incrementations):

                    $numeros = $incrementations['numerosavoir'];
                    if($numeros > $max_incrementation){
                        $max_incrementation = $numeros;
                    }

                endforeach;
            }

            $max_incrementation = $max_incrementation + 1;

            $strlen_incrementation = strlen($max_incrementation);
            
            if($strlen_incrementation == "1"){
                $max_incrementation = '00'.$max_incrementation;
            }elseif($strlen_incrementation == "2"){
                $max_incrementation = '0'.$max_incrementation;
            }elseif($strlen_incrementation >= "3"){
                $max_incrementation = $max_incrementation;
            }

            $max_incrementation = date('y').$max_incrementation;

        }
        
    }else{
        header('Location: dashboard-analytics.php');
        exit();
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
    <title>Ajouter un avoir</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
                        </ul>
                        <script>
                            function retourn() {
                                window.history.back();
                            }
                        </script>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix"><div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>   <!--NOTIFICATION-->
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">0 Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                                            <!-- CONTENUE ONE -->
                                    </a>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> création du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php')  ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
       <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app invoice View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                <form autocomplete="off" action="php/insert_avoir.php" method="POST">
                                    <input type="hidden" name="numfacture" value="<?= $facture['id'] ?>">
                                        <div class="row mx-0">
                                            <div class="col-xl-4 col-md-12 d-flex align-items-center pl-0">
                                                
                                            </div>
                                            <div class="col-xl-8 col-md-12 px-0 pt-xl-0 pt-1">
                                                <div class="invoice-date-picker d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted mr-75">*Date : </small>
                                                        <fieldset class="d-flex">
                                                            <input name="dte" id="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" placeholder="jj-mm-aa" value="<?= $facture['dte'] ?>" readonly>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- logo and title -->
                                        <div class="row my-2 py-50">
                                            <div class="col-sm-6 col-12 order-2 order-sm-1"><style>.line{text-decoration: underline;}</style>
                                                <h4 class="text-primary">Avoir sur FAC-<?= $facture['numerosfacture'] ?></h4>
                                                <small><label class="line">Client</label> : <?= $facture['facturepour'] ?></small><br>
                                                <small><label class="line">Adresse</label> : <?= $facture['adresse'] ?>, <?= $facture['departement'] ?></small><br>
                                                <small><label class="line">Email</label> : <?= $facture['email'] ?></small><br>
                                                <small><label class="line">Téléphone</label> : <?= $facture['tel'] ?></small>
                                            </div>
                                            <div class="col-sm-6 col-12 order-1 order-sm-1 d-flex justify-content-end">
                                                <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo" height="164" width="164">
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="card-body pt-50">
                                        <!-- product details table-->
                                        <div class="invoice-product-details ">
                                            
                                                <div data-repeater-list="group-a">
                                                <h6 class="invoice-number mr-75">Avoir N°</h6>
                                                <input name="numerosavoir" id="numeros" type="text" class="form-control pt-25 w-50 numeros" placeholder="00000" value="<?= $max_incrementation ?>" <?php if($entreprise['incrementation'] == "yes"){echo "readonly";} ?> required><br>
                                                <p style>AV-<?= date('y') ?>(année)<?= substr($max_incrementation, 2) ?>(numéro) <label>&nbsp&nbsp&nbsp MODE AUTO-INCREMENTATION : <label style='color: <?php if($entreprise['incrementation'] == "yes"){echo "green";}else{echo "red";} ?>;'><?php if($entreprise['incrementation'] == "yes"){echo "On";}else{echo "Off";} ?></label></label></p>
                                                    <div data-repeater-item>
                                                        <?php foreach($articles as $articless): ?>
                                                        <div class="invoice-item d-flex border rounded mb-1">
                                                            <div class="invoice-item-filed row pt-1 px-1">
                                                                <div class="col-12 col-md-4 form-group">
                                                                    <label>Article :</label>
                                                                    <input name="article" id="article_<?= $articless['id'] ?>" type="text" class="form-control invoice-item-desc article" placeholder="Article" value="<?= $articless['article'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Cout :</label>
                                                                    <input name="cout" id="cout_<?= $articless['id'] ?>" type="text" min="1" class="form-control cout" placeholder="0" value="<?= $articless['cout'] ?>" readonly step="any">
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Quantite :</label>    
                                                                    <input name="quantite" id="quantite_<?= $articless['id'] ?>" type="number" min="1" max="<?= $articless['quantite'] ?>" class="form-control quantite" placeholder="0" value="<?= $articless['quantite'] ?>" required step="any">
                                                                </div>
                                                                <div class="col-md-4 col-12 form-group">
                                                                    <label>Ref :</label>
                                                                    <input name="referencearticle" id="referencearticle_<?= $articless['id'] ?>" type="text" class="form-control invoice-item-desc referencearticle" placeholder="Réference" value="<?= $articless['referencearticle'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Unite de mesure :</label>
                                                                    <input name="umesure" id="umesure" type="text" class="form-control mr-0 mb-0 mb-sm-0" placeholder="Pas d'unite de mesure" value="<?= $articless['umesure'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Remise:</label>
                                                                    <input name="remise" type="text" id="remise_<?= $articless['id'] ?>" class="form-control remise" placeholder="0" value="<?= $articless['remise'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Tva :</label>
                                                                    <input name="tva" type="text" id="tva_<?= $articless['id'] ?>" class="form-control tva" placeholder="0" value="<?= $articless['tva'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>                                              
                                                    </div>
                                                </div>
                                        </div>
                                        <!-- invoice subtotal -->
                                        <hr>
                                        <div class="invoice-subtotal pt-50">                                              
                                            <li class="list-group-item border-0 pb-0"><style>.blue{background-color: #394C62; color:white;} .green{background: #43b546; color: white;}  .green:hover{background: #3fff45; color: white;}</style>
                                                <input name="insert" id="button_save" type="button" value="Vérification" class="btn blue btn btn-block subtotal-preview-btn" onclick="buttonc()"/>
                                                <input name="insert" id="subbt" type="hidden" value="Sauvegarder" class="btn btn btn-block subtotal-preview-btn green"/>
                                            </li>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- invoice action  -->
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
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-avoir_add.js"></script>
    <script src="../../../app-assets/js/scripts/pages/buttonc.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>

</body>
<!-- END: Body-->

</html>